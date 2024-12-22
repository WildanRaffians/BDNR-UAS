# API endpoint
from flask import Blueprint, jsonify, request
from bson import ObjectId
from database import mongo  # Pastikan impor ini sesuai dengan struktur folder Anda

routes = Blueprint("routes", __name__)

@routes.route("/", methods=["GET"])
def home():
    """Halaman utama."""
    return jsonify({"message": "Welcome to the Water API!"})


# UPAYA ----------------------------------------------------------------------------------------------

@routes.route("/upaya", methods=["GET"])
def get_all_upaya():
    """Mengambil semua data upaya."""
    upaya = list(mongo.upaya_pelestarian_sumber_air.find())  # Gunakan 'mongo.upaya_pelestarian_sumber_air'
    for u in upaya:
        u["_id"] = str(u["_id"])  # Ubah ObjectId ke string untuk JSON
    return jsonify(upaya)

@routes.route("/upaya/<int:id_upaya>", methods=["GET"])
def get_upaya_by_id(id_upaya):
    """Mengambil data upaya berdasarkan id_upaya_ketersediaan_air."""
    upaya = mongo.db.upaya_pelestarian_sumber_air.find_one({"id_upaya_ketersediaan_air": id_upaya})
    if upaya:
        upaya["_id"] = str(upaya["_id"])
        return jsonify(upaya)
    return jsonify({"error": "Upaya not found"}), 404

@routes.route("/upaya", methods=["POST"])
def create_upaya():
    """Menambahkan data upaya baru."""
    data = request.json
    result = mongo.db.upaya_pelestarian_sumber_air.insert_one(data)
    return jsonify({"_id": str(result.inserted_id)}), 201

@routes.route("/upaya/<int:id_upaya>", methods=["PUT"])
def update_upaya(id_upaya):
    """Memperbarui data upaya."""
    data = request.json
    result = mongo.db.upaya_pelestarian_sumber_air.update_one(
        {"id_upaya_ketersediaan_air": id_upaya}, {"$set": data}
    )
    if result.matched_count > 0:
        return jsonify({"message": "Upaya updated successfully"}), 200
    return jsonify({"error": "Upaya not found"}), 404

@routes.route("/upaya/<int:id_upaya>", methods=["DELETE"])
def delete_upaya(id_upaya):
    """Menghapus data upaya berdasarkan id_upaya_ketersediaan_air."""
    result = mongo.db.upaya_pelestarian_sumber_air.delete_one({"id_upaya_ketersediaan_air": id_upaya})
    if result.deleted_count > 0:
        return jsonify({"message": "Upaya deleted successfully"}), 200
    return jsonify({"error": "Upaya not found"}), 404