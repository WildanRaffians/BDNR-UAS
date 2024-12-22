from flask import Flask
from flask_swagger_ui import get_swaggerui_blueprint
from routes import routes

app = Flask(__name__)

# Swagger UI
SWAGGER_URL = '/swagger'
API_URL = '/static/api_specs.yaml'
swaggerui_blueprint = get_swaggerui_blueprint(SWAGGER_URL, API_URL, config={'app_name': "Product API"})
app.register_blueprint(swaggerui_blueprint, url_prefix=SWAGGER_URL)

# Register routes
app.register_blueprint(routes)

if __name__ == '__main__':
    app.run(debug=True)