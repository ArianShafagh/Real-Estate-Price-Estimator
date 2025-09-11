# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class GateawayItem(scrapy.Item):
    City = scrapy.Field()
    Province = scrapy.Field()
    property_quality = scrapy.Field()
    price = scrapy.Field()
    property_type = scrapy.Field()
    rooms = scrapy.Field()
    living_area = scrapy.Field()
    land_area = scrapy.Field()
    bathrooms = scrapy.Field()
    garden = scrapy.Field()
    garden_sqm = scrapy.Field()
    pool = scrapy.Field()
    terrace = scrapy.Field()
    terrace_sqm = scrapy.Field()
    car_box = scrapy.Field()
    distance_from_airport = scrapy.Field()
    Skiresort_distance = scrapy.Field()
