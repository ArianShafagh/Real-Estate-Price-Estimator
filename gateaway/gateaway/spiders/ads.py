import scrapy
import json
import re
from gateaway.items import GateawayItem

class AdsSpider(scrapy.Spider):
    name = "ads"
    start_urls = [
        f"https://www.gate-away.com/properties/sicily?currency=EUR&pag={i}"
        for i in range(1, 618)   # 1 → 617
    ]    
    api_url = "https://www.gate-away.com/api/properties/{}"

    def parse(self, response):
        """
        Parses the search results page and initiates requests for each property.
        """
        current_page = int(response.url.split("pag=")[-1])
        self.logger.info(f"Parsing page {current_page}")        
    
        # Get all property card list items
        cards = response.xpath("//section[@class='property-list-ver']//ul[@class='property-list-ver__wrapper']/li")
        for card in cards:
            # Extract the property ID directly from the `data-idprop` attribute
            prop_id = card.xpath("./@data-idprop").get()
            # Extract the property link to use for the HTML request
            link = card.xpath(".//a[(@class='property-card__link')]/@href").get()
            if prop_id and link:
                absolute_link = response.urljoin(link)
                # Pass both the property ID and the link to the next callback
                yield scrapy.Request(
                    url=absolute_link,
                    callback=self.parse_html,
                    meta={'prop_id': prop_id}
                )

    def parse_html(self, response):
        def extract_first_number(value):
            match = re.search(r'(\d+(\.\d+)?)', value)
            return float(match.group(1)) if match else 0

        item = GateawayItem()
        prop_id = response.meta['prop_id']

        # Initialize defaults
        item['property_type'] = ''
        item['property_quality'] = 0
        item['rooms'] = 0
        item['living_area'] = 0
        item['bathrooms'] = 0
        item['garden_sqm'] = 0
        item['terrace_sqm'] = 0
        item['land_area'] = 0
        item['distance_from_airport'] = 0
        item['Skiresort_distance'] = 0
        item['terrace'] = 0
        item['garden'] = 0
        item['pool'] = 0
        item['car_box'] = 0

        # URL-based Province/City
        try:
            parts = response.url.split("/")
            item['Province'] = parts[5] if len(parts) > 5 else ""
            item['City'] = parts[6] if len(parts) > 6 else ""
        except:
            item['Province'] = ""
            item['City'] = ""
        item['price'] = (response.xpath("//p[@class='single-property__price-primary']/text()").get(default='').strip())
        if item['price'] == 0 or item['price'] == '' or item['price'] == 'POA':
            self.logger.warning(f"Skipping property {prop_id} due to invalid/POV price: {item['price']}")
            return
        else:
            item['price'] = convert_to_euro(item['price'], fallback=0.0)
        # Feature flags
        features = response.xpath("//div[@class='single-property-content__block mt-4']/ul")
        if len(features) == 0:
            api_url = self.api_url.format(prop_id)
            yield scrapy.Request(url=api_url, callback=self.parse_api_data, meta={'item': item})
        else:    
            for feature in features:
                texts = feature.xpath("./li[@class='single-property-content__tag']/text()").getall()
                self.logger.info(f"Feature texts: {texts}")
                if "terrace" in texts: item['terrace'] = 1
                if "garden" in texts: item['garden'] = 1
                if "pool" in texts: item['pool'] = 1
                if "garage" in texts: item['car_box'] = 1

            # Tables
            tables = response.xpath("//div[contains(@class, 'single-property-content__block')]")
            for table in tables:
                    rows = table.xpath(".//div[@class='list-group-item']")
                    for row in rows:
                        key = row.xpath(".//dt//text()").get(default='').strip().lower()
                        value = " ".join(row.xpath(".//dd//text()").getall()).strip()

                        if "property type" in key and value:
                            item['property_type'] = value
                        elif "condition" in key and value:
                            v = value.lower()
                            if "new" in v: item['property_quality'] = 2
                            elif "completely restored/habitable" in v: item['property_quality'] = 1
                            elif "partially restored" in v: item['property_quality'] = 3
                            elif "to be restored" in v: item['property_quality'] = 4
                            else: item['property_quality'] = 5
                        elif "bedrooms" in key and value:
                            item['rooms'] = value
                        elif "living area" in key and value:
                            item['living_area'] = extract_first_number(value)
                        elif "bathrooms" in key and value:
                            item['bathrooms'] = value
                        elif "garden" in key and value:
                            item['garden_sqm'] = extract_first_number(value)
                        elif "terrace" in key and value:
                            item['terrace_sqm'] = extract_first_number(value)
                        elif "land" in key and value:
                            item['land_area'] = extract_first_number(value)
                        elif "airport" in key and value:
                            item['distance_from_airport'] = extract_first_number(value)
                        elif "ski" in key and value:
                            item['Skiresort_distance'] = extract_first_number(value)
            self.logger.info(f"Successfully scraped HTML for property {prop_id}. Yielding item.")
            yield item


    def parse_api_data(self, response):
        """
        Parses the JSON data from the API response and fills in the item.
        This serves as the fallback mechanism.
        """
        item = response.meta['item']
        try:
            data = json.loads(response.body)
            property_data = data.get("data", {}).get("data", {})
            
            if property_data:
                # Merge API data with the existing (possibly empty) item
                property_type = property_data.get('IDType', '')
                if property_type == 1:
                    item['property_type'] = 'House'
                elif property_type == 2:
                    item['property_type'] = 'Apartment'
                item['price'] = property_data.get('Price', '')
                item['rooms'] = property_data.get('Rooms_number', '')
                item['living_area'] = property_data.get('Sqm', '')
                item['land_area'] = property_data.get('Land_sqm', '')
                item['bathrooms'] = property_data.get('Bathrooms', '')
                item['garden_sqm'] = property_data.get('Garden_sqm', '')
                item['terrace_sqm'] = property_data.get('Terrace_sqm', '')
                item['distance_from_airport'] = property_data.get('Airport_distance', '')
                item['Skiresort_distance'] = property_data.get('Skiresort_distance', '')
                yield item
            else:
                self.logger.error(f"Failed to get any data from API for {response.url}")

        except json.JSONDecodeError:
            self.logger.error(f"Failed to decode JSON from API response for {response.url}")
            
