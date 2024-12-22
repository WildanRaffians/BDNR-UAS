from pymongo import MongoClient

# Konfigurasi koneksi ke database MongoDB
client = MongoClient("mongodb://localhost:27017/")

db = client["water"]
collection = db["Upaya_peningkatan"]