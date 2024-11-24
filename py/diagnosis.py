import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

print("sys.path:", sys.path)
print("Python executable being used:", sys.executable)

# Check if the custom directory exists
custom_path = os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages'))
if os.path.exists(custom_path):
    print(f"Custom path exists: {custom_path}")
else:
    print(f"Custom path does not exist: {custom_path}")

# List packages in the custom site-packages directory
if os.path.exists(custom_path):
    print(f"Listing packages in {custom_path}:")
    try:
        print(os.listdir(custom_path))
    except Exception as e:
        print(f"Failed to list directory contents: {e}")

# Try to import pexpect and handle potential import errors
try:
    import pexpect
    print("pexpect imported successfully.")
    print("pexpect location:", pexpect.__file__)
except ImportError as e:
    print("pexpect import failed: ", e)
    print("Current sys.path directories:")
    for path in sys.path:
        print(path)
    
    # Provide more diagnostics
    print("Listing available packages in all site-packages directories:")
    for path in sys.path:
        if os.path.exists(path) and "site-packages" in path:
            print(f"\nPackages in {path}:")
            try:
                print(os.listdir(path))
            except Exception as e:
                print(f"Failed to list directory {path}: {e}")
