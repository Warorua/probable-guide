import sys
import os


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

connection = None
cursor = None

try:
    print("Attempting to connect to the database...")

    # Attempt to connect to the MySQL database
    connection = pymysql.connect(
        host='192.168.0.64',  # Intentionally incorrect host
        user='root',
        password='upgw',
        database='information_schema',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )
    print("Database connection established successfully.")

    # Create a cursor
    cursor = connection.cursor()

    # Example query
    query = "SELECT user()"  # Replace with your query
    #query = "SELECT schema_name FROM information_schema.schemata"  # Replace with your query
    cursor.execute(query)

    # Fetch and print results if the query is SELECT
    if query.strip().lower().startswith("select"):
        rows = cursor.fetchall()
        if rows:
            print("Query Results:")
            for row in rows:
                print(row)
        else:
            print("No data returned by the query.")
    else:
        # Commit changes for non-SELECT queries
        connection.commit()
        print(f"Query executed successfully. Rows affected: {cursor.rowcount}")

except pymysql.OperationalError as e:
    print(f"OperationalError: Could not connect to the database. Details: {e}")
except pymysql.MySQLError as e:
    print(f"MySQL Error: {e}")
except Exception as e:
    print(f"General Error: {e}")
finally:
    # Ensure cursor and connection are closed properly
    if cursor:
        try:
            cursor.close()
            print("Cursor closed.")
        except Exception as e:
            print(f"Error while closing cursor: {e}")

    if connection:
        try:
            connection.close()
            print("Database connection closed.")
        except Exception as e:
            print(f"Error while closing connection: {e}")
