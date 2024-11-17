import sys
import os


# Add the directories containing site-packages to the system path
#sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './python3.6/site-packages')))


try:
    import pg8000
    print("pg8000 imported successfully.")
except ImportError as e:
    print(f"pg8000 import error: {e}")
