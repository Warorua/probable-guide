import sys
import os
import traceback

# Add debug output to confirm the script starts
print("Script started.")

# Handle __file__ issues
try:
    script_dir = os.path.dirname(__file__)
except NameError:
    print("`__file__` is not defined. Using current working directory.")
    script_dir = os.getcwd()

# Add the custom site-packages directory to sys.path
custom_path = os.path.abspath(os.path.join(script_dir, './my_env_b/lib/python3.6/site-packages'))
sys.path.insert(0, custom_path)

# Print current Python executable and sys.path
print(f"Python executable: {sys.executable}")
print("=== sys.path ===")
for path in sys.path:
    print(path)

# Check if the custom path exists
if os.path.exists(custom_path):
    print(f"Custom path exists: {custom_path}")
    print(f"Contents of {custom_path}:")
    try:
        print(os.listdir(custom_path))
    except Exception as e:
        print(f"Failed to list contents of {custom_path}: {e}")
else:
    print(f"Custom path does not exist: {custom_path}")

# Attempt to import pytds
try:
    import pytds
    print("pytds imported successfully.")
except ImportError as e:
    print("Failed to import pytds.")
    print("Error message:", e)

    # Additional diagnostics
    print("\n=== Diagnostic Information ===")
    print("sys.path directories:")
    for path in sys.path:
        print(path)

    print("\nContents of site-packages directories in sys.path:")
    for path in sys.path:
        if os.path.exists(path) and "site-packages" in path:
            print(f"\nContents of {path}:")
            try:
                print(os.listdir(path))
            except Exception as ex:
                print(f"Failed to list contents of {path}: {ex}")

    print("\n=== Traceback ===")
    traceback.print_exc()

# Final debug statement
print("Script completed.")
