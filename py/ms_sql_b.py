import sys
import os

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))

import pymssql


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
    # Connect to SQL Server
    conn = pymssql.connect(
        server='192.168.100.145',
        user='taifapay',
        password='taifa@2020!',
        database='PowerBI'
    )
    print("Connected to SQL Server.")

    # Query the database
    cursor = conn.cursor()

    # Execute a SELECT query
    #cursor.execute("SELECT * FROM information_schema.columns")
    #cursor.execute("SELECT TABLE_SCHEMA, TABLE_NAME FROM INFORMATION_SCHEMA.TABLES")
    cursor.execute("SELECT TOP 50 * FROM [dbo].[Tmasterimport_original] ORDER BY [Transaction Time] DESC")
    #cursor.execute("SELECT TOP 200 * FROM [dbo].[Transaction Master] ORDER BY [timestamp] DESC")
    #cursor.execute("SELECT TOP 100 * FROM ( SELECT  COALESCE(OBJECT_NAME(qt.objectid), 'Ad-Hoc') AS objectname,  qt.objectid AS objectid,  qs.last_execution_time,  qs.execution_count,  qs.encrypted,  (SELECT TOP 1  SUBSTRING( qt.text,  qs.statement_start_offset / 2 + 1,  (CASE  WHEN qs.statement_end_offset = -1  THEN LEN(CONVERT(NVARCHAR(MAX), qt.text)) * 2  ELSE qs.statement_end_offset  END - qs.statement_start_offset) / 2 + 1 ) ) AS sql_statement FROM  sys.dm_exec_query_stats AS qs CROSS APPLY  sys.dm_exec_sql_text(qs.sql_handle) AS qt ) AS x ORDER BY x.execution_count DESC; ")
 


    # Get column headers dynamically
    if cursor.description is not None:
        headers = [i[0] for i in cursor.description]

        # Fetch all rows from the query
        rows = cursor.fetchall()

        # Generate the HTML table
        html_output = generate_html_table(headers, rows)

        # Print the HTML content (can also be saved to a file)
        print(html_output)
    else:
        print("No headers found; this might be a non-SELECT query.")

except pymssql.InterfaceError as e:
    print(f"InterfaceError: {e}")
except pymssql.DatabaseError as e:
    print(f"Database Error: {e}")
except Exception as e:
    print(f"General Error: {e}")
finally:
    if cursor:
        cursor.close()
    if conn:
        conn.close()
