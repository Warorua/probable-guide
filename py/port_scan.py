import threading

def scan_ports(ip, ports):
    import socket
    # Print the scanning message
    print(f"\nScanning {ip}...<br/>")
    for port in ports:
        try:
            with socket.socket(socket.AF_INET, socket.SOCK_STREAM) as s:
                s.settimeout(2)  # Timeout for connection attempts
                result = s.connect_ex((ip, port))  # Attempt connection
                if result == 0:  # If connection is successful
                    try:
                        # Get the service name for the port
                        service_name = socket.getservbyport(port, 'tcp')
                    except Exception:
                        service_name = "Unknown Service"
                    print(f"Port {port} is open on {ip} ({service_name})<br/>")
        except Exception as e:
            print(f"Error scanning port {port} on {ip}: {e}<br/>")

# List of IPs and Ports
ips = ["192.168.100.145"]
#ips = [f"192.168.{i}.{j}" for i in range(180, 199) for j in range(1, 200)]

#ports_to_scan = [22, 80, 443, 8080, 3306,5432,6432]
ports_to_scan = range(0, 65500)

# Start a thread for each IP
threads = []
for ip in ips:
    t = threading.Thread(target=scan_ports, args=(ip, ports_to_scan))
    threads.append(t)
    t.start()

# Wait for all threads to complete
for t in threads:
    t.join()
