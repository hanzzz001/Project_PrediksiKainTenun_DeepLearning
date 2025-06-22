from flask import Flask, request, jsonify
import tensorflow as tf
from tensorflow.keras.models import load_model
from PIL import Image
from flask_cors import CORS
import numpy as np

app = Flask(__name__)
CORS(app, origins=["http://127.0.0.1:8000"])
model = load_model('mobilenetv2_tenun_model.h5')  # Ganti dengan nama file model kamu

class_names = ['Bali', 'Barat', 'Lombok', 'Palembang', 'Riau']

def preprocess_image(image):
    image = image.resize((224, 224))
    image = np.array(image) / 255.0
    image = np.expand_dims(image, axis=0)
    return image

@app.route('/predict', methods=['POST'])
def predict():
    if 'image' not in request.files:
        return jsonify({'error': 'No image uploaded'}), 400

    image_file = request.files['image']
    image = Image.open(image_file.stream).convert('RGB')
    processed_image = preprocess_image(image)

    prediction = model.predict(processed_image)[0]
    predicted_index = np.argmax(prediction)
    predicted_label = class_names[predicted_index]
    confidence = round(float(prediction[predicted_index]) * 100, 2)

    return jsonify({
        'label': predicted_label,
        'accuracy': confidence
    })

if __name__ == '__main__':
    app.run(port=5000)
