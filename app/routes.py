# API endpoint
from flask import Blueprint, jsonify, request
from bson import ObjectId
from app.models import get_all_items, get_item_by_id, add_item, update_item, delete_item

# Contoh : 
# routes = Blueprint("routes", __name__)

# @routes.route("/items", methods=["GET"])
# def fetch_items():
#     items = get_all_items()
#     for item in items:
#         item["_id"] = str(item["_id"])
#     return jsonify(items)

# @routes.route("/item/<string:item_id>", methods=["GET"])
# def fetch_item(item_id):
#     item = get_item_by_id(ObjectId(item_id))
#     if item:
#         item["_id"] = str(item["_id"])
#         return jsonify(item)
#     return jsonify({"error": "Item not found"}), 404

# @routes.route("/item", methods=["POST"])
# def create_item():
#     data = request.json
#     result = add_item(data)
#     return jsonify({"_id": str(result.inserted_id)}), 201

# @routes.route("/item/<string:item_id>", methods=["PUT"])
# def update_item_details(item_id):
#     data = request.json
#     result = update_item(ObjectId(item_id), data)
#     return jsonify({"modified_count": result.modified_count})

# @routes.route("/item/<string:item_id>", methods=["DELETE"])
# def delete_item_details(item_id):
#     result = delete_item(ObjectId(item_id))
#     return jsonify({"deleted_count": result.deleted_count})
