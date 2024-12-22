from flask import Blueprint, jsonify, request
from datetime import datetime
# from database import collection
from database import mongo
from models import Upaya
from uuid import UUID
import uuid
from bson.objectid import ObjectId 
import logging  # Tambahkan ini untuk menggunakan modul logging

# Konfigurasi logging
logging.basicConfig(level=logging.INFO)

routes = Blueprint('routes', __name__)

@routes.route('/')
def home():
    return "Selamat datang di Hydroculus API!"

# UPAYA ---------------------------------------------------------------------------------------------------------------------------

# READ (GET) - Mendapatkan semua data
@routes.route('/api/upaya', methods=['GET'])
def get_upaya():
    upayas = list(mongo.upaya_peningkatan.find({}, {"createdAt": 0, "updatedAt": 0}))  # Exclude timestamps
    for upaya in upayas:
        upaya['_id'] = str(upaya['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(upayas), 200

# READ (GET by ID) - Mendapatkan data berdasarkan ID
@routes.route('/api/upaya/<string:id>', methods=['GET'])
def get_upaya_by_id(id):
    try:
        object_id = ObjectId(id)
    except Exception:
        return jsonify({"error": "Invalid ID format"}), 400

    upaya = mongo.upaya_peningkatan.find_one({"_id": object_id}, {"createdAt": 0, "updatedAt": 0})
    if not upaya:
        return jsonify({"error": "Upaya not found"}), 404

    upaya['_id'] = str(upaya['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(upaya), 200

# CREATE (POST) - Menambahkan data baru
@routes.route('/api/upaya-create', methods=['POST'])
def create_upaya():
    data = request.json
    if not data.get('nama_upaya'):
        return jsonify({"error": "Field 'nama_upaya' is required"}), 400

    # data['createdAt'] = datetime.utcnow()
    result = mongo.upaya_peningkatan.insert_one(data)
    
    return jsonify({"message": "Upaya created", "id": str(result.inserted_id)}), 201


# Endpoint untuk memperbarui upaya berdasarkan ID
@routes.route('/api/upaya-update/<string:id>', methods=['PUT'])
def update_upaya(id):
    try:
        # Konversi string ID ke ObjectId
        object_id = ObjectId(id)
    except Exception:
        return jsonify({"error": "Invalid ID format"}), 400

    updated_data = request.json
    # updated_data['updatedAt'] = datetime.utcnow()

    # Update data di MongoDB
    result = mongo.upaya_peningkatan.update_one({"_id": object_id}, {"$set": updated_data})

    if result.matched_count == 0:
        return jsonify({"error": "Upaya not found"}), 404

    # Ambil data yang sudah diupdate untuk dikembalikan
    updated_upaya = mongo.upaya_peningkatan.find_one({"_id": object_id}, {"_id": 0})
    return jsonify(updated_upaya)

# DELETE (DELETE) - Menghapus data berdasarkan ID
@routes.route('/api/upaya-delete/<string:id>', methods=['DELETE'])
def delete_upaya(id):
    try:
        object_id = ObjectId(id)
    except Exception:
        return jsonify({"error": "Invalid ID format"}), 400

    result = mongo.upaya_peningkatan.delete_one({"_id": object_id})
    if result.deleted_count == 0:
        return jsonify({"error": "Upaya not found"}), 404

    return jsonify({"message": "Upaya deleted"}), 200


# SUMBER AIR ---------------------------------------------------------------------------------------------------------------------------

# READ (GET) - Mendapatkan semua data
@routes.route('/api/sumber_air', methods=['GET'])
def get_sumber_air():
    try:
        # Query data dari MongoDB
        sumbers = list(mongo.sumber_air.find({}, {"createdAt": 0, "updatedAt": 0}))

        # Konversi ObjectId ke string
        for sumber in sumbers:
            sumber['_id'] = str(sumber['_id'])  # Konversi _id
            if 'id_jenis_sumber_air' in sumber:
                sumber['id_jenis_sumber_air'] = str(sumber['id_jenis_sumber_air'])  # Konversi id_jenis_sumber_air
            if 'upaya_peningkatan' in sumber:
                sumber['upaya_peningkatan'] = [str(upaya) for upaya in sumber['upaya_peningkatan']]  # Konversi upaya_peningkatan
        
        # Kirim response JSON
        return jsonify(sumbers), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500

@routes.route('/api/sumber_air_lookup', methods=['GET'])
def get_sumber_air_lookup():
    try:
        pipeline = [
            # Join ke jenis_sumber_air
            {
                "$lookup": {
                    "from": "jenis_sumber_air",
                    "localField": "id_jenis_sumber_air",
                    "foreignField": "_id",
                    "as": "jenis_sumber_air"
                }
            },
            # Join ke regencies (kabupaten)
            {
                "$lookup": {
                    "from": "regencies",
                    "localField": "id_kabupaten",
                    "foreignField": "id_regency",
                    "as": "kabupaten"
                }
            },
            {
                "$unwind": {
                    "path": "$kabupaten",
                    "preserveNullAndEmptyArrays": True
                }
            },
            # Join ke provinces (provinsi)
            {
                "$lookup": {
                    "from": "provinces",
                    "localField": "kabupaten.province_id",
                    "foreignField": "id_province",
                    "as": "provinsi"
                }
            },
            {
                "$unwind": {
                    "path": "$provinsi",
                    "preserveNullAndEmptyArrays": True
                }
            },
            # Join ke upaya peningkatan
            {
                "$lookup": {
                    "from": "upaya_peningkatan",
                    "localField": "upaya_peningkatan",
                    "foreignField": "_id",
                    "as": "upaya_peningkatan"
                }
            },
            # Exclude timestamps
            {
                "$project": {
                    "createdAt": 0,
                    "updatedAt": 0
                }
            }
        ]

        # Jalankan pipeline
        sumbers = list(mongo.sumber_air.aggregate(pipeline))

        # Konversi ObjectId dan nested ID ke string
        for sumber in sumbers:
            sumber['_id'] = str(sumber.get('_id', ''))
            sumber['id_jenis_sumber_air'] = str(sumber.get('id_jenis_sumber_air', ''))
            if 'upaya_peningkatan' in sumber and isinstance(sumber['upaya_peningkatan'], list):
                sumber['upaya_peningkatan'] = [str(upaya.get('nama_upaya')) for upaya in sumber['upaya_peningkatan'] if isinstance(upaya, dict)]
            if 'kabupaten' in sumber and sumber['kabupaten']:
                sumber['kabupaten']['_id'] = str(sumber['kabupaten'].get('_id', ''))
            if 'provinsi' in sumber and sumber['provinsi']:
                sumber['provinsi']['_id'] = str(sumber['provinsi'].get('_id', ''))
            if 'jenis_sumber_air' in sumber and isinstance(sumber['jenis_sumber_air'], list) and sumber['jenis_sumber_air']:
                sumber['jenis_sumber_air'][0]['_id'] = str(sumber['jenis_sumber_air'][0].get('_id', ''))

        return jsonify(sumbers), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500



# READ (GET by ID) - Mendapatkan data berdasarkan ID
@routes.route('/api/sumber_air/<string:id>', methods=['GET'])
def get_sumber_air_by_id(id):
    try:
        object_id = ObjectId(id)
    except Exception:
        return jsonify({"error": "Invalid ID format"}), 400

    sumber_air = mongo.sumber_air.find_one({"_id": object_id}, {"createdAt": 0, "updatedAt": 0})
    if not sumber_air:
        return jsonify({"error": "sumber_air not found"}), 404

    sumber_air['_id'] = str(sumber_air['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(sumber_air), 200