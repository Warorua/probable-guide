import subprocess

# Basic example to execute an OS command
command = "ls"  # For Unix/Linux/macOS (use "dir" for Windows)
result = subprocess.run(command, shell=True, capture_output=True, text=True)

# Output the result
print("Return code:", result.returncode)
print("Standard output:", result.stdout)
print("Standard error:", result.stderr)
