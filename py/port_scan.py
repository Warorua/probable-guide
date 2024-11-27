import threading

def scan_ports(ip, ports):
    import socket
    # Print the scanning message
    #print(f"\nScanning {ip}...<br/>")
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
ips = ["192.168.13.24"]
#ips = [f"192.168.{i}.{j}" for i in range(100, 105) for j in range(1, 100)]

#ports_to_scan = [1011,1012,1013,1014,1015,1016,1017,1018,1019,1020,1023,1024,1025,1026,5351]
#ports_to_scan = range(0, 65500)
ports_to_scan = range(0, 10000)
#ports_to_scan = [22,80,1433,5432,5433,3306,6432,8080,8081,443]

# Start a thread for each IP
threads = []
for ip in ips:
    t = threading.Thread(target=scan_ports, args=(ip, ports_to_scan))
    threads.append(t)
    t.start()

# Wait for all threads to complete
for t in threads:
    t.join()
