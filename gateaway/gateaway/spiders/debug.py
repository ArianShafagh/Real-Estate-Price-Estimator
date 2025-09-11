import scrapy
import re

class DebugSpider(scrapy.Spider):
    name = "debug"
    allowed_domains = ["gate-away.com"]
    start_urls = ["https://www.gate-away.com/properties/sicily?currency=EUR&pag=575"]

    def parse(self, response):
        current_page = int(response.url.split("pag=")[-1]) if "pag=" in response.url else 1
        self.logger.info(f"Parsing page {current_page}")

        # Extract ALL possible "Next page" links
        next_pages = response.xpath(
            "//nav[@class='property-nav']//a[@aria-label='Next page']/@href"
        ).getall()
        self.logger.info(f"Next page URLs found: {next_pages}")

        for link in next_pages:
            # Extract page number from URL if exists
            match = re.search(r'pag=(\d+)', link)
            if match:
                next_page_num = int(match.group(1))
                if next_page_num > current_page:
                    self.logger.info(f"Following to page {next_page_num}: {link}")
                    yield response.follow(link, self.parse)
                else:
                    self.logger.info(f"Skipping {link}, page not greater than {current_page}")
            else:
                # If no page number in URL, just follow blindly
                self.logger.info(f"Following (no page number found): {link}")
                yield response.follow(link, self.parse)



# 246,543,546,566,575,