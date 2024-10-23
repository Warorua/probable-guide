import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

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
            table, th, td {
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
    # Add table headers dynamically
    for header in headers:
        html += f"<th>{header}</th>"
    html += "</tr>"

    # Populate the table rows with data
    for row in rows:
        html += f"<tr>"
        for col in row:
            html += f"<td>{col}</td>"
        html += "</tr>"

    html += """
        </table>
    </body>
    </html>
    """
    return html


try:
    connection = pymysql.connect(
        host='192.168.100.73',
        user='root',
        password='Happycoding',
        database='db_api1_service',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    cursor = connection.cursor()

    # For demonstration, only run a SELECT query
    # Uncomment SELECT query lines if needed, comment out UPDATE if you want to test fetching rows
    cursor.execute("UPDATE account_confirmation_master SET `isvalid` = 1 WHERE `invoice_no` = 'BL-UBP-192701'")

    # After an UPDATE, there won't be any rows to fetch, so only proceed with SELECT queries
    if cursor.rowcount > 0:
        cursor.execute("SELECT * FROM account_confirmation_master WHERE `invoice_no` LIKE 'BL-UBP-192701' OR `invoice_no` LIKE 'BL-HR-621263' OR `invoice_no` LIKE 'BL-UBP-193090' ORDER BY id DESC LIMIT 200")

        # Get column headers dynamically
        if cursor.description is not None:
            headers = [i[0] for i in cursor.description]
            
            # Fetch all rows from the query
            rows = cursor.fetchall()

            # Generate the HTML table
            html_output = generate_html_table(headers, rows)
            
            # Print the HTML content (this can be saved to a file if needed)
            print(html_output)
        else:
            print("No headers found; this might be a non-SELECT query.")
    else:
        print("Query affected rows but no results to fetch (e.g., UPDATE statement).")

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
