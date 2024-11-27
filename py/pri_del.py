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

# Invoice number
#inv_no = "BL-LR-277266"
inv_no = "BL-UBP-201207"

# The SQL queries to execute
del_query_1 = f"DELETE FROM `bankTransactions` WHERE acctRefNo ='{inv_no}'"
del_query_2 = f"DELETE FROM `account_confirmation_master` WHERE invoice_no ='{inv_no}'"

def execute_query(db_config, query):
    try:
        connection = pymysql.connect(**db_config)
        cursor = connection.cursor()
        cursor.execute(query)
        connection.commit()
        return "Query executed successfully"
    except pymysql.MySQLError as e:
        return f"MySQL Error: {e}"
    except Exception as e:
        return f"General Error: {e}"
    finally:
        if cursor:
            cursor.close()
        if connection and connection.open:
            connection.close()

# Execute the queries for both databases
status_db1 = execute_query(db_config_1, del_query_1)
status_db2 = execute_query(db_config_2, del_query_1)
status_db3 = execute_query(db_config_2, del_query_2)

# Print the statuses of all operations
print("Database 1 Status 1:", status_db1)
print("Database 2 Status 1:", status_db2)
print("Database 2 Status 2:", status_db3)
