import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

try:
    connection = pymysql.connect(
        host='192.168.0.65',
        user='root',
        password='happycoding',
        database='upgw',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    cursor = connection.cursor()

    # Variables for billNumber and clientRefNo
    bill_number = 'BL-UBP-177910'
    client_ref_no = 'BL-UBP-177910'

    # Delete from bankTransactions where billNumber matches
    cursor.execute("DELETE FROM `bankTransactions` WHERE `billNumber`=%s", (bill_number,))

    # Delete from transactions where clientRefNo matches
    cursor.execute("DELETE FROM `transactions` WHERE `clientRefNo`=%s", (client_ref_no,))

    # Commit the transaction to apply the deletions
    connection.commit()

    print(f"Successfully deleted records with billNumber='{bill_number}' and clientRefNo='{client_ref_no}'.")

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
