import base64

def encode_file_to_base64(file_path):
    try:
        # Open the file in binary mode
        with open(file_path, 'rb') as file:
            # Read the file content
            file_content = file.read()
        
        # Encode the content to base64
        encoded_content = base64.b64encode(file_content)
        
        # Convert the encoded bytes to a string
        encoded_str = encoded_content.decode('utf-8')
        
        return encoded_str

    except FileNotFoundError:
        print(f"File '{file_path}' not found.")
    except Exception as e:
        print(f"An error occurred: {e}")

# Specify the file path
file_path = '/home/super/HQ/1/mysql.py'  # Replace with the name of your file

# Encode the file and print the result
encoded_result = encode_file_to_base64(file_path)
if encoded_result:
    print(f"Base64 Encoded Result:\n{encoded_result}")
