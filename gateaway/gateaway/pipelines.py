# Define your item pipelines here
#
# Don't forget to add your pipeline to the ITEM_PIPELINES setting
# See: https://docs.scrapy.org/en/latest/topics/item-pipeline.html


# useful for handling different item types with a single interface
from itemadapter import ItemAdapter
import csv

class GateawayPipeline:
    def open_spider(self, spider):
        self.file = open('properties.csv', 'w', newline='', encoding='utf-8')
        self.writer = None

    def close_spider(self, spider):
        self.file.close()

    def process_item(self, item, spider):
        # Example filters:
        # Only properties with price and more than 2 rooms
        if item['price'] and item['rooms']:
            try:
                rooms = int(item['rooms'])
            except:
                rooms = 0
            if rooms >= 2:
                # Write header once
                if self.writer is None:
                    self.writer = csv.DictWriter(self.file, fieldnames=item.keys())
                    self.writer.writeheader()
                self.writer.writerow(item)
        return item