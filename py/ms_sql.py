import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

from pytds import connect

def connect_to_sql_server(host, port, database, username, password):
    try:
        # Establish connection
        conn = connect(
            dsn=host,
            port=port,
            user=username,
            password=password,
            database=database
        )
        print(f"Connected to SQL Server at {host}:{port}")

        # Execute a query
        cursor = conn.cursor()
        cursor.execute("SELECT @@VERSION;")
        version = cursor.fetchone()
        print("SQL Server Version:")
        print(version[0])

        # Close the connection
        conn.close()

    except Exception as e:
        print(f"Error connecting to SQL Server: {e}")

# Example usage
connect_to_sql_server(
    host="192.168.0.64",
    port=1433,
    database="your_database",
    username="your_username",
    password="your_password"
)
