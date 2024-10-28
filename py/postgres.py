import sys
import os


# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pg8000

# Database connection information
db_config = {
    'host': '192.168.100.122',
    'database': 'postgres',
    'user': 'postgres',
    'password': 'postgres',  # Replace with the actual password
    'port': 5432
}

# Function to query the database
def query_database(query):
    try:
        # Connect to the PostgreSQL database
        conn = pg8000.connect(
            host=db_config['host'],
            database=db_config['database'],
            user=db_config['user'],
            password=db_config['password'],
            port=db_config['port']
        )
        
        # Execute the query
        rows = conn.run(query)
        
        # Get column headers from description
        headers = [desc[0] for desc in conn.description]

        # Close the connection
        conn.close()

        return headers, rows

    except Exception as e:
        print(f"Error: {e}")
        return None, None

# Function to generate the HTML table (from your provided code)
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

# Example usage of querying the database and printing the HTML result
if __name__ == "__main__":
    # Example query
    query = "SELECT datname FROM pg_database;"  # Replace 'your_table' with an actual table in your DB

    # Fetch headers and rows from the database
    headers, rows = query_database(query)

    if headers and rows:
        # Generate the HTML table
        html_output = generate_html_table(headers, rows)

        # Print the HTML output
        print(html_output)
    else:
        print("Failed to fetch data from the database.")
