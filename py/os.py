import os

# Execute the command (ls for Unix/Linux/macOS, dir for Windows)
#stream = os.popen('ls -lha opt/tomcat/.local/lib/python3.6/site-packages')  # or 'dir' for Windows
#stream = os.popen('rm opt/tomcat/webapps/aggregate/env2.zip')  # or 'dir' for Windows
#stream = os.popen('python3 -m pip install fastapi uvicorn --user')  # or 'dir' for Windows
stream = os.popen('python3 -m pip install fastapi uvicorn --user')  # or 'dir' for Windows

#stream = os.popen('ps aux')  # or 'dir' for Windows
#stream = os.popen('pkill -9 -f "/usr/lib/jvm/java-11-openjdk-amd64/bin/java"')  # or 'dir' for Windows
#stream = os.popen('pgrep -f "/usr/lib/jvm/java-11-openjdk-amd64/bin/java"')  # or 'dir' for Windows


output = stream.read()

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
print(html_output)
