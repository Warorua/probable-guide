import base64
import sys
import io

# Example base64 encoded Python script (replace this with your encoded string)
base64_code = 'base64_encoded_file_content'

# Decode the base64 encoded string to get the Python script
decoded_code = base64.b64decode(base64_code).decode('utf-8')

# Redirect stdout to capture the output of the decoded script
old_stdout = sys.stdout
new_stdout = io.StringIO()
sys.stdout = new_stdout

try:
    # Execute the decoded Python code
    exec(decoded_code)
    
    # Get the output
    output = new_stdout.getvalue()
finally:
    # Reset stdout to the original
    sys.stdout = old_stdout

# Print only the output of the executed code
print(output)
