from flask import Blueprint, jsonify, request
from datetime import datetime
from BDNR_FLUSK.database import collection
from BDNR_FLUSK.models import Upaya
from uuid import UUID
import uuid
from bson.objectid import ObjectId 
import logging  # Tambahkan ini untuk menggunakan modul logging

# Konfigurasi logging
logging.basicConfig(level=logging.INFO)

routes = Blueprint('routes', __name__)

@routes.route('/')
def home():
    return "Selamat datang di Upaya API!"

# READ (GET) - Mendapatkan semua data
@routes.route('/api/upaya', methods=['GET'])
def get_upaya():
    upayas = list(collection.find({}, {"createdAt": 0, "updatedAt": 0}))  # Exclude timestamps
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

    upaya = collection.find_one({"_id": object_id}, {"createdAt": 0, "updatedAt": 0})
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
    result = collection.insert_one(data)
    
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
    result = collection.update_one({"_id": object_id}, {"$set": updated_data})

    if result.matched_count == 0:
        return jsonify({"error": "Upaya not found"}), 404

    # Ambil data yang sudah diupdate untuk dikembalikan
    updated_upaya = collection.find_one({"_id": object_id}, {"_id": 0})
    return jsonify(updated_upaya)

# DELETE (DELETE) - Menghapus data berdasarkan ID
@routes.route('/api/upaya-delete/<string:id>', methods=['DELETE'])
def delete_upaya(id):
    try:
        object_id = ObjectId(id)
    except Exception:
        return jsonify({"error": "Invalid ID format"}), 400

    result = collection.delete_one({"_id": object_id})
    if result.deleted_count == 0:
        return jsonify({"error": "Upaya not found"}), 404

    return jsonify({"message": "Upaya deleted"}), 200