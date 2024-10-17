import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))



from smb.SMBConnection import SMBConnection

# Connect to the SMB server
conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)
conn.connect("192.168.2.142", 445)

# Upload a file to the shared folder
with open("/home/super/HQ/1/remmm.zip", "rb") as file_obj:
    conn.storeFile("HQ", "/upp.zip", file_obj)

conn.close()
