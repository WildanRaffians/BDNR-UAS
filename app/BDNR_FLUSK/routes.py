from flask import Blueprint, jsonify, request, session
from werkzeug.security import generate_password_hash, check_password_hash
from datetime import datetime
# from database import collection
from database import mongo
from models import Upaya
from uuid import UUID
import uuid
from bson.objectid import ObjectId
from bson.errors import InvalidId
import logging  # Tambahkan ini untuk menggunakan modul logging

import jwt
import os
from auth import token_required

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

# Mendapatkan data sumber air dengan wilayahnya dan fitur search
@routes.route('/api/sumber_air_lookup_filter', methods=['GET'])
def get_sumber_air_lookup_filter():
    try:
        # Ambil parameter pagination dan searching
        keyword = request.args.get('keyword', '').strip()
        page = int(request.args.get('page', 1))  # Halaman default 1
        limit = int(request.args.get('limit', 10))  # Default 10 data per halaman
        skip = (page - 1) * limit

        # Ambil parameter filtering
        jenis_sumber_air = request.args.get('jenis_sumber_air', '').strip()
        lokasi = request.args.get('lokasi', '').strip()
        kelayakan = request.args.get('kelayakan', '').strip()
        kondisi = request.args.get('kondisi', '').strip()

        # Pipeline dasar
        pipeline = [
            # Join ke jenis_sumber_air
            {"$lookup": {"from": "jenis_sumber_air", "localField": "id_jenis_sumber_air", "foreignField": "_id", "as": "jenis_sumber_air"}},
            # Join ke regencies (kabupaten)
            {"$lookup": {"from": "regencies", "localField": "id_kabupaten", "foreignField": "id_regency", "as": "kabupaten"}},
            {"$unwind": {"path": "$kabupaten", "preserveNullAndEmptyArrays": True}},
            # Join ke provinces (provinsi)
            {"$lookup": {"from": "provinces", "localField": "kabupaten.province_id", "foreignField": "id_province", "as": "provinsi"}},
            {"$unwind": {"path": "$provinsi", "preserveNullAndEmptyArrays": True}},
            # Join ke upaya peningkatan
            {"$lookup": {"from": "upaya_peningkatan", "localField": "upaya_peningkatan", "foreignField": "_id", "as": "upaya_peningkatan"}},
            # Exclude timestamps
            {"$project": {"createdAt": 0, "updatedAt": 0}}
        ]

        # Filter berdasarkan keyword
        if keyword:
            pipeline.append({
                "$match": {
                    "$or": [
                        {"nama_sumber_air": {"$regex": keyword, "$options": "i"}},
                        {"kabupaten.name": {"$regex": keyword, "$options": "i"}},
                        {"provinsi.name": {"$regex": keyword, "$options": "i"}}
                    ]
                }
            })

        # Filter berdasarkan jenis sumber air
        if jenis_sumber_air:
            pipeline.append({"$match": {"id_jenis_sumber_air": ObjectId(jenis_sumber_air)}})

        # Filter berdasarkan lokasi (kabupaten)
        if lokasi:
            pipeline.append({"$match": {"id_kabupaten": ObjectId(lokasi)}})

        # Filter berdasarkan kelayakan
        if kelayakan:
            pipeline.append({"$match": {"kelayakan": {"$regex": kelayakan, "$options": "i"}}})

        # Filter berdasarkan kondisi sumber air
        if kondisi:
            pipeline.append({"$match": {"kondisi_sumber_air": {"$regex": kondisi, "$options": "i"}}})

        # Hitung total data sebelum pagination
        total_data_pipeline = pipeline + [{"$count": "total"}]
        total_data_result = list(mongo.sumber_air.aggregate(total_data_pipeline))
        total_data = total_data_result[0]["total"] if total_data_result else 0

        # Pagination: skip dan limit
        pipeline.append({"$skip": skip})
        pipeline.append({"$limit": limit})

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

        return jsonify({
            "data": sumbers,
            "total": total_data,
            "page": page,
            "limit": limit
        }), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500


# Mendapatkan data sumber air dengan wilayahnya limit
@routes.route('/api/sumber_air_wilayah_limit', methods=['GET'])
def get_sumber_air_wilayah_limit():
    try:
        start = request.args.get('start', default=0, type=int)
        limit = request.args.get('limit', default=1, type=int)

        pipeline = []
        
        # Join dan proses data seperti sebelumnya
        pipeline += [
            # Join ke regencies (kabupaten)
            {"$lookup": {"from": "regencies", "localField": "id_kabupaten", "foreignField": "id_regency", "as": "kabupaten"}},
            {"$unwind": {"path": "$kabupaten", "preserveNullAndEmptyArrays": True}},
            # Join ke provinces (provinsi)
            {"$lookup": {"from": "provinces", "localField": "kabupaten.province_id", "foreignField": "id_province", "as": "provinsi"}},
            {"$unwind": {"path": "$provinsi", "preserveNullAndEmptyArrays": True}},
            # Exclude timestamps
            {"$project": {"createdAt": 0, "updatedAt": 0}}
        ]

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
        
        # Filter data berdasarkan start dan limit
        filtered_sumbers = sumbers[start:start + limit]

        return jsonify(filtered_sumbers), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500


