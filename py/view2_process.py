import requests  # Ensure this is included at the top of your script

def manual_urlencode(command):
    """Manually encode a SQL command for use in a URL."""
    return (
        command.replace(" ", "%20")
               .replace("`", "%60")
               .replace("=", "%3D")
               .replace("'", "%27")
               .replace("\"", "%22")
               .replace("<", "%3C")
               .replace(">", "%3E")
               .replace("#", "%23")
               .replace("{", "%7B")
               .replace("}", "%7D")
               .replace("|", "%7C")
               .replace("\\", "%5C")
               .replace("^", "%5E")
               .replace("~", "%7E")
               .replace("[", "%5B")
               .replace("]", "%5D")
               .replace(";", "%3B")
               .replace("/", "%2F")
               .replace("?", "%3F")
               .replace(":", "%3A")
               .replace("@", "%40")
               .replace("&", "%26")
               .replace("=", "%3D")
               .replace("+", "%2B")
               .replace("$", "%24")
               .replace(",", "%2C")
               .replace("%", "%25")
               .replace("\n", "%0A")
               .replace("\r", "%0D")
    )

# Example usage with a pre-encoded command
#cmd = "--XMX--"
cmd = "SELECT * FROM `transactions` ORDER BY id DESC LIMIT 500 OFFSET 0"
url = f'http://192.168.2.142:8080/aggregate/my.jsp?dbHost=192.168.0.65&dbName=upgw&dbUser=root&dbPassword=happycoding&dbPort=3306&sqlCommand={cmd}'

try:
    # Directly make the HTTP GET request
    response = requests.get(url)
    response.raise_for_status()  # Will raise an HTTPError if the HTTP request returned an unsuccessful status code
    data = response.text

    # Print the formatted response
    print(f'<h2>head</h2>{data}<br/><br/><br/><br/>')

except requests.exceptions.RequestException as e:
    print(f"HTTP request failed: {e}")
