# Real-Estate-Price-Estimator
🏠 Real Estate Price Prediction using Machine Learning
📘 Overview

This project aims to build an intelligent real estate price prediction system using Machine Learning (ML) and FastAPI.
The system scrapes real estate listings, processes and encodes the data, trains an XGBoost regression model, and serves real-time predictions through a web interface built with HTML and FastAPI.

🚀 Project Workflow
1. Data Collection (Web Scraping)

The project begins with data extraction using Scrapy from a real estate gateway website.

Key details such as property type, price, location, number of rooms, and area were collected.

The scraping pipeline was designed to handle pagination, avoid duplicates, and store results efficiently in structured form (CSV).

2. Data Cleaning & Preprocessing

Removed missing or inconsistent values.

Standardized numerical columns (e.g., price, size).

Encoded categorical variables using One-Hot Encoding for better ML performance.

Normalized and optimized the dataset to ensure robust model training.

3. Model Training

Used XGBoost, a high-performance gradient boosting framework, for prediction.

Split the dataset into training and testing sets for evaluation.

Tuned hyperparameters to improve accuracy and reduce overfitting.

Achieved strong predictive performance through iterative experimentation.

4. Model Deployment

The trained model was integrated with FastAPI to serve predictions.

The API takes user inputs (e.g., location, rooms, area) and returns a predicted property price.

A simple HTML interface allows users to interact with the model directly.

🧠 Technologies Used
Category	Tools / Libraries
Data Collection	Scrapy
Data Cleaning & Encoding	Pandas, NumPy, Scikit-learn
Machine Learning Model	XGBoost
API & Backend	FastAPI
Frontend Interface	HTML, CSS
Deployment	Uvicorn (FastAPI Server)
🧩 Project Structure
real-estate-ml/
│
├── data/
│   ├── raw_data.csv
│   ├── cleaned_data.csv
│
├── scraper/
│   ├── gateway_spider.py
│   └── pipelines.py
│
├── model/
│   ├── train_model.py
│   ├── xgb_model.pkl
│
├── api/
│   ├── main.py              # FastAPI entry point
│   ├── predict.py           # Model integration logic
│
├── web/
│   ├── index.html           # Frontend interface
│
├── requirements.txt
└── README.md

🧪 How to Run the Project
1. Clone the Repository
git clone https://github.com/yourusername/real-estate-ml.git
cd real-estate-ml

2. Install Dependencies
pip install -r requirements.txt

3. Run FastAPI Server
uvicorn api.main:app --reload

4. Open in Browser

Visit: http://127.0.0.1:8000/

Use the interface to input property details and receive real-time predictions.

📈 Results

XGBoost model achieved high accuracy in predicting real estate prices.

Optimized encoding and feature selection improved overall performance.

FastAPI-based deployment provides quick and scalable model serving.

🔮 Future Improvements

Integrate geospatial features (e.g., distance to city center, schools).

Add real-time scraping for up-to-date listings.

Deploy model using Docker or cloud platforms (e.g., AWS, GCP, Render).

Enhance frontend with React or Vue.js for a modern UI.

👤 Author

Arian Shafagh
Second-year Computer Science Student @ University of Messina
Passionate about AI, Machine Learning, and Data Engineering