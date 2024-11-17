import sys
import os
from uuid import uuid4
from datetime import datetime
import math

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

from smbprotocol.connection import Connection
from smbprotocol.session import Session
from smbprotocol.tree import TreeConnect
from smbprotocol.open import Open
from smbprotocol.file_info import FileInformationClass

# Function to convert bytes to human-readable format
def convert_size(size_bytes):
    if size_bytes == 0:
        return "0 B"
    size_name = ("B", "KB", "MB", "GB", "TB", "PB")
    i = int(math.floor(math.log(size_bytes, 1024)))
    p = math.pow(1024, i)
    s = round(size_bytes / p, 2)
    return f"{s} {size_name[i]}"

try:
    # Generate a unique GUID for the connection
    guid = uuid4()

    # Create a connection
    connection = Connection(guid=guid, server_name="192.168.0.64", port=445, require_signing=True)
    connection.connect()

    # Create a session with guest access (username and password empty)
    session = Session(connection=connection, username="", password="")
    session.connect()

    # Connect to the tree (shared folder)
    tree = TreeConnect(session=session, share_name="\\\\192.168.0.64\\tools")
    tree.connect()

    # Open the shared directory
    directory = Open(tree, "", "rw")
    directory.create()

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

    # List directory contents
    for file_info in directory.query_directory("*"):
        file_type = 'Folder' if file_info.file_attributes.directory else 'File'
        file_size = convert_size(file_info.end_of_file)
        last_modified = datetime.fromtimestamp(file_info.last_write_time / 1e7 - 11644473600).strftime('%Y-%m-%d %H:%M:%S')

        html_table += f"""
            <tr>
                <td>{file_type}</td>
                <td>{file_info.file_name}</td>
                <td>{file_size}</td>
                <td>{last_modified}</td>
            </tr>
        """

    # Close the HTML table
    html_table += """
        </tbody>
    </table>
    """

    # Close everything
    directory.close()
    tree.disconnect()
    session.disconnect()
    connection.disconnect()

    # Print the table
    print(html_table)

except Exception as e:
    print(f"An error occurred: {e}")
