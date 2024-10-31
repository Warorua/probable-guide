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

    # Execute the INSERT query
    cursor.execute("DELETE FROM bankTransactions WHERE transactionRef='2024102910377639'")
    #cursor.execute("INSERT INTO bankTransactions ( bankCode, transactionRef, amount, acctRefNo, accName, description, institutionCode, institutionName, status, logDate, transacDate, apiCode, mobileNumber, transtatus, billNumber, tranParticular, paymentMode, phoneNumber, requestoutput, paymentChannel, Currency, BranchCode, status_1, ValidationDate, PushedComments, transtatus_1) VALUES ( '003', '2024102812535608', 7500, 'BL-UBP-192701', null, null, 'BL-UBP-192701', 'UBP Application No TLA198232 - 2020_424285', null, '2024-10-28 12:53:01', '28-10-2024 00:00:00', '2f11db8526fb2e170219e4a68215a1b8fe907a6c', null, 0, 'BL-UBP-192701', 'BL-UBP-192701 UBP APPLICATION NO TLA198232 - 2020_424285', 'cash', null, null, null, null, null, null, '2024-10-28 12:53:01', null, 0 )")

    # Commit the transaction to make the changes permanent
    connection.commit()

    # Optionally, fetch rows if necessary
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
