import os
import subprocess

# Add ~/.local/bin to the PATH
os.environ["PATH"] += os.pathsep + os.path.expanduser("~/.local/bin")

# Set an environment variable to use uvloop as the event loop
os.environ["UVICORN_LOOP"] = "uvloop"

# Run uvicorn with the correct loop
subprocess.run(["uvicorn", "myapp:app", "--host", "0.0.0.0", "--port", "8000"])
