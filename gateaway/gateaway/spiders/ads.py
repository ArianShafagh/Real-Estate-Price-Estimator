import scrapy
from gateaway.items import GateawayItem
import re

class AdsSpider(scrapy.Spider):
    name = "ads"
    start_urls = [
        "https://www.gate-away.com/properties/sicily?currency=EUR&pag=1",
    ]

    def parse(self, response):
        cards = response.xpath("/html/body/div/div/div/div/main/section[4]/ul/li")
        for card in cards:
            link = card.xpath(".//a[contains(@class,'property-card__link')]/@href").get()
            if not link:
                link = card.xpath(".//a[contains(@class,'property-card__title')]/@href").get()
            if link:
                yield response.follow(link, self.parse_detail)

        # next_page = response.xpath("//a[contains(@class,'page-link page-link-bd')]/@href").get()
        # if next_page:
        #     yield response.follow(next_page, self.parse)

    def parse_detail(self, response):
        def extract_distance(value):
            if not value:
                return ""
            main_part = value.split("-", 1)[0].strip()
            match = re.search(r"(\d+(?:\.\d+)?)\s*(km|m|minutes|min)", main_part, re.IGNORECASE)
            if match:
                return f"{match.group(1)} {match.group(2)}"
            return main_part
        def get_text(xpath_expr):
            return response.xpath(xpath_expr).get(default='').strip()
        item = GateawayItem()
        item['url'] = response.url

        # Location works as before
        item['location'] = get_text("//h1//span[@aria-label]/@aria-label")

        # Price
        item['price'] = get_text("//p[@class='single-property__price-primary']/text()")
        
        # Initialize optional fields
        item['distance_from_airport'] = ""
        item['public_transport'] = ""
        item['hospital'] = ""

        item['property_type'] = ""
        item['property_quality'] = ""
        item['rooms'] = ""
        item['living_area'] = ""
        item['bathrooms'] = ""
        item['garden_sqm'] = ""
        item['energy_efficiency'] = ""
        
        
        self.logger.info(f"Scraping details from {response.url}")
        
        property_info_sections = response.xpath("//div[@class='single-property-content__block']")
        if not property_info_sections:
            self.logger.warning(f"No info tables found on {response.url}")
        else:
            self.logger.info(f"Found {len(property_info_sections)} potential info rows on {response.url}")
        # Parse *all* info tables dynamically
        for prop in property_info_sections:
            rows = prop.xpath(".//dl[@class='list-group list-group-flush']//div[@class='list-group-item']")
            if not rows:
                self.logger.warning(f"No info tables found on {response.url}")
            else:
                self.logger.info(f"Found {len(rows)} potential info rows on {response.url}")

            for r in rows:
                label = r.xpath("./dt//text()").get(default="").strip().lower()
                # value = " ".join(r.xpath(".//dd//text()").getall()).strip()

                if not label:
                    continue
                if "airport" in label or "public transport" in label or "hospital" in label:
                    values = r.xpath(".//dd//p/text()").getall()
                    cleaned = [extract_distance(v.strip()) for v in values if v.strip()]
                    value = "; ".join(cleaned)  # keep multiple values separated
                else:
                    # For normal fields → just take dd text
                    value = " ".join(r.xpath(".//dd//text()").getall()).strip()
                self.logger.debug(f"Found label: '{label}' with value: '{value}'")
                # Distances → use extractor
                if "airport" in label:
                    item['distance_from_airport'] = extract_distance(value)
                elif "public transport" in label:
                    item['public_transport'] = extract_distance(value)
                elif "hospital" in label:
                    item['hospital'] = extract_distance(value)

                # Other property info → assign raw
                elif "property type" in label:
                    item['property_type'] = value
                elif "bedrooms" in label:
                    item['rooms'] = value
                elif "living area" in label:
                    item['living_area'] = value
                elif "bathrooms" in label:
                    item['bathrooms'] = value
                elif "garden" in label:
                    item['garden_sqm'] = value
                elif "energy efficiency" in label:
                    item['energy_efficiency'] = value
                elif "property quality" in label:
                    item['property_quality'] = value

        self.logger.info(f"Finished scraping {response.url}. Yielding item: {item}")
        yield item
        
        