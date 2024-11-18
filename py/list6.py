import sys
import os
import math
from datetime import datetime

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

from smb.SMBConnection import SMBConnection

try:
    # Establish the SMB connection
    conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True, is_direct_tcp=True)
    connected = conn.connect('192.168.0.64', 445)
    if not connected:
        raise Exception("Failed to connect to the SMB server.")

    print("Connected to SMB server successfully.")

    # List all available shares
    shares = conn.listShares()
    print("Available shares:")
    for share in shares:
        print(f"Share name: {share.name}, Type: {share.type}, Comment: {share.comments}")

except Exception as e:
    print(f"An error occurred: {e}")
    
