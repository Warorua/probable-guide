import sys
import os
import socket


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from multiprocessing import Process, Queue
from smb.SMBConnection import SMBConnection
from nmb.NetBIOS import NetBIOS

def resolve_netbios_name_worker(ip_address, queue):
    netbios = NetBIOS()
    try:
        netbios_name = netbios.queryIPForName(ip_address)
        queue.put(netbios_name)
    except Exception as e:
        queue.put(None)
    finally:
        netbios.close()

def resolve_netbios_name(ip_address, timeout):
    queue = Queue()
    process = Process(target=resolve_netbios_name_worker, args=(ip_address, queue))
    process.start()
    process.join(timeout)

    if process.is_alive():
        process.terminate()  # Forcefully terminate the process if it exceeds the timeout
        process.join()
        print(f"Timeout occurred while resolving NetBIOS name for IP: {ip_address}")
        return None

    return queue.get()

def list_shared_folders(ip_address, username, password):
    try:
        # Resolve the NetBIOS name with a timeout of 1 second
        netbios_name = resolve_netbios_name(ip_address, timeout=1)
        if not netbios_name:
            print(f"Unable to resolve NetBIOS name for IP: {ip_address}")
            return

        print(f"Resolved NetBIOS name: {netbios_name[0]}")

        # Establish an SMB connection with a timeout
        conn = SMBConnection(username, password, "my_client", netbios_name[0], use_ntlm_v2=True)
        conn.connect(ip_address, 139, timeout=1)

        # List shared folders
        shares = conn.listShares()
        print(f"Shared folders on {ip_address}:")
        for share in shares:
            print(f"- {share.name}")

        conn.close()
    except socket.timeout:
        print(f"Timeout occurred while trying to connect to {ip_address}")
    except Exception as e:
        print(f"Error: {e}")

# Replace with the target IP address
ip_address = "192.168.100.5"

# Replace with the correct username and password for the SMB server
username = "super"
password = ""

# Scan the single IP address
print(f"Scanning IP: {ip_address}")
list_shared_folders(ip_address, username, password)
