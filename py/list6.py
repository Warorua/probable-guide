import sys
import os
import math
from datetime import datetime

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

from smb.SMBConnection import SMBConnection

# Connect to the SMB server
conn = SMBConnection(
    username='',  # Leave empty for guest access
    password='',  # Leave empty for guest access
    my_name='client_machine',  # Arbitrary client machine name
    remote_name='192.168.0.64',  # Server name or IP
    use_ntlm_v2=True  # Enable NTLMv2 (recommended)
)

# Connect to the server
connected = conn.connect('192.168.0.64', 445)  # SMB port is 445
if connected:
    print("Connected successfully!")

    # List shares
    shares = conn.listShares()
    for share in shares:
        print(f"Share: {share.name}")

        # If the share is 'tools', list files
        if share.name == 'tools':
            files = conn.listPath('tools', '/')
            for file in files:
                print(f"File: {file.filename}, Size: {file.file_size}")

    # Close the connection
    conn.close()
else:
    print("Failed to connect to the SMB server.")
