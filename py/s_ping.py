import sys
import os
import socket
import subprocess

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))


from multiprocessing import Process, Queue
from nmb.NetBIOS import NetBIOS

# Function to check if an IP address is alive
def is_ip_alive(ip_address, timeout=1):
    try:
        # Using subprocess to ping the IP
        result = subprocess.run(['ping', '-c', '1', '-W', str(timeout), ip_address],
                                stdout=subprocess.DEVNULL)
        return result.returncode == 0
    except Exception as e:
        print(f"Error pinging IP {ip_address}: {e}")
        return False

# Function to check if a port is open
def is_port_open(ip_address, port, timeout=1):
    try:
        with socket.create_connection((ip_address, port), timeout=timeout):
            return True
    except (socket.timeout, ConnectionRefusedError):
        return False
    except Exception as e:
        print(f"Error checking port {port} on {ip_address}: {e}")
        return False

# Worker function to resolve NetBIOS name with timeout control
def resolve_netbios_name_worker(ip_address, queue):
    netbios = NetBIOS()
    try:
        netbios_name = netbios.queryIPForName(ip_address)
        queue.put(netbios_name)
    except Exception as e:
        queue.put(None)
    finally:
        netbios.close()

# Function to resolve the NetBIOS name with timeout
def resolve_netbios_name(ip_address, timeout=1):
    queue = Queue()
    process = Process(target=resolve_netbios_name_worker, args=(ip_address, queue))
    process.start()
    process.join(timeout)

    if process.is_alive():
        process.terminate()  # Forcefully terminate the process if it exceeds the timeout
        process.join()
        return None

    return queue.get()

# Main function to perform the checks
def scan_ip(ip_address, ports):
    print(f"Scanning IP: {ip_address}")

    # Check if the IP is alive
    if not is_ip_alive(ip_address):
        print(f"IP {ip_address} is not alive.")
        return

    print(f"IP {ip_address} is alive.")

    # Check the specified ports
    for port in ports:
        if is_port_open(ip_address, port):
            print(f"Port {port} on {ip_address} is open.")
        else:
            print(f"Port {port} on {ip_address} is closed or not reachable.")

    # Resolve the NetBIOS name
    netbios_name = resolve_netbios_name(ip_address)
    if netbios_name:
        print(f"Resolved NetBIOS name for IP {ip_address}: {netbios_name[0]}")
    else:
        print(f"Unable to resolve NetBIOS name for IP {ip_address}")

# Example usage
ip_address = "192.168.100.151"  # Replace with the target IP address
ports = [80, 3306, 5432]  # Replace with the ports you want to check

scan_ip(ip_address, ports)
