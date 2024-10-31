import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './env2/Lib/site-packages')))


from smbprotocol.connection import Connection
from smbprotocol.session import Session
from smbprotocol.tree import TreeConnect
from smbprotocol.open import Open

# Establish an SMB connection using smbprotocol
connection = Connection(uuid=None, server="192.168.0.64", port=445)
connection.connect()

# Start a session (no credentials for guest access)
session = Session(connection, username="", password="")
session.connect()

# Connect to the SMB shared folder
tree = TreeConnect(session, "//192.168.0.64/tools")
tree.connect()

# Open the root directory of the share
directory = Open(tree, "")
directory.create()

# List files in the root directory of the share
files = directory.query_directory("*")

for file_info in files:
    print(f"File: {file_info.file_name}")

# Clean up connections
directory.close()
tree.disconnect()
session.disconnect()
connection.disconnect()
