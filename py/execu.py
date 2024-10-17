import os
import sys

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

# Path to the log file
log_file_path = "/home/super/e-constructions-portal-auth/src/utils/utils/cron_log.txt"

# Maximum log file size in bytes (1MB)
max_log_size = 1 * 1024 * 1024

# Check if the log file exists and its size
if os.path.exists(log_file_path):
    if os.path.getsize(log_file_path) > max_log_size:
        os.remove(log_file_path)
        print(f"Deleted log file {log_file_path} because it exceeded {max_log_size} bytes")

# Read the contents of master.py
with open('/home/super/e-constructions-portal-auth/src/utils/utils/master.py', 'r') as file:
    script_code = file.read()

# Execute the contents of master.py 5 times
for i in range(5):
    print(f"Running master.py iteration {i + 1}...")
    try:
        exec(script_code)
    except Exception as e:
        print(f"An error occurred while executing master.py on iteration {i + 1}: {e}")
