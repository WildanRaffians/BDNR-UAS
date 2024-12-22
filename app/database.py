from pymongo import MongoClient

# Konfigurasi koneksi ke database MongoDB
client = MongoClient("mongodb://localhost:27017/")

# Inisialisasi database
db = client["db_water"]

# Tambahkan variabel 'mongo' agar dapat diakses oleh modul lain
mongo = db
