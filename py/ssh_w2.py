import sys
import os
import base64

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))


import pexpect

class Decoder:
    def __init__(self, logfile):
        self.logfile = logfile

    def write(self, data):
        self.logfile.write(data.decode('utf-8', 'ignore'))

    def flush(self):
        self.logfile.flush()

# Define the server and credentials
hostname = '192.168.100.7'
port = 1016
username = 'super'
password = 'PUBLICserver@1234'
sudo_password = 'YourSudoPassword'  # Replace with the actual sudo password

# Define the local file path and the remote file path
local_file_path = '/home/super/HQ/1/execu.py'  # Replace with your local file path
remote_file_path = '../../home/super/e-constructions-portal-auth/src/utils/utils/execu.py'

# Read the content from the local file in binary mode
try:
    with open(local_file_path, 'rb') as file:  # Open in binary mode
        file_content = file.read()
except FileNotFoundError:
    print(f"File {local_file_path} not found.")
    sys.exit(1)

# Encode the file content to Base64
encoded_file_content = base64.b64encode(file_content).decode('utf-8')  # No need to encode to 'utf-8' first, directly base64 encode

# Create an SSH command
ssh_command = f"ssh -t -t {username}@{hostname} -p {port} 'TERM=dumb exec bash'"

# Spawn the SSH session
child = pexpect.spawn(ssh_command)

# Enable verbose logging with decoding
child.logfile = Decoder(sys.stdout)

# Expect the SSH connection prompts
index = child.expect([
    "Are you sure you want to continue connecting (yes/no)?",
    "password:",
    pexpect.TIMEOUT,
])

if index == 0:
    child.sendline("yes")
    child.expect("password:", timeout=60)
elif index == 2:
    print("Connection timed out")
    exit(1)

# Send the SSH password
child.sendline(password)

# Handle the prompt
while True:
    index = child.expect([
        r'\[oh-my-zsh\] Would you like to update\? \[Y/n\]',
        r'\[sudo\] password for .*:',  # Sudo password prompt
        r'.*[\$#]\s*$',  # Shell prompt
        pexpect.TIMEOUT,
    ], timeout=60)

    if index == 0:
        child.sendline("n")
    elif index == 1:
        # Send the sudo password
        child.sendline(sudo_password)
        child.expect(r'.*[\$#]\s*$', timeout=120)
    elif index == 2:
        break  # Shell prompt found
    elif index == 3:
        print("Timeout occurred waiting for shell prompt or sudo prompt")
        print("Output so far:", child.before.decode('utf-8'))
        exit(1)

try:
    # Create the file from Base64 encoded content on the remote server
    child.sendline(f'echo "{encoded_file_content}" | base64 --decode > {remote_file_path}')
    child.expect(r'.*[\$#]\s*$', timeout=60)

    # Optionally, read and print the content of the file to verify
    """
    child.sendline(f'cat {remote_file_path}')
    child.expect(r'.*[\$#]\s*$', timeout=60)
    print("Content of the remote file:")
    print(child.before.decode('utf-8').strip())
    """

finally:
    # Ensure to exit the SSH session
    child.sendline('exit')
    child.close()
