import subprocess
import sys
import os


def install_package(package):
    try:
        subprocess.check_call([sys.executable, "-m", "pip", "install", package, "--user"])
    except subprocess.CalledProcessError as e:
        print(f"Failed to install {package}. Error: {e}")

def import_module(import_name):
    try:
        return __import__(import_name)
    except ImportError as e:
        print(f"Failed to import {import_name}. Error: {e}")
        return None

# Install necessary packages
#      install_package('opencv-python')
# install_package('numpy')

# Import necessary modules after ensuring they are installed
cv2 = import_module('cv2')
np = import_module('numpy')

if not cv2 or not np:
    print("Failed to import necessary modules.")
    sys.exit(1)

# Get the database directory from command line arguments
if len(sys.argv) < 2:
    print("No database directory provided.")
    sys.exit(1)

database_dir = sys.argv[1]

# Load the first face recognition model
model_file1 = 'opencv_face_detector_uint8.pb'
config_file1 = 'opencv_face_detector.pbtxt'
net1 = cv2.dnn.readNetFromTensorflow(model_file1, config_file1)

# Load the second face recognition model
model_file2 = 'res10_300x300_ssd_iter_140000_fp16.caffemodel'
config_file2 = 'deploy.prototxt'
net2 = cv2.dnn.readNetFromCaffe(config_file2, model_file2)

# Define a function to extract facial features from an image using the ResNet model
def extract_features(image):
    if image is None:
        print("Error: Image not loaded properly.")
        return None

    # Convert the image to RGB
    rgb = cv2.cvtColor(image, cv2.COLOR_BGR2RGB)

    # Detect faces in the image
    net2.setInput(cv2.dnn.blobFromImage(rgb, 1.0, (300, 300), [104.0, 177.0, 123.0], False, False))
    detections = net2.forward()

    features_list = []
    h, w = rgb.shape[:2]
    for i in range(detections.shape[2]):
        confidence = detections[0, 0, i, 2]
        if confidence > 0.5:
            box = detections[0, 0, i, 3:7] * np.array([w, h, w, h])
            (x, y, x1, y1) = box.astype("int")

            face = rgb[y:y1, x:x1]
            if face.size == 0:
                continue

            # Resize the face to a fixed size
            target_size = (160, 160)
            resized = cv2.resize(face, target_size)

            # Preprocess the image for the ResNet model
            mean = np.array([127.5, 127.5, 127.5])
            std = np.array([128.0, 128.0, 128.0])
            normalized = (resized - mean) / std
            transposed = np.transpose(normalized, (2, 0, 1))
            batched = np.expand_dims(transposed, axis=0)

            # Run the image through the ResNet model to extract facial features
            net1.setInput(batched)
            features = net1.forward().flatten()

            # Normalize the features to be between -1 and 1
            features /= np.linalg.norm(features)
            features_list.append(features)

    return features_list

# Load the input face image
input_img = cv2.imread(os.path.join(database_dir, 'search.jpg'))
if input_img is None:
    print("Error: Input image not loaded properly.")
    sys.exit(1)

# Extract the facial features from the input image
input_features_list = extract_features(input_img)

if input_features_list is None:
    print("Failed to extract features from input image.")
    sys.exit(1)

# Initialize a set to keep track of unique matches
unique_matches = set()

# Define allowed image extensions
allowed_extensions = {'.jpg', '.jpeg', '.png', '.gif'}

# Loop over all files in the directory
for filename in os.listdir(database_dir):
   
    if filename in {'search.jpg', 'cover.jpg','search.jpeg'}:
        continue

    # Check if the file has an allowed extension
    if not any(filename.lower().endswith(ext) for ext in allowed_extensions):
        continue

    # Load the current image
    current_img = cv2.imread(os.path.join(database_dir, filename))
    if current_img is None:
        print(f"Error: Failed to load image {filename}")
        continue

    # Extract the facial features from the current image
    current_features_list = extract_features(current_img)

    if current_features_list is None:
        continue

    # Compare each face in the input image with each face in the current image
    for input_features in input_features_list:
        for current_features in current_features_list:
            # Calculate the cosine distance between the features of the input and current images
            distance = np.dot(input_features, current_features)

            # If the distance is above the threshold, add it to the matches set
            if distance > 0.95:
                unique_matches.add(filename)

# Check if any matches were found
if not unique_matches:
    print("No match found.")
else:
    # Print the filenames of the unique matches
    for filename in unique_matches:
        print(filename)
