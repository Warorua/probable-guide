import requests

# Proxy settings
proxies = {
    'http': 'http://192.168.2.134:8080',   # Proxy for HTTP
    'https': 'http://192.168.2.134:8080',  # Proxy for HTTPS (CONNECT method will be used here)
}

# HTTPS URL of the destination (this will trigger the CONNECT method through the proxy)
url = 'https://192.168.2.103/login'

# Send the HTTPS request through the proxy, which uses CONNECT method for HTTPS
try:
    response = requests.get(url, proxies=proxies, verify=False)
    print(response.status_code)
    print(response.text)
except requests.exceptions.SSLError as e:
    print(f'SSL error: {e}')
