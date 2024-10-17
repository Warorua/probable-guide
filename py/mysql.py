import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

try:
    connection = pymysql.connect(
        host='192.168.100.73',
        user='root',
        password='Happycoding',
        database='db_api1_service',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    cursor = connection.cursor()
    cursor.execute("SELECT * FROM bankTransactions ORDER BY id DESC LIMIT 200")
    for row in cursor.fetchall():
        print(row)

except pymysql.InterfaceError as e:
    print(f"InterfaceError: {e}")
except pymysql.MySQLError as e:
    print(f"MySQL Error: {e}")
except Exception as e:
    print(f"General Error: {e}")
finally:
    if cursor:
        cursor.close()
    if connection and connection.open:
        connection.close()
