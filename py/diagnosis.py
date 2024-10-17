import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))


print("sys.path:", sys.path)
print("Python executable being used:", sys.executable)

try:
    import pymysql
    print("pymysql imported successfully inside exec.")
except ImportError as e:
    print("pymysql import failed inside exec: ", e)
    
# Rest of the decoded code follows...