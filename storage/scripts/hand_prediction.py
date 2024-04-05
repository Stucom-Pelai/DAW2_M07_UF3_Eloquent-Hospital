import sys
import tensorflow as tf

def load_and_preprocess_image(image_path):
    img = tf.io.read_file(image_path)
    img = tf.image.decode_image(img, channels=3)
    img = tf.image.resize(img, [150, 150])
    img = img / 255.0
    return img

# Función para predecir si una imagen de mano está rota o no
def predict_hand_fracture(image_path):
    # Cargar el modelo previamente entrenado desde el archivo
    model_path = 'hand_fracture_detection_model.h5'
    model = tf.keras.models.load_model(model_path)

    # Cargar y preprocesar la imagen
    img = load_and_preprocess_image(image_path)
    img = tf.expand_dims(img, axis=0)  # Añadir una dimensión adicional para batch

    # Realizar la predicción
    prediction = model.predict(img)[0][0]

    # Calcular el porcentaje de probabilidad de que la mano esté rota
    fracture_percentage = (1 - prediction) * 100
    not_fracture_percentage = prediction * 100

    # Imprimir el resultado
    print(f'Probabilidad de mano rota: {fracture_percentage:.2f}%')
    print(f'Probabilidad de mano no rota: {not_fracture_percentage:.2f}%')
    # print(sys.argv[1])
# Obtener el nombre de la imagen del primer argumento de la línea de comandos
image_path = sys.argv[1]
predict_hand_fracture(image_path)
