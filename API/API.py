import joblib
import pandas as pd
from fastapi import FastAPI, Request

app = FastAPI()
loaded_model = joblib.load("real_estate_model.pkl")

city_db = pd.read_csv("CityProvinceMedians.csv")
city_db["City"] = city_db["City"].str.lower()
city_db["Province"] = city_db["Province"].str.lower()

def city_median_lookup(df):
    city = df.at[0, "City"].lower()
    province = df.at[0, "Province"].lower()
    match = city_db[(city_db["City"] == city) & (city_db["Province"] == province)]
    if not match.empty:
        df["city_median"] = match.iloc[0]["city_median_price"]
    else:
        df["city_median"] = df["living_area"] * 1000  # fallback, adjust logic

def predict_price(data):
    df = pd.DataFrame([data])
    city_median_lookup(df)
    return float(loaded_model.predict(df)[0])

@app.post("/predict")
async def predict(request: Request):
    try:
        data = await request.json()
        return {"predicted_price": predict_price(data)}
    except Exception as e:
        return {"error": str(e)}
