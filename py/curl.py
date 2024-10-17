import requests
from requests.auth import HTTPBasicAuth

# Define the URL
url = "http://192.168.0.64:6063/upgw/WS/UPGW/Codeunit/"

# Define the credentials
username = "Administrator"
password = "$tn3my@p$"
domain = ""

# Enable debug logging
import logging
logging.basicConfig(level=logging.DEBUG)

# Make the GET request with Basic Authentication
response = requests.get(url, auth=HTTPBasicAuth(username, password))

# Check the response status
if response.status_code == 200:
    print("Request was successful!")
    print("Response content:")
    print(response.text)
else:
    print(f"Failed with status code: {response.status_code}")
    print("Response headers:")
    print(response.headers)
    print("Response content:")
    print(response.text)
