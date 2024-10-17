import sys
import os


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from smb.SMBConnection import SMBConnection

def search_file(conn, share_name, directory, target_file):
    files = conn.listPath(share_name, directory)
    for file in files:
        if file.isDirectory:
            # Skip the current and parent directory entries
            if file.filename not in ['.', '..']:
                # Recursively search in subdirectories
                found = search_file(conn, share_name, os.path.join(directory, file.filename), target_file)
                if found:
                    return found
        elif file.filename == target_file:
            # File found
            print(f"File found: {os.path.join(directory, file.filename)}")
            return os.path.join(directory, file.filename)
    return None

# Create a connection object
conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)

# Connect to the SMB server
conn.connect("192.168.1.6", 139)

# Specify the share name and the file you're looking for
share_name = "KNSDI"
target_file = "example.txt"

# Search for the file starting from the root directory
result = search_file(conn, share_name, "/", target_file)

if result:
    print(f"File '{target_file}' found at: {result}")
else:
    print(f"File '{target_file}' not found.")

# Close the connection
conn.close()
