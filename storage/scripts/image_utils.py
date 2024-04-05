import tensorflow as tf

def load_and_preprocess_image(image_path):
    img = tf.io.read_file(image_path)
    img = tf.image.decode_image(img, channels=3)  # Decode image with unspecified format
    img = tf.image.resize(img, [150, 150])
    img = img / 255.0
    return img
