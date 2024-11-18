import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

import pyodbc

def connect_to_sql_server(host, port, database, username, password):
    try:
        # Define the connection string
        connection_string = (
            f"DRIVER={{ODBC Driver 17 for SQL Server}};"
            f"SERVER={host},{port};"
            f"DATABASE={database};"
            f"UID={username};"
            f"PWD={password};"
        )

        # Establish the connection
        connection = pyodbc.connect(connection_string)
        print(f"Connected to SQL Server at {host}:{port}")
        
        # Create a cursor to execute queries
        cursor = connection.cursor()

        # Example: Fetch and display server version
        cursor.execute("SELECT @@VERSION;")
        server_version = cursor.fetchone()
        print("SQL Server Version:")
        print(server_version[0])

        # Close the connection
        cursor.close()
        connection.close()

    except Exception as e:
        print(f"Error connecting to SQL Server: {e}")

# Connection details
host = "192.168.0.64"  # IP address of the SQL Server
port = 1433  # Default SQL Server port
database = "your_database"  # Replace with your database name
username = "your_username"  # Replace with your username
password = "your_password"  # Replace with your password

connect_to_sql_server(host, port, database, username, password)
