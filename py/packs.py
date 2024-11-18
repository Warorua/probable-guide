import pkg_resources
import sys
import os

# Define the custom path
custom_path = os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages'))

# Add the custom path to sys.path
if os.path.exists(custom_path):
    sys.path.insert(0, custom_path)
    print(f"Custom path added to sys.path: {custom_path}")
else:
    print(f"Custom path does not exist: {custom_path}")

# Get all installed packages
installed_packages = pkg_resources.working_set

# Print each package with its version and location
print("\nInstalled packages (including custom path):")
for package in installed_packages:
    print(f"{package.key}=={package.version} (Location: {package.location})")