@routes.route('/api/sumber_air_lookup', methods=['GET'])
def get_sumber_air_lookup():
    try:
        pipeline = [
            # Join ke jenis_sumber_air
            { "$lookup": { "from": "jenis_sumber_air", "localField": "id_jenis_sumber_air", "foreignField": "_id", "as": "jenis_sumber_air" } },
            { "$unwind": { "path": "$jenis_sumber_air", "preserveNullAndEmptyArrays": True } },
            # Join ke regencies (kabupaten)
            { "$lookup": { "from": "regencies", "localField": "id_kabupaten", "foreignField": "id_regency", "as": "kabupaten" } },
            { "$unwind": { "path": "$kabupaten", "preserveNullAndEmptyArrays": True } },
            # Join ke provinces (provinsi)
            { "$lookup": { "from": "provinces", "localField": "kabupaten.province_id", "foreignField": "id_province", "as": "provinsi" } },
            { "$unwind": { "path": "$provinsi", "preserveNullAndEmptyArrays": True } },
            # Join ke upaya peningkatan
            { "$lookup": { "from": "upaya_peningkatan", "localField": "upaya_peningkatan", "foreignField": "_id", "as": "upaya_peningkatan" } },
            # Exclude timestamps
            { "$project": { "createdAt": 0, "updatedAt": 0 } }
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
            if 'jenis_sumber_air' in sumber and sumber['jenis_sumber_air']:
                sumber['jenis_sumber_air']['_id'] = str(sumber['jenis_sumber_air'].get('_id', ''))

        return jsonify(sumbers), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500

# READ (GET by ID) - Mendapatkan data berdasarkan ID
@routes.route('/api/sumber_air_lookup_by_id/<id>', methods=['GET'])
def get_sumber_air_lookup_by_id(id):
    try:
        # Validasi apakah id valid sebagai ObjectId
        try:
            object_id = ObjectId(id)
        except InvalidId:
            return jsonify({"error": "Invalid ID format"}), 400

        pipeline = [
            # Filter by id
            { "$match": { "_id": object_id }},
            # Join ke jenis_sumber_air
            {"$lookup": { "from": "jenis_sumber_air", "localField": "id_jenis_sumber_air", "foreignField": "_id", "as": "jenis_sumber_air"}},
            # Join ke regencies (kabupaten)
            { "$lookup": { "from": "regencies", "localField": "id_kabupaten", "foreignField": "id_regency", "as": "kabupaten"}},
            { "$unwind": {"path": "$kabupaten", "preserveNullAndEmptyArrays": True}},
            # Join ke provinces (provinsi)
            { "$lookup": {"from": "provinces", "localField": "kabupaten.province_id", "foreignField": "id_province", "as": "provinsi"}},
            { "$unwind": { "path": "$provinsi", "preserveNullAndEmptyArrays": True }},
            # Join ke upaya peningkatan
            { "$lookup": { "from": "upaya_peningkatan", "localField": "upaya_peningkatan", "foreignField": "_id", "as": "upaya_peningkatan"}},
            # Exclude timestamps
            { "$project": {"createdAt": 0, "updatedAt": 0}}
        ]

        # Jalankan pipeline
        sumbers = list(mongo.sumber_air.aggregate(pipeline))

        if not sumbers:
            return jsonify({"error": "Data not found"}), 404

        sumber = sumbers[0]  # Ambil dokumen pertama karena hanya ada satu hasil

        # Konversi ObjectId dan nested ID ke string
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

        return jsonify(sumber), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500


# CREATE (POST by ID sumber_air) - menambahkan data sumber air
@routes.route('/api/sumber_air_create', methods=['POST'])
def add_water():
    try:
        # Ambil JSON data dari request
        data = request.get_json()

        # Validasi field wajib
        required_fields = [
            "nama_sumber_air", "kondisi_sumber_air", "suhu", "warna",
            "ph", "kelayakan", "id_jenis_sumber_air", "id_kabupaten"
        ]
        for field in required_fields:
            if field not in data or not data[field]:
                return jsonify({"error": f"Field '{field}' is missing or empty"}), 400

        # Konversi tipe data langsung
        try:
            nama_sumber_air = str(data['nama_sumber_air'])
            kondisi_sumber_air = str(data['kondisi_sumber_air'])
            suhu = int(data['suhu'])/10
            warna = str(data['warna'])
            ph = float(data['ph'])/10
            kelayakan = str(data['kelayakan'])
            id_jenis_sumber_air = ObjectId(data['id_jenis_sumber_air'])
            id_kabupaten = int(data['id_kabupaten'])
            foto_sumber_air = str(data.get('foto_sumber_air', ''))
            
            # Konversi upaya_peningkatan menjadi List of ObjectId
            upaya_peningkatan_raw = data.get('upaya_peningkatan', [])
            upaya_peningkatan = [ObjectId(upaya) for upaya in upaya_peningkatan_raw]
        except Exception as e:
            return jsonify({"error": f"Invalid data type: {str(e)}"}), 400

        # Persiapkan data untuk disimpan
        new_data = {
            "nama_sumber_air": nama_sumber_air,
            "kondisi_sumber_air": kondisi_sumber_air,
            "suhu": suhu,
            "warna": warna,
            "ph": ph,
            "kelayakan": kelayakan,
            "id_jenis_sumber_air": id_jenis_sumber_air,
            "id_kabupaten": id_kabupaten,
            "foto_sumber_air": foto_sumber_air,
            "upaya_peningkatan": upaya_peningkatan,
        }

        # Simpan ke MongoDB
        result = mongo.sumber_air.insert_one(new_data)

        # Berikan response dengan ID resource baru
        return jsonify({
            "message": "Sumber air added successfully",
            "id": str(result.inserted_id)
        }), 201

    except Exception as e:
        return jsonify({"error": str(e)}), 500

#UPDATE (PUT by ID sumber_air) - Update data sumber air
@routes.route('/api/sumber_air_update/<id>', methods=['PUT'])
def update_water(id):
    try:
        # Validate the ID format
        try:
            object_id = ObjectId(id)
        except InvalidId:
            return jsonify({"error": "Invalid ID format"}), 400

        # Get the updated data from the request body
        data = request.get_json()

        if not data:
            return jsonify({"error": "No data provided for update"}), 400

        # Define the required fields and their expected types
        required_fields = {
            "nama_sumber_air": str,
            "kondisi_sumber_air": str,
            "suhu": int,
            "warna": str,
            "ph": float,
            "kelayakan": str,
            "id_jenis_sumber_air": ObjectId,
            "id_kabupaten": int,
        }

        # Validate and convert data
        try:
            validated_data = {}
            for field, field_type in required_fields.items():
                if field in data and data[field]:
                    if field == "suhu":
                        # Convert to int and divide by 10
                        validated_data[field] = int(data[field]) / 10
                    elif field == "ph":
                        # Convert to float and divide by 10
                        validated_data[field] = float(data[field]) / 10
                    elif field_type == ObjectId:
                        validated_data[field] = ObjectId(data[field])
                    else:
                        validated_data[field] = field_type(data[field])
            
            # Optional fields
            if 'foto_sumber_air' in data:
                validated_data['foto_sumber_air'] = str(data['foto_sumber_air'])
            if 'upaya_peningkatan' in data:
                upaya_peningkatan_raw = data.get('upaya_peningkatan', [])
                validated_data['upaya_peningkatan'] = [
                    ObjectId(upaya) for upaya in upaya_peningkatan_raw
                ]
        except Exception as e:
            return jsonify({"error": f"Invalid data type: {str(e)}"}), 400

        # Update the document in MongoDB
        result = mongo.sumber_air.update_one(
            {"_id": object_id},  # Filter by the object ID
            {"$set": validated_data}  # Update the fields with new data
        )

        if result.matched_count == 0:
            return jsonify({"error": "Data not found for update"}), 404

        return jsonify({"message": "Sumber air updated successfully"}), 200

    except Exception as e:
        return jsonify({"error": str(e)}), 500


#DELETE (DELETE by ID Sumber_air) - Delete data sumber air
@routes.route('/api/sumber_air_delete/<id>', methods=['DELETE'])
def delete_water(id):
    try:
        # Validate the ID format
        try:
            object_id = ObjectId(id)
        except InvalidId:
            return jsonify({"error": "Invalid ID format"}), 400

        # Delete the document from MongoDB
        result = mongo.sumber_air.delete_one({"_id": object_id})

        if result.deleted_count == 0:
            return jsonify({"error": "Data not found for deletion"}), 404

        return jsonify({"message": "Sumber air deleted successfully"}), 200

    except Exception as e:
        return jsonify({"error": str(e)}), 500


# READ (GET by upaya) - Mendapatkan data berdasarkan upaya
@routes.route('/api/sumber_air_by_upayas', methods=['POST'])
def get_sumber_air_by_upayas():
    try:
        data = request.get_json()
        id_upayas = data.get('id_upayas', [])
        if not id_upayas:
            return jsonify({"error": "id_upayas is required"}), 400

        # Konversi id_upayas ke ObjectId
        from bson import ObjectId
        id_upayas_obj = [ObjectId(id_upaya) for id_upaya in id_upayas]

        # Query sumber air dengan filter id_upaya
        sumbers = mongo.sumber_air.find(
            {"upaya_peningkatan": {"$in": id_upayas_obj}},
            {"_id": 1, "nama_sumber_air": 1, "upaya_peningkatan": 1}
        )

        # Mengelompokkan hasil berdasarkan id_upaya
        result = {}
        for sumber in sumbers:
            for upaya in sumber['upaya_peningkatan']:
                upaya_id_str = str(upaya)
                if upaya_id_str not in result:
                    result[upaya_id_str] = []
                result[upaya_id_str].append({
                    "_id": str(sumber["_id"]),
                    "nama_sumber_air": sumber["nama_sumber_air"]
                })

        return jsonify(result), 200
    except Exception as e:
        return jsonify({"error": str(e)}), 500


# Jenis sumber air ----------------------------------------------------------------
# READ (GET) - Mendapatkan semua data
@routes.route('/api/jensisSA', methods=['GET'])
def get_jensisSA():
    jensisSAs = list(mongo.jenis_sumber_air.find({}, {"createdAt": 0, "updatedAt": 0}))  # Exclude timestamps
    for jensisSA in jensisSAs:
        jensisSA['_id'] = str(jensisSA['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(jensisSAs), 200

# READ (GET) - Mendapatkan semua data
@routes.route('/api/kabupaten', methods=['GET'])
def get_kabupaten():
    provinsi = request.args.get('provinsi')
    query = {}
    if provinsi:
        provinsi = int(provinsi)
        query = {"province_id": provinsi}  # Menyaring berdasarkan provinsi
    
    kabupatens = list(mongo.regencies.find(query, {"createdAt": 0, "updatedAt": 0}))  # Exclude timestamps
    for kabupaten in kabupatens:
        kabupaten['_id'] = str(kabupaten['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(kabupatens), 200

# READ (GET) - Mendapatkan semua data
@routes.route('/api/provinsi', methods=['GET'])
def get_provinsi():
    provinsis = list(mongo.provinces.find({}, {"createdAt": 0, "updatedAt": 0}))  # Exclude timestamps
    for provinsi in provinsis:
        provinsi['_id'] = str(provinsi['_id'])  # Konversi ObjectId ke string untuk JSON
    return jsonify(provinsis), 200

# Endpoint registrasi
@routes.route('/api/register', methods=['POST'])
def register():
    data = request.json
    if not data or not all(key in data for key in ('username', 'password')):
        return jsonify({"message": "Username and password are required."}), 400

    username = data['username']
    password = data['password']

    # Periksa apakah pengguna sudah terdaftar
    if mongo.admins.find_one({"username": username}):
        return jsonify({"message": "Username already exists."}), 400

    # Buat pengguna baru
    hashed_password = generate_password_hash(password)
    new_user = {
        "username": username,
        "password": hashed_password
    }

    mongo.admins.insert_one(new_user)
    return jsonify({"message": "User registered successfully."}), 201

# Endpoint login
@routes.route('/api/login', methods=['POST'])
def login():
    data = request.json
    if not data or not all(key in data for key in ('username', 'password')):
        return jsonify({"message": "Username and password are required."}), 400

    username = data['username']
    password = data['password']

    # Cari pengguna berdasarkan username
    user = mongo.admins.find_one({"username": username})
    if not user or not check_password_hash(user['password'], password):
        return jsonify({"message": "Invalid username or password."}), 401

    SECRET_KEY = 'sha256'
    # Buat token JWT
    token = jwt.encode({"user_id": str(user['_id']), "username": user['username']}, SECRET_KEY, algorithm="HS256")

    return jsonify({"message": "Login successful.", "token": token}), 200

# Endpoint logout
# @routes.route('/logout', methods=['GET'])
# def logout():
#     token = request.args.get('token')  # Ambil token dari query string
#     if not token:
#         return jsonify({"message": "Token is missing!"}), 401

#     try:
#         jwt.decode(token, SECRET_KEY, algorithms=["HS256"])
#     except jwt.ExpiredSignatureError:
#         return jsonify({"message": "Token has expired!"}), 401
#     except jwt.InvalidTokenError:
#         return jsonify({"message": "Invalid token!"}), 401

#     return jsonify({"message": "Logged out successfully!"}), 200




@routes.route('/protected', methods=['GET'])
@token_required
def protected_route():
    return jsonify({"message": "You have access to this route!"})