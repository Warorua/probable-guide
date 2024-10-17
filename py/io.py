import sys
import os
import base64


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from smb.SMBConnection import SMBConnection
from io import BytesIO

# Define the full path to the file
file_path = "/MockUP/06052020/export/export/app/TAIFA PAY Page 11.pdf"
ip = "192.168.0.17"
main_path = "NRS PROJECT"

# Extract the filename from the full path
filename = os.path.basename(file_path)

def retrieve_and_encode_file(ip, main_path, file_path):
    try:
        conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)
        conn.connect(ip, 139)

        # Use BytesIO to hold the file content in memory
        file_obj = BytesIO()

        # Retrieve the file content from the SMB share
        conn.retrieveFile(main_path, file_path, file_obj)

        # Move to the beginning of the BytesIO object before reading
        file_obj.seek(0)

        # Encode the file content to base64
        base64_encoded_data = base64.b64encode(file_obj.read()).decode('ascii')

        conn.close()
        return base64_encoded_data
    except Exception as e:
        print(f"Error retrieving and encoding file: {e}")
        return None

def decode_and_upload_file(base64_data, filename):
    if not base64_data:
        print("No data to upload.")
        return

    try:
        # Decode the base64 string into binary data
        binary_data = base64.b64decode(base64_data)

        # Connect to the SMB server
        conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)
        conn.connect("192.168.2.142", 445)

        # Upload the binary data to the shared folder
        with BytesIO(binary_data) as file_obj:
            conn.storeFile("HQ", f"2/{filename}", file_obj)

        conn.close()
        print("File uploaded successfully.")
    except Exception as e:
        print(f"Error decoding and uploading file: {e}")

def main():
    base64_data = retrieve_and_encode_file(ip, main_path, file_path)
    decode_and_upload_file(base64_data, filename)

if __name__ == "__main__":
    main()
