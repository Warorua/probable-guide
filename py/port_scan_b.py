import subprocess
#import threading

def scan_port(ip, port):
    """
    Scans a single port on a given IP address.
    
    Args:
        ip (str): The target IP address.
        port (int): The port number to scan.
    
    Returns:
        None
    """
    try:
        # Try to establish a TCP connection using a built-in command
        # Redirect stderr to stdout for a unified response
        result = subprocess.run(
            ["timeout", "2", "bash", "-c", f"</dev/tcp/{ip}/{port}"],
            stdout=subprocess.PIPE,
            stderr=subprocess.PIPE,
            text=True,
        )
        if result.returncode == 0:
            print(f"Port {port} is open on {ip}")
    except Exception as e:
        pass  # Ignore errors; they indicate closed ports

# def scan_all_ports(ip):
#     """
#     Scans all ports (0-65535) on a given IP address.

#     Args:
#         ip (str): The target IP address.

#     Returns:
#         None
#     """
#     threads = []
#     for port in range(0, 65536):  # All possible ports
#         thread = threading.Thread(target=scan_port, args=(ip, port))
#         threads.append(thread)
#         thread.start()

#         # Limit the number of active threads to avoid overwhelming the system
#         if len(threads) > 1000:
#             for t in threads:
#                 t.join()
#             threads = []

#     # Wait for all remaining threads to complete
#     for t in threads:
#         t.join()

# Example Usage
target_ip = "192.168.0.64"  # Replace with your target IP
target_port = "3306"
#scan_all_ports(target_ip)
scan_port(target_ip, target_port)
