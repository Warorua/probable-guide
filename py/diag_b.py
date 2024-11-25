import importlib.util
import os

# Path to the pytds package's __init__.py file
pytds_init = "/opt/tomcat/webapps/aggregate/my_env_b/lib/python3.6/site-packages/pytds/__init__.py"

if os.path.exists(pytds_init):
    # Load the pytds module dynamically
    spec = importlib.util.spec_from_file_location("pytds", pytds_init)
    pytds = importlib.util.module_from_spec(spec)
    spec.loader.exec_module(pytds)
    print("pytds module loaded successfully using importlib.")
    
    # Example usage: Check if pytds has a `connect` function
    if hasattr(pytds, 'connect'):
        print("pytds.connect is available.")
    else:
        print("pytds.connect is not available.")
else:
    print(f"pytds __init__.py not found at {pytds_init}")
