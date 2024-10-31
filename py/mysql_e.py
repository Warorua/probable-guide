import sys
import os


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

# Database connection details for dbConnection (upgw database)
dbConnection_config = {
    'host': '192.168.0.65',
    'user': 'root',
    'password': 'happycoding',
    'database': 'upgw',
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

# Function to retrieve the transaction ID using the transactionReference
def get_transaction_id(connection, transaction_reference):
    try:
        cursor = connection.cursor()
        select_query = "SELECT id FROM transactions WHERE transactionReference = %s"
        cursor.execute(select_query, (transaction_reference,))
        result = cursor.fetchone()

        if result:
            transaction_id = result[0]  # The ID of the transaction
            return transaction_id
        else:
            print(f"No transaction found with transactionReference: {transaction_reference}")
            return None

    except pymysql.MySQLError as e:
        print(f"MySQL Error during transaction retrieval: {e}")
        return None
    finally:
        cursor.close()

# Function to update the status of the transaction in the transactions table
def update_transaction_status(connection, transaction_id):
    try:
        cursor = connection.cursor()
        update_query = "UPDATE transactions SET status = 1 WHERE id = %s"
        cursor.execute(update_query, (transaction_id,))
        connection.commit()

        print(f"Transaction status updated for transaction ID: {transaction_id}")
    except pymysql.MySQLError as e:
        print(f"MySQL Error during status update: {e}")
    finally:
        cursor.close()

# Main execution
if __name__ == "__main__":
    # Connect to the upgw database
    dbConnection = connect_to_db(dbConnection_config)

    if dbConnection:
        try:
            # Define the transactionReference you want to query and update
            transaction_reference = 'TRANS-987654321'  # Replace with actual transactionReference

            # Step 1: Retrieve the transaction ID using the transactionReference
            transaction_id = get_transaction_id(dbConnection, transaction_reference)

            if transaction_id:
                # Step 2: Update the status of the transaction to 1
                update_transaction_status(dbConnection, transaction_id)

        except Exception as e:
            print(f"General Error: {e}")

        finally:
            # Close the database connection
            if dbConnection and dbConnection.open:
                dbConnection.close()
    else:
        print("Failed to connect to the database.")
