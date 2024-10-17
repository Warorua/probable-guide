import sys
import os
import math


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from datetime import datetime
from smb.SMBConnection import SMBConnection

# Function to convert bytes to human-readable format
def convert_size(size_bytes):
    if size_bytes == 0:
        return "0 B"
    size_name = ("B", "KB", "MB", "GB", "TB", "PB")
    i = int(math.floor(math.log(size_bytes, 1024)))
    p = math.pow(1024, i)
    s = round(size_bytes / p, 2)
    return f"{s} {size_name[i]}"

# Create a connection object for Windows
conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True, is_direct_tcp=True)

# Connect to the SMB server
conn.connect("192.168.0.64", 445)

# List files in the shared folder
files = conn.listPath("tools", "/")

# Start HTML table
html_table = """
<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Type</th>
            <th>Filename</th>
            <th>Size</th>
            <th>Last Modified</th>
        </tr>
    </thead>
    <tbody>
"""

# Add rows to the table
for file in files:
    file_type = 'Folder' if file.isDirectory else 'File'
    file_size = convert_size(file.file_size)
    last_modified = datetime.fromtimestamp(file.last_write_time).strftime('%Y-%m-%d %H:%M:%S')
    html_table += f"""
        <tr>
            <td>{file_type}</td>
            <td>{file.filename}</td>
            <td>{file_size}</td>
            <td>{last_modified}</td>
        </tr>
    """

# Close the HTML table
html_table += """
    </tbody>
</table>
"""

# Close the connection
conn.close()

# Print the HTML table (or save to a file, render in a web page, etc.)
print(html_table)
