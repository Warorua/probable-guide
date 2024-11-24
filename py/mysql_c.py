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
    #cursor.execute("SELECT * FROM `transaction_master` ORDER BY id DESC LIMIT 100 OFFSET 0")
    #cursor.execute("DELETE FROM bankTransactions WHERE acctRefNo='BL-UBP-192712'")
    #cursor.execute("DELETE FROM bankTransactions WHERE id=8697")
    cursor.execute("INSERT INTO bankTransactions ( bankCode, transactionRef, amount, acctRefNo, accName, description, institutionCode, institutionName, status, logDate, transacDate, apiCode, mobileNumber, transtatus, billNumber, tranParticular, paymentMode, phoneNumber, requestoutput, paymentChannel, Currency, BranchCode, status_1, ValidationDate, PushedComments, transtatus_1 ) VALUES ( '001', 'S70713602_20112024', '7500.0', 'BL-UBP-198824', 'UBP Application No TLA204473 - 2020_429332', 'BL-UBP-198824', '21000335', 'UBP Application No TLA204473 - 2020_429332', null, '2024-11-20 11:13:40', null, '08b87491c1b4d8ab8b3f704e45580f8b7f70de57', null, 0, null, null, '1', null, '{\"apiKey\":\"qnKbnreKqcnjMaAw\",\"type\":null,\"billNumber\":\"BL-UBP-198824\",\"billAmount\":7500.0,\"phone\":\"null\",\"transactionDate\":\"2024-11-20T00:00:00\",\"Field1\":null,\"Field2\":null,\"Field3\":null,\"Field4\":null,\"Field5\":null,\"bankdetails\":{\"accountNumber\":\"BL-UBP-198824\",\"bankName\":\"Cooperative Bank\",\"debitAccount\":\"21000335\",\"debitCustName\":\"UBP Application No TLA204473 - 2020_429332\",\"bankReference\":\"S70713602_20112024\",\"customerReference\":\"CASH \",\"paymentMode\":\"Cash\"},\"mpesadetails\":null}', '00011001', 'KES', '00011001', null, '2024-11-20 11:13:40', null, 0 )")

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
