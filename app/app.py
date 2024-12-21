# Untuk Run API
from flask import Flask
from app.routes import routes
from app.database import init_db

app = Flask(__name__)

# Inisialisasi database
init_db(app)

# Register blueprint
app.register_blueprint(routes)

if __name__ == "__main__":
    app.run(debug=True, host="0.0.0.0", port=5000)