import re
# Exchange rates (as of Sept 2025 — update these regularly!)
EXCHANGE_RATES = {
    "EUR": 1.0,      # Euro
    "USD": 0.91,     # US Dollar → EUR
    "CAD": 0.62,     # Canadian Dollar → EUR
    "BRL": 0.18,     # Brazilian Real → EUR
    "GBP": 1.18,     # British Pound → EUR
    "CHF": 1.04,     # Swiss Franc → EUR
    "AUD": 0.59,     # Australian Dollar → EUR
    # Add more as needed
}

def convert_to_euro(price_str, fallback=0.0):
    """
    Converts a price string (e.g., '$142,453 CAD', '€200,000', 'R$3,624,250')
    into a numeric EUR value.
    """

    if not price_str:
        return fallback

    text = price_str.strip().upper()

    # Detect currency
    currency = "EUR"  # default
    if "USD" in text or "$" in text and "CAD" not in text:
        currency = "USD"
    elif "CAD" in text:
        currency = "CAD"
    elif "BRL" in text or "R$" in text:
        currency = "BRL"
    elif "GBP" in text or "£" in text:
        currency = "GBP"
    elif "CHF" in text:
        currency = "CHF"
    elif "AUD" in text:
        currency = "AUD"
    elif "€" in text or "EUR" in text:
        currency = "EUR"

    # Extract numeric part
    num = re.sub(r"[^\d.,]", "", price_str)
    # Handle thousand separators vs decimal marks
    num = num.replace(",", "") if num.count(",") > num.count(".") else num.replace(",", ".")
    
    try:
        value = float(num)
    except ValueError:
        return fallback

    # Convert to EUR
    rate = EXCHANGE_RATES.get(currency, None)
    if rate is None:
        return fallback

    return round(value * rate)
