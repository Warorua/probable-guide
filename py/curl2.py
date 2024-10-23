import urllib.request
import urllib.parse

url = 'https://dgmbmgjxgnczpetprmxfs1utu4hreiiek.oast.fun'

# Data to be sent in the POST request
data = {
    'name': 'Alice',
    'age': 30
}

# Encode the data
encoded_data = urllib.parse.urlencode(data).encode('utf-8')

# Make the POST request
response = urllib.request.urlopen(url, data=encoded_data)

# Read and print the response
response_data = response.read().decode('utf-8')
print(response_data)
