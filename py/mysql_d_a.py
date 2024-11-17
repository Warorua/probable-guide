import sys
import os


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

# Database connection details for dbConnection
dbConnection_config = {
    'host': '192.168.0.65',
    'user': 'root',
    'password': 'happycoding',
    'database': 'upgw',
    'port': 3306
}

# Database connection details for dbConnectionapi
dbConnectionapi_config = {
    'host': '192.168.100.73',
    'user': 'root',
    'password': 'Happycoding',
    'database': 'db_api1_service',
    'port': 3306
}

# Connect to a MySQL database
def connect_to_db(db_config):
    try:
        connection = pymysql.connect(
            host=db_config['host'],
            user=db_config['user'],
            password=db_config['password'],
            database=db_config['database'],
            port=db_config['port'],
            connect_timeout=30,
            autocommit=True
        )
        return connection
    except pymysql.MySQLError as e:
        print(f"MySQL Error: {e}")
        return None

# Function to handle insertions into the bankTransactions table
def insert_bank_transaction(connection, transaction_data):
    try:
        cursor = connection.cursor()
        insert_query = """
            INSERT INTO bankTransactions (bankCode, billNumber, amount, acctRefNo, transactionRef, tranParticular, paymentMode, 
                                          transacDate, mobileNumber, institutionCode, apiCode, institutionName, transtatus) 
            VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)
        """
        cursor.execute(insert_query, transaction_data)
        connection.commit()
        print(f"Transaction inserted successfully: {transaction_data[4]}")
    except pymysql.MySQLError as e:
        print(f"MySQL Error during insertion: {e}")
    finally:
        cursor.close()

# Function to update the status of a transaction in the bankTransactions table
def update_transaction_status(connection, transaction_ref):
    try:
        cursor = connection.cursor()
        update_query = "UPDATE bankTransactions SET transtatus = 1 WHERE transactionRef = %s"
        cursor.execute(update_query, (transaction_ref,))
        connection.commit()
        print(f"Transaction status updated for {transaction_ref}")
    except pymysql.MySQLError as e:
        print(f"MySQL Error during status update: {e}")
    finally:
        cursor.close()

# Sample transaction data to insert (you would get this from the request body in a real application)
transaction_data = (
    '003',                   # bankCode
    'BL-UBP-192712',           # billNumber
    7500,                     # amount
    'BL-UBP-192712',            # acctRefNo
    '2024111714381687',        # transactionRef
    'BL-UBP-192712 UBP APPLICATION NO TLA198244 - 2020_267751',   # tranParticular
    'cash',                   # paymentMode
    '17-11-2024 00:00:00',    # transacDate
    null,             # mobileNumber
    'BL-UBP-192712',               # institutionCode
    '2f11db8526fb2e170219e4a68215a1b8fe907a6c',              # apiCode
    'UBP Application No TLA198244 - 2020_267751',       # institutionName
    0                         # transtatus (initially 0, updated later)
)

# Connect to both databases
dbConnection = connect_to_db(dbConnection_config)
dbConnectionapi = connect_to_db(dbConnectionapi_config)

if dbConnection and dbConnectionapi:
    try:
        # Insert transaction into dbConnectionapi (equivalent to dbConnectionapi in the controller)
        insert_bank_transaction(dbConnectionapi, transaction_data)

        # Insert transaction into dbConnection (equivalent to dbConnection in the controller)
        insert_bank_transaction(dbConnection, transaction_data)

        # Update the status of the transaction in dbConnection (dbConnection in the controller)
        update_transaction_status(dbConnection, transaction_data[4])  # transaction_ref is at index 4

    except Exception as e:
        print(f"General Error: {e}")

    finally:
        # Close the connections
        if dbConnection and dbConnection.open:
            dbConnection.close()
        if dbConnectionapi and dbConnectionapi.open:
            dbConnectionapi.close()
else:
    print("Failed to connect to one or both databases.")