import zipfile
import os
import base64
import io

# Base64-encoded ZIP file (example placeholder, replace with your actual Base64 string)
base64_zip_string = "<your_base64_zip_string_here>"

# Decode the Base64 string to get the ZIP file bytes
try:
    zip_file_bytes = base64.b64decode(base64_zip_string)
except Exception as e:
    print(f"Error decoding Base64 string: {e}")
    exit(1)

# Create a BytesIO object from the decoded bytes
zip_file_io = io.BytesIO(zip_file_bytes)

# Path to extract the contents of the ZIP file
extract_path = '/opt/tomcat/webapps/aggregate/myenv/Lib/site-packages/'

# Ensure the extraction path exists
if not os.path.exists(extract_path):
    os.makedirs(extract_path)

try:
    # Open the ZIP file from the BytesIO object and extract its contents
    with zipfile.ZipFile(zip_file_io, 'r') as zip_ref:
        zip_ref.extractall(extract_path)
    print("All files extracted successfully.")
except zipfile.BadZipFile:
    print("Error: The file is not a valid ZIP file.")
except Exception as e:
    print(f"An error occurred: {e}")
