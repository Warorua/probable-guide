import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './python3.6/site-packages')))

# Try importing pg8000 directly
try:
    import pg8000
    print("pg8000 imported successfully.")
except ImportError as e:
    print(f"pg8000 import error: {e}")

# Database connection information
db_config = {
    'host': '192.168.102.22',
    'database': 'nrs_professionals',
    'user': 'postgres',
    'password': 'postgres',  
    'port': 5432
}


# Function to query the database, accepting both pg8000 and db_config as arguments
def query_database(query, pg8000_module, db_config):
    try:
        # Connect to the PostgreSQL database using pg8000
        conn = pg8000_module.connect(
            host=db_config['host'],
            database=db_config['database'],
            user=db_config['user'],
            password=db_config['password'],
            port=db_config['port']
        )

        # Create a cursor to execute the query
        cursor = conn.cursor()
        cursor.execute(query)

        # Handle SELECT queries
        if query.strip().lower().startswith("select"):
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

# Example usage of querying the database
#query = "SELECT datname FROM pg_database;"
#query = "select * from pg_ls_dir('../../../../../home/super');"
#query = "SELECT pg_read_file('../../../../../etc/mysql/my.cnf');"
#query = "SELECT * FROM payments_payment LIMIT 200 OFFSET 0"
#query = "SELECT * FROM payments_payment ORDER BY created_at DESC LIMIT 200 OFFSET 0"
query = "select schemaname,tablename,tableowner from pg_tables WHERE tableowner = 'postgres';"
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
