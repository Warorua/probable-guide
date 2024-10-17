import sys
import os
import base64

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from smb.SMBConnection import SMBConnection
from io import BytesIO

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

# Use BytesIO to hold the file content in memory
file_obj = BytesIO()

# Retrieve the file content from the SMB share
conn.retrieveFile("KNSDI", "/CODE/Philip/Search/knsdi/reg_add_db.py", file_obj)

# Move to the beginning of the BytesIO object before reading
file_obj.seek(0)

# Print the file content to the console
print(file_obj.read().decode('utf-8'))

#nonprintable
#print(base64.b64encode(file_obj.read()).decode('ascii'))

# Close the connection
conn.close()
