import sys
import os
import traceback

# Add the directories containing site-packages to the system path
custom_path = os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages'))
sys.path.insert(0, custom_path)

# Print the current sys.path
print("=== sys.path ===")
for path in sys.path:
    print(path)
print("\n")

# Check if the custom path exists and list its contents
if os.path.exists(custom_path):
    print(f"Custom path exists: {custom_path}")
    print(f"Contents of {custom_path}:")
    try:
        print(os.listdir(custom_path))
    except Exception as e:
        print(f"Failed to list contents of {custom_path}: {e}")
else:
    print(f"Custom path does not exist: {custom_path}")

# Attempt to import SMBConnection and catch errors
try:
    from smb.SMBConnection import SMBConnection
    print("SMBConnection imported successfully.")
except ImportError as e:
    print("Failed to import SMBConnection.")
    print("Error message:", e)
    print("\n=== Diagnostic Information ===")
    print("Current sys.path:")
    for path in sys.path:
        print(path)

    print("\nListing contents of all site-packages in sys.path:")
    for path in sys.path:
        if os.path.exists(path) and "site-packages" in path:
            print(f"\nContents of {path}:")
            try:
                print(os.listdir(path))
            except Exception as ex:
                print(f"Failed to list contents of {path}: {ex}")

    print("\n=== Traceback ===")
    traceback.print_exc()
