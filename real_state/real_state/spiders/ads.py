import scrapy
from urllib.parse import urljoin
import logging
from scrapy.http import FormRequest
from scrapy.utils.response import open_in_browser

class AdsSpider(scrapy.Spider):
    name = 'ads'
    allowed_domains = ['idealista.it']
    start_urls = ['https://www.idealista.it/vendita-case/messina-provincia/']
    def parse(self, response):
        articles = response.xpath('/html/body/div[3]/div/div/main/section/article')
        for article in articles:
            link = article.xpath('./div[1]/a/@href').get()
            if link:
                full_link = urljoin(response.url, link)
                yield scrapy.Request(url=full_link, callback=self.parse_ad_details)
            print(link)