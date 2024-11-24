import os

# Execute the command (ls for Unix/Linux/macOS, dir for Windows)
json_payload = '''{
    "apiKey": "qnKbnreKqcnjMaAw",
    "type": null,
    "billNumber": "BL-UBP-198824",
    "billAmount": 7500.0,
    "phone": "null",
    "transactionDate": "2024-11-20T00:00:00",
    "Field1": null,
    "Field2": null,
    "Field3": null,
    "Field4": null,
    "Field5": null,
    "bankdetails": {
        "accountNumber": "BL-UBP-198824",
        "bankName": "Cooperative Bank",
        "debitAccount": "21000335",
        "debitCustName": "UBP Application No TLA204473 - 2020_429332",
        "bankReference": "S70713602_20112024",
        "customerReference": "CASH ",
        "paymentMode": "Cash"
    },
    "mpesadetails": null
}'''


# Escape the payload for the curl command
command = f"curl -X POST http://192.168.100.116/gateway/taifa/nrs/affirm -H 'Content-Type: application/json' -d '{json_payload}'"
stream = os.popen(command)


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
