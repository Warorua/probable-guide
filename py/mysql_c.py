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
        #database='upgw',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    cursor = connection.cursor()

    # Execute the INSERT query
    cursor.execute("SELECT * FROM `transaction_master` ORDER BY id DESC LIMIT 100 OFFSET 0")
    #cursor.execute("DELETE FROM bankTransactions WHERE acctRefNo='BL-UBP-192712'")
    #cursor.execute("DELETE FROM bankTransactions WHERE id=8697")
    #cursor.execute("INSERT INTO bankTransactions ( bankCode, transactionRef, amount, acctRefNo, accName, description, institutionCode, institutionName, status, logDate, transacDate, apiCode, mobileNumber, transtatus, billNumber, tranParticular, paymentMode, phoneNumber, requestoutput, paymentChannel, Currency, BranchCode, status_1, ValidationDate, PushedComments, transtatus_1 ) VALUES ( '003', '2024111714381687', 7500, 'BL-UBP-192712', null, null, 'BL-UBP-192712', 'UBP Application No TLA198244 - 2020_267751', null, '2024-11-17 14:38:45', '17-11-2024 00:00:00', '2f11db8526fb2e170219e4a68215a1b8fe907a6c', null, 0, 'BL-UBP-192712', 'BL-UBP-192712 UBP APPLICATION NO TLA198244 - 2020_267751', 'cash', null, null, null, null, null, null, '2024-11-17 14:38:45', null, 0 )")

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
