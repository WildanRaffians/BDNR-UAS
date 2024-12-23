import jwt
from functools import wraps
from flask import request, jsonify

SECRET_KEY = 'sha256'

def token_required(f):
    @wraps(f)
    def decorated(*args, **kwargs):
        token = None

        # Periksa apakah token diberikan melalui header
        if 'Authorization' in request.headers:
            token = request.headers['Authorization'].split(" ")[1]  # Ambil token setelah "Bearer"

        if not token:
            return jsonify({"message": "Token is missing!"}), 401

        try:
            # Decode dan verifikasi token
            data = jwt.decode(token, SECRET_KEY, algorithms=["HS256"])
            request.user = data  # Simpan informasi token untuk digunakan di endpoint
        except jwt.ExpiredSignatureError:
            return jsonify({"message": "Token has expired!"}), 401
        except jwt.InvalidTokenError:
            return jsonify({"message": "Invalid token!"}), 401

        return f(*args, **kwargs)
    return decorated
