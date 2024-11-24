import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

import pymssql

try:
    # Connect to the SQL Server
    conn = pymssql.connect(
        server='192.168.0.64',
        user='administrator',
        password='ERPwindows@1234',
        database='S-Mobile'
    )
    print("Connected to SQL Server.")

    # Query the database
    cursor = conn.cursor()
    #cursor.execute("SELECT name from master..sysdatabases;")
    cursor.execute("SELECT @@version")
    result = cursor.fetchone()
    print("SQL Server Version:", result[0])

    conn.close()
except Exception as e:
    print(f"Error connecting to SQL Server: {e}")
