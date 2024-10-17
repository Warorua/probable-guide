import requests

# Send the HTTP GET request
response = requests.get('http://192.168.2.156')

# Print the status code
print("Status Code:", response.status_code)

# Print the response headers
print("\nHeaders:\n")
for header, value in response.headers.items():
    print(f"{header}: {value}")

# Print the response body
print("\nBody:\n")
print(response.text)
