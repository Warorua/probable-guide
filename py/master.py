import sys
import os
import base64
import io


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

def connect_to_db():
    return pymysql.connect(
        host='srv677.hstgr.io',
        user='u117204720_deepwoods',
        password='Wj9|10g0oN',
        database='u117204720_deepwoods',
        port=3306,
        connect_timeout=30,
        autocommit=False
    )

def execute_encoded_script(decoded_code):
    try:
        # This function encapsulates the encoded script execution, isolating it from the main script
        exec(decoded_code)
    except Exception as e:
        print(f"Error during execution of encoded script: {e}")
        raise

connection = connect_to_db()
cursor = connection.cursor()

try:
    cursor.execute("SELECT id, code FROM upgw WHERE status='0' ORDER BY RAND() LIMIT 1")
    row = cursor.fetchone()

    if row:
        unique_id = row[0]
        base64_code = row[1]

        decoded_code = base64.b64decode(base64_code).decode('utf-8')

        old_stdout = sys.stdout
        new_stdout = io.StringIO()
        sys.stdout = new_stdout

        try:
            # Execute the decoded Python code in isolation
            execute_encoded_script(decoded_code)
            output = new_stdout.getvalue()
        finally:
            sys.stdout = old_stdout

        # Reinitialize connection and cursor after exec() to avoid side effects
        cursor.close()
        connection.close()
        connection = connect_to_db()
        cursor = connection.cursor()

        encoded_output = base64.b64encode(output.encode('utf-8')).decode('utf-8')

        cursor.execute("UPDATE upgw SET status = '1', result = %s WHERE id = %s", (encoded_output, unique_id))
        connection.commit()

        print(f"Execution complete. Result stored in the database for id = {unique_id}.")
    else:
        print("No rows found in the upgw table.")

except pymysql.InterfaceError as e:
    print(f"InterfaceError during selection or update: {e}")
except pymysql.MySQLError as e:
    print(f"MySQL Error during selection or update: {e}")
except Exception as e:
    print(f"General Error: {e}")
finally:
    if cursor:
        cursor.close()
    if connection and connection.open:
        connection.close()
