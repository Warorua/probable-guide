import sys
import os
import fnmatch


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from smb.SMBConnection import SMBConnection

def search_files_with_pattern(conn, share_name, directory, pattern):
    matching_files = []
    files = conn.listPath(share_name, directory)
    for file in files:
        if file.isDirectory:
            # Skip the current and parent directory entries
            if file.filename not in ['.', '..']:
                # Recursively search in subdirectories
                subdir_files = search_files_with_pattern(conn, share_name, os.path.join(directory, file.filename), pattern)
                matching_files.extend(subdir_files)
        elif fnmatch.fnmatch(file.filename, pattern):
            # File matches the pattern
            matching_files.append(os.path.join(directory, file.filename))
    return matching_files

############WINS
# Create a connection object
#conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True, is_direct_tcp=True)
# Connect to the SMB server
#conn.connect("192.168.0.64", 445)

############LIN
# Create a connection object
conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)
# Connect to the SMB server
conn.connect("192.168.1.6", 139)

# Specify the share name and the pattern you're looking for
share_name = "KNSDI"
pattern = "*.py"  # Search for all PDF files

# Search for files matching the pattern starting from the root directory
matching_files = search_files_with_pattern(conn, share_name, "/", pattern)

if matching_files:
    for file in matching_files:
        print(f"Found: {file}")
else:
    print(f"No files matching '{pattern}' found.")

# Close the connection
conn.close()
