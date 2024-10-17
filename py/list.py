import sys
import os

# Add the directories containing smbprotocol and spnego to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))
#sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages/spnego')))  # Adjust path as needed

from smbprotocol.connection import Connection
from smbprotocol.session import Session
from smbprotocol.tree import TreeConnect
from smbprotocol.open import Open
import uuid

# Connection details
server_ip = "192.168.2.142"
username = ""  # Empty string for guest access
password = ""  # Empty string for guest access
share_name = "HQ"  # Example: "SharedFolder"

# Establish connection
connection = Connection(uuid.uuid4(), server_ip)
connection.connect()

# Start session with empty credentials
session = Session(connection, username, password)
session.connect()

# Access the share
tree = TreeConnect(session, f"\\\\{server_ip}\\{share_name}")
tree.connect()

# Open the directory
directory = Open(tree, "")
directory.create()

# List contents of the directory
for item in directory.query_directory("*"):
    print(f"Name: {item.file_name}, Type: {item.file_attributes}")

# Cleanup
directory.close()
tree.disconnect()
session.disconnect()
connection.disconnect()
