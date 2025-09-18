
import numpy as np
import pandas as pd

# Load the dataset
df = pd.read_csv('C:\\Users\\DOR CO\\Desktop\\Real state ML\\Real-Estate-Price-Estimator\\gateaway\\properties.csv')
db = df.copy()

# 1. Convert columns to numeric using vectorized operations
num_cols = ['property_quality', 'rooms', 'living_area', 'bathrooms', 'garden_sqm',
            'terrace_sqm', 'land_area', 'distance_from_airport', 'Skiresort_distance', 'price']
for c in num_cols:
    if c in db.columns:
        db[c] = pd.to_numeric(db[c], errors='coerce')

# 2. Use vectorized operations for rounding distances
db['distance_from_airport'] = db['distance_from_airport'].round().astype(int)
db['Skiresort_distance'] = db['Skiresort_distance'].round().astype(int)
db['living_area'] = db['living_area'].round().astype(int)
db['garden_sqm'] = db['garden_sqm'].round().astype(int)
db['terrace_sqm'] = db['terrace_sqm'].round().astype(int)
# 3. Use vectorized string operations and mapping for property types
mapping = {
    'villa': 1,
    'house': 0,
    'apartment': 2,
    'commercial': 3,
    'land': 4,
    'penthouse': 5,
    'farm': 6,
}

# Use a default value for types not found
db['property_type'] = db['property_type'].str.lower().map(
    lambda x: next((v for k, v in mapping.items() if k in x), 7)
)

# 4. Use vectorized operations for creating binary columns
db['garden'] = np.where(db['garden_sqm'] > 0, 1, 0)
db['terrace'] = np.where(db['terrace_sqm'] > 0, 1, 0)
db['land'] = np.where(db['land_area'] > 0, 1, 0)

# 5. Filter the data based on specified ranges
db = db[db['price'].between(30000, 20000000)]
db = db[db['rooms'].between(0, 15)]
db = db[db['bathrooms'].between(0, 10)]
db = db[db['living_area'].between(50, 1000)]
db = db[db['garden_sqm'].between(0, 5000)]
db = db[db['terrace_sqm'].between(0, 500)]
db = db[db['land_area'].between(0, 500000)]

db['province_median'] = db.groupby('Province')['price'].transform('median')
db['province_median'] = db['province_median'].round().astype('Int64')
db['city_median'] = db.groupby('City')['price'].transform('median')
db['city_median'] = db['city_median'].round().astype('Int64')


province_unique = db['Province'].unique()
province_mapping = {prov: idx for idx, prov in enumerate(province_unique)}
db['Province'] = db['Province'].map(province_mapping)

# Automatically generate City IDs
city_unique = db['City'].unique()
city_mapping = {city: idx for idx, city in enumerate(city_unique)}
db['City'] = db['City'].map(city_mapping)


db.to_csv('C:\\Users\\DOR CO\\Desktop\\Real state ML\\Real-Estate-Price-Estimator\\Dataset\\DataCleaned.csv', index=False)
