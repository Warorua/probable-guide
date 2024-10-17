import base64

def decode_base64_to_file(encoded_content, output_file_path):
    try:
        # Decode the Base64 encoded string into binary data
        binary_data = base64.b64decode(encoded_content)

        # Write the binary data to a file
        with open(output_file_path, "wb") as file:
            file.write(binary_data)

        print(f"File successfully saved to {output_file_path}")
    except Exception as e:
        print(f"Error: {e}")

# Example usage
# Replace this with your actual Base64 encoded string
encoded_content = "xxxxxx"

# Specify the output file path
output_file_path = "03-0036.docx"

decode_base64_to_file(encoded_content, output_file_path)
