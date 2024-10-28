from smb.SMBConnection import SMBConnection
from smb.smb_structs import OperationFailure
import os

# Connection details
server_ip = "192.168.2.142"
username = ""  # Empty string for guest access
password = ""  # Empty string for guest access
share_name = "HQ"  # The shared folder on the server
client_name = "my-client"  # This can be anything, it's the name of the client (your script)
server_name = "my-server"  # The NetBIOS name of the server (if unknown, this can be the same as server_ip)

# Create SMB connection
try:
    # Establish an SMB connection using guest access (empty credentials)
    conn = SMBConnection(username, password, client_name, server_name, use_ntlm_v2=True)
    assert conn.connect(server_ip, 139)  # Connect to port 139 or 445

    # List contents of the share
    print(f"Contents of the '{share_name}' share:")
    shares = conn.listPath(share_name, "/")  # List the root of the share
    for file in shares:
        print(f"Name: {file.filename}, Type: {'Directory' if file.isDirectory else 'File'}")

    # Close the connection
    conn.close()

except OperationFailure as smb_error:
    print(f"SMB Error: {smb_error}")
except Exception as e:
    print(f"General Error: {e}")
