import subprocess
import platform

def ping_ip(ip):
    """
    Pings the provided IP address and returns True if the IP is active, False otherwise.
    """
    # Determine the ping command based on the OS
    param = "-n" if platform.system().lower() == "windows" else "-c"
    
    # Ping the IP address
    command = ["ping", param, "1", ip]
    response = subprocess.run(command, stdout=subprocess.PIPE, stderr=subprocess.PIPE)
    
    return response.returncode == 0

def ping_ip_range(start_ip, end_ip):
    """
    Pings a range of IP addresses and prints the active ones.
    """
    start_octets = list(map(int, start_ip.split('.')))
    end_octets = list(map(int, end_ip.split('.')))
    
    current_ip = start_octets[:]
    active_ips = []

    while current_ip != end_octets:
        ip_str = ".".join(map(str, current_ip))
        if ping_ip(ip_str):
            print(f"Active IP: {ip_str}")
            active_ips.append(ip_str)
        
        # Increment the last octet
        for i in reversed(range(4)):
            if current_ip[i] < 255:
                current_ip[i] += 1
                break
            else:
                current_ip[i] = 0

    # Check the last IP in the range
    ip_str = ".".join(map(str, end_octets))
    if ping_ip(ip_str):
        print(f"Active IP: {ip_str}")
        active_ips.append(ip_str)

    return active_ips

if __name__ == "__main__":
    # Define the IP range
    start_ip = "192.168.100.60"
    end_ip = "192.168.100.70"
    
    # Get active IPs in the range
    active_ips = ping_ip_range(start_ip, end_ip)
    
    # Output active IPs
    print("\nActive IP addresses:")
    for ip in active_ips:
        print(ip)
