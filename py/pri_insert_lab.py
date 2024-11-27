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
insert_query = "INSERT INTO bankTransactions  (  bankCode,   transactionRef,   amount,   acctRefNo,   accName,   description,   institutionCode,   institutionName,   status,   logDate,   transacDate,   apiCode,   mobileNumber,   transtatus,   billNumber,   tranParticular,   paymentMode,   phoneNumber,   requestoutput,   paymentChannel,   Currency,   BranchCode,   status_1,   ValidationDate,   PushedComments,   transtatus_1 ) VALUES (  '001',   'S71231886_27112024',   '30400.0',   'BL-UBP-198559',   'UBP Application No TLA204206 - 2020_46205',   'BL-UBP-198559',   '21000335',   'UBP Application No TLA204206 - 2020_46205',   null,   '2024-11-27 13:15:44',   null,   '08b87491c1b4d8ab8b3f704e45580f8b7f70de57',   null,   0,   null,   null,   '1',   null,   '{\"apiKey\":\"qnKbnreKqcnjMaAw\",\"type\":null,\"billNumber\":\"BL-UBP-198559\",\"billAmount\":30400.0,\"phone\":\"null\",\"transactionDate\":\"2024-11-27T00:00:00\",\"Field1\":null,\"Field2\":null,\"Field3\":null,\"Field4\":null,\"Field5\":null,\"bankdetails\":{\"accountNumber\":\"BL-UBP-198559\",\"bankName\":\"Cooperative Bank\",\"debitAccount\":\"21000335\",\"debitCustName\":\"UBP Application No TLA204206 - 2020_46205\",\"bankReference\":\"S71231886_27112024\",\"customerReference\":\"CASH \",\"paymentMode\":\"Cash\"},\"mpesadetails\":null}',   '00011001',   'KES',   '00011001',   null,   '2024-11-27 13:15:44',   null,   0 )"

# JSON payload for curl
json_payload = '{"apiKey":"qnKbnreKqcnjMaAw","type":null,"billNumber":"BL-UBP-198559","billAmount":30400.0,"phone":"null","transactionDate":"2024-11-27T00:00:00","Field1":null,"Field2":null,"Field3":null,"Field4":null,"Field5":null,"bankdetails":{"accountNumber":"BL-UBP-198559","bankName":"Cooperative Bank","debitAccount":"21000335","debitCustName":"UBP Application No TLA204206 - 2020_46205","bankReference":"S71231886_27112024","customerReference":"CASH ","paymentMode":"Cash"},"mpesadetails":null}'

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
