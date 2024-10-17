import sys
import os


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

# Increase verbosity to capture all possible prompts during file operations
try:
    # 1. Create a file on the remote server
    file_name = "testfile.txt"
    child.sendline(f'echo "This is a test file." > {file_name}')
    child.expect(r'.*[\$#]\s*$', timeout=60)


"""
    # 2. Read the content of the file
    child.sendline(f'cat {file_name}')
    child.expect(r'.*[\$#]\s*$', timeout=60)
    file_content = child.before.decode('utf-8').strip()
    print(f"Content of {file_name}:")
    print(file_content)

    # 3. Append additional text to the file
    child.sendline(f'echo "This is additional content." >> {file_name}')
    child.expect(r'.*[\$#]\s*$', timeout=60)

    # 4. Read the updated content of the file
    child.sendline(f'cat {file_name}')
    child.expect(r'.*[\$#]\s*$', timeout=60)
    updated_file_content = child.before.decode('utf-8').strip()
    print(f"Updated content of {file_name}:")
    print(updated_file_content)
"""

finally:
    # Ensure to exit the SSH session
    child.sendline('exit')
    child.close()
