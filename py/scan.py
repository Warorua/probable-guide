import sys
import os
import socket


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

from multiprocessing import Process, Queue
from smb.SMBConnection import SMBConnection
from nmb.NetBIOS import NetBIOS
import ipaddress

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

def list_shared_folders(ip_address):
    try:
        # Resolve the NetBIOS name with a timeout of 1 second
        netbios_name = resolve_netbios_name(ip_address, timeout=1)
        if not netbios_name:
            print(f"Unable to resolve NetBIOS name for IP: {ip_address}")
            return

        print(f"Resolved NetBIOS name: {netbios_name[0]}")

        # Establish an SMB connection with a timeout
        conn = SMBConnection("", "", "my_client", netbios_name[0], use_ntlm_v2=True)
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

def scan_ip_range(start_ip, end_ip):
    start_ip = ipaddress.ip_address(start_ip)
    end_ip = ipaddress.ip_address(end_ip)

    for ip in range(int(start_ip), int(end_ip) + 1):
        ip_str = str(ipaddress.ip_address(ip))
        print(f"Scanning IP: {ip_str}")
        list_shared_folders(ip_str)

# Replace with the target IP address range
start_ip = "192.168.1.1"
end_ip = "192.168.1.200"
#192.168.2.105
#192.168.100.5
#192.168.100.105
#192.168.100.113
#192.168.100.114
#192.168.100.132
#192.168.100.144
#192.168.100.145
#192.168.100.151
#192.168.100.152
#192.168.100.157
#192.168.22.5
#192.168.22.32
#192.168.22.37

scan_ip_range(start_ip, end_ip)
