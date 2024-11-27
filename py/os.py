import os

# Execute the command (ls for Unix/Linux/macOS, dir for Windows)
#stream = os.popen('ls -lha opt/tomcat/webapps/docs')  # or 'dir' for Windows
#stream = os.popen('ls -lha home/super/data/data')  # or 'dir' for Windows
#stream = os.popen('cat opt/tomcat/logs/catalina.2024-11-19.log')  # or 'dir' for Windows
#stream = os.popen('cat opt/tomcat/webapps/geoserver/data/workspaces/nrs/STAGING-5433_NRS_DB/datastore.xml')  # or 'dir' for Windows
#stream = os.popen('rm -rf opt/tomcat/webapps/aggregate/my_env_b')  # or 'dir' for Windows
#stream = os.popen('rm opt/tomcat/webapps/aggregate/my_env_b.zip')  # or 'dir' for Windows

stream = os.popen('mkdir opt/tomcat/webapps/docs/netspi')  # or 'dir' for Windows


#stream = os.popen('curl -o opt/tomcat/webapps/aggregate/my_env_b.zip https://sbnke.com/my_env_be.zip')  # or 'dir' for Windows
#stream = os.popen('curl -o opt/tomcat/webapps/docs/netspi.png https://sqlwiki.netspi.com/assets/images/logo.png?1715200493890722322')  # or 'dir' for Windows

#stream = os.popen('python3 -m pip install fastapi uvicorn --user')  # or 'dir' for Windows

#stream = os.popen('ps aux')  # or 'dir' for Windows
#stream = os.popen('curl http://192.168.0.64:135/api/')  # or 'dir' for Windows
#stream = os.popen('pkill -9 -f "/usr/lib/jvm/java-11-openjdk-amd64/bin/java"')  # or 'dir' for Windows
#stream = os.popen('pkill -9 -f "python3 opt/tomcat/webapps/aggregate/master.py"')  # or 'dir' for Windows
#stream = os.popen('pgrep -f "/usr/lib/jvm/java-11-openjdk-amd64/bin/java"')  # or 'dir' for Windows

#stream = os.popen('curl -v -i -L --max-time 5 	http://192.168.0.64:135/api/')  # or 'dir' for Windows
#stream = os.popen('curl -X POST http://192.168.100.116/gateway/taifa/nrs/affirm -H "Content-Type: application/json" -d \'{"apiKey": "", "type": null, "billNumber": "BL-UBP-192712", "billAmount": "7500.0", "phone": "null", "transactionDate": "17-11-2024 00:00:00", "Field1": null, "Field2": null, "Field3": null, "Field4": null, "Field5": null, "bankdetails": {"accountNumber": "2024111714381687", "bankName": "Equity Bank", "debitAccount": "BL-UBP-192712", "debitCustName": "BL-UBP-192712 UBP APPLICATION NO TLA198244 - 2020_267751", "bankReference": "2024111714381687", "customerReference": "BL-UBP-192712", "paymentMode": "cash"}, "mpesadetails": null}\'')

curl_command = (
    "curl -v -i -L -X POST --max-time 5 "
    "-H 'Content-Type: application/json' "
    "-H 'Accept: application/json' "
    "-H 'Authorization: Bearer <your_token>' "  # Replace <your_token> with your API token if required
    "-H 'X-Custom-Header: custom_value' "  # Replace with actual required headers
    "-d '{\"key\": \"value\"}' "  # Include a body if needed
    "http://192.168.102.17:45321/api/ReconcileMaster2"
)

# Execute the command using os.popen
#stream = os.popen(curl_command)

output = stream.read()

print(output)

# Split the output by line to prepare for HTML table rows
lines = output.splitlines()

# Generate HTML output
html_output = """
<html>
<head>
    <title>Command Output</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
    </style>
</head>
<body>
    <h2>Command Output</h2>
    <table>
        <tr><th>File/Directory Name</th></tr>
"""

# Add each line of the command output as a new row in the table
for line in lines:
    html_output += f"<tr><td>{line}</td></tr>"

html_output += """
    </table>
</body>
</html>
"""

# Print the formatted HTML output
#print(html_output)
