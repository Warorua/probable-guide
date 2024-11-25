import sys
import os

# Configure environment for site-packages
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

# MySQL configuration for both databases
db_config_1 = {
    'host': '192.168.0.65',
    'user': 'root',
    'password': 'happycoding',
    'database': 'upgw',
    'port': 3306,
    'connect_timeout': 30
}

db_config_2 = {
    'host': '192.168.100.73',
    'user': 'root',
    'password': 'Happycoding',
    'database': 'db_api1_service',
    'port': 3306,
    'connect_timeout': 30
}

# The SQL query to execute
insert_query = "--SQLQUERY--"

# JSON payload for curl
json_payload = '--JSONQUERY--'

def execute_insert(db_config, query):
    try:
        connection = pymysql.connect(**db_config)
        cursor = connection.cursor()
        cursor.execute(query)
        connection.commit()
        return "Insert successful"
    except pymysql.MySQLError as e:
        return f"MySQL Error: {e}"
    except Exception as e:
        return f"General Error: {e}"
    finally:
        if cursor:
            cursor.close()
        if connection and connection.open:
            connection.close()

# Perform the insert operation for both databases
status_db1 = execute_insert(db_config_1, insert_query)
status_db2 = execute_insert(db_config_2, insert_query)

# Prepare and execute the curl command using os
curl_command = f"curl -X POST http://192.168.100.116/gateway/taifa/nrs/affirm -H 'Content-Type: application/json' -d '{json_payload}'"

try:
    stream = os.popen(curl_command)
    curl_response = stream.read().strip()
    status_curl = f"Curl response: {curl_response}"
except Exception as e:
    status_curl = f"Curl Error: {e}"

# Print the statuses of all operations
print("Database 1 Status:", status_db1)
print("Database 2 Status:", status_db2)
print("Curl Status:", status_curl)
