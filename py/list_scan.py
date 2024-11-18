import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

# Import SMBConnection
try:
    from smb.SMBConnection import SMBConnection
    print("SMBConnection imported successfully.<br/>")
except ImportError as e:
    print(f"Failed to import SMBConnection: {e}<br/>")
    sys.exit(1)

def scan_ip(ip):
    try:
        # Re-import SMBConnection explicitly in the function
        from smb.SMBConnection import SMBConnection

        # Establish the SMB connection with timeout
        conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True, is_direct_tcp=True)
        # conn = SMBConnection("", "", "my_client", "my_server", use_ntlm_v2=True)

        # Timeout is set to 5 seconds
        if conn.connect(ip, 445, timeout=2):
            print(f"\nConnected to SMB server at {ip}.<br/>")
            print("Available shares:<br/>")
            shares = conn.listShares()
            for share in shares:
                print(f"  - Share name: {share.name}, Type: {share.type}, Comment: {share.comments}<br/>")
        else:
            print(f"Could not connect to SMB server at {ip}.<br/>")
    except Exception as e:
        print(f"Error scanning {ip}: {e}<br/>")
    finally:
        # Ensure connection is closed properly
        try:
            conn.close()
        except Exception:
            pass

# Scan a range of IP addresses
for i in range(0, 180):  # Adjust range as needed
    scan_ip(f"192.168.62.{i}")
