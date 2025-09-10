# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class GateawayItem(scrapy.Item):
    url = scrapy.Field()
    property_quality = scrapy.Field()
    title = scrapy.Field()
    location = scrapy.Field()
    price = scrapy.Field()
    property_type = scrapy.Field()
    rooms = scrapy.Field()
    living_area = scrapy.Field()
    bathrooms = scrapy.Field()
    garden_sqm = scrapy.Field()
    energy_efficiency = scrapy.Field()
    distance_from_airport = scrapy.Field()
    public_transport = scrapy.Field()
    hospital = scrapy.Field()
    
