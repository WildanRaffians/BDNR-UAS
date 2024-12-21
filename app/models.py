# Operasi CRUD

from app.database import mongo


# Contoh : 
# def get_all_items():
#     return list(mongo.db.items.find())

# def get_item_by_id(item_id):
#     return mongo.db.items.find_one({"_id": item_id})

# def add_item(data):
#     return mongo.db.items.insert_one(data)

# def update_item(item_id, data):
#     return mongo.db.items.update_one({"_id": item_id}, {"$set": data})

# def delete_item(item_id):
#     return mongo.db.items.delete_one({"_id": item_id})
