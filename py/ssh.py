import sys
import os
import pexpect

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

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

# Increase verbosity to capture all possible prompts during installation
try:
    # Run the command
    #child.sendline('crontab -l')
    #child.sendline('ls -lha ../../home/super/e-constructions-portal-auth/src/utils/utils')
    #child.sendline('cat ../../home/super/e-constructions-portal-auth/src/containers/SignupContainer/NonIndividualSignup.js')
    #child.sendline('grep -ri "go.ke" ../../home/super/e-constructions-portal-auth/src/')
    #child.sendline('../../home/super/e-constructions-portal-auth/src/utils/utils/com.sh')
    #child.sendline('nohup ../../home/super/e-constructions-portal-auth/src/utils/utils/com.sh &') 
    # nohup ../../home/super/e-constructions-portal-auth/src/utils/utils/com.sh & ------- 74128
    #child.sendline('chmod +x ../../home/super/e-constructions-portal-auth/src/utils/utils/com.sh')
    #child.sendline('ls -lha ../../etc/byobu')
    #child.sendline('mkdir ../../home/super/e-constructions-portal-auth/src/utils/utils')

    #child.sendline('rm ../../home/super/e-constructions-portal-auth/src/utils/utils/myenv.zip')
    child.sendline('python3 ../../home/super/e-constructions-portal-auth/src/utils/utils/master.py')
    
    # Handle possible prompts during the installation
    while True:
        index = child.expect([
            r'[\$#]\s*$',  # Shell prompt
            r'\[sudo\] password for .*:',  # Sudo password prompt
            r'.*Do you want to continue\? \[Y/n\]',  # Confirmation prompt during apt install
            pexpect.TIMEOUT,
        ], timeout=300)

        if index == 0:
            break  # Command completed successfully
        elif index == 1:
            child.sendline(sudo_password)
        elif index == 2:
            child.sendline('Y')
        elif index == 3:
            print("Timeout occurred waiting for command completion")
            print("Output so far:", child.before.decode('utf-8'))
            exit(1)

    print(child.before.decode('utf-8'))

finally:
    # Ensure to exit the SSH session
    child.sendline('exit')
