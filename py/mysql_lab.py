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
        #database='upgw',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    upgw = pymysql.connect(
        host='192.168.0.65',
        user='root',
        password='happycoding',
        database='upgw',
        port=3306,  # Specify your MySQL port here
        connect_timeout=30  # Increased timeout for better stability
    )

    cursor = connection.cursor()
    #cursor = upgw.cursor()

    #cursor.execute("UPDATE account_confirmation_master SET `isvalid` = 1 WHERE `invoice_no` LIKE 'BL-UBP-192701'")
    #cursor.execute("SELECT * FROM account_confirmation_master ORDER BY id DESC LIMIT 200 OFFSET 0")

    #cursor.execute("SELECT * FROM transaction_master WHERE invoice_no ='BL-UBP-198824' OR invoice_no = 'BL-UBP-201458' OR invoice_no = 'BL-UBP-201675' OR invoice_no = 'BL-ADF-051165' OR invoice_no = 'BL-LR-278399' OR invoice_no = 'EC-BPM0-016729' OR invoice_no = 'BL-GLR-281522' ORDER BY id DESC")
    #cursor.execute("SELECT * FROM banks ORDER BY id DESC LIMIT 200 OFFSET 0")

    #cursor.execute("SELECT * FROM `transactionsView` LIMIT 200")
    #cursor.execute("SELECT * FROM `bankTransactions` WHERE bankCode='001' ORDER BY id DESC LIMIT 250 OFFSET 0")
    #cursor.execute("SELECT * FROM `transactions` WHERE clientRefNo ='BL-UBP-198824' OR clientRefNo = 'BL-UBP-201458' OR clientRefNo = 'BL-UBP-201675' OR clientRefNo = 'BL-ADF-051165' OR clientRefNo = 'BL-LR-278399' OR clientRefNo = 'EC-BPM0-016729' OR clientRefNo = 'BL-GLR-281522'  ORDER BY id DESC LIMIT 200")
    
    cursor.execute("SELECT * FROM account_confirmation_master WHERE invoice_no ='BL-LR-277266' OR invoice_no = 'BL-UBP-201458' OR invoice_no = 'BL-UBP-201675' OR invoice_no = 'BL-ADF-051165' OR invoice_no = 'BL-LR-278399' OR invoice_no = 'EC-BPM0-016729' OR invoice_no = 'BL-GLR-281522' ORDER BY id DESC LIMIT 200")

    #cursor.execute("SELECT DISTINCT `request_ip` FROM account_confirmation_master")
    #cursor.execute("SELECT * FROM `mpesaTransactions` ORDER BY id DESC LIMIT 200 OFFSET 500")
    #cursor.execute("SELECT * FROM `bankTransactions` ORDER BY id DESC LIMIT 200 OFFSET 0")
    # #cursor.execute("SELECT * FROM `mpesaTransactions` WHERE `mobileno` LIKE '%721303137%' ORDER BY id DESC LIMIT 200")

    #cursor.execute("SELECT * FROM `transactions` WHERE `apiCode`='08b87491c1b4d8ab8b3f704e45580f8b7f70de57' ORDER BY id DESC LIMIT 500 OFFSET 0")
    #cursor.execute("SELECT * FROM `transactions` ORDER BY id DESC LIMIT 500 OFFSET 0")
    
    
    # #cursor.execute("SELECT * FROM `transactions` WHERE `comment`='COMPLETED' AND `bankCode`='003' ORDER BY id DESC LIMIT 500 OFFSET 0")
    # #cursor.execute("SELECT * FROM `transactions` WHERE `mobileNumber` LIKE '%720664431%' ORDER BY id DESC LIMIT 500 OFFSET 0")
    # #cursor.execute("SELECT * FROM `transactions` WHERE `inserted_by`='root@192.168.0.1' ORDER BY id DESC LIMIT 500 OFFSET 0")
    # #cursor.execute("SELECT * FROM mpesaTransactionsView LIMIT 200")
    # #cursor.execute("SELECT * FROM `transactionsNewV1` WHERE clientRefNo LIKE '%BL-UBP-164702%' OR clientRefNo LIKE '%BL-UBP-064249%' OR clientRefNo LIKE '%BL-UBP-165138%' OR clientRefNo LIKE '%BL-UBP-165277%' OR clientRefNo LIKE '%BL-UBP-164997%' OR clientRefNo LIKE '%BL-UBP-060215%' ORDER BY id")
    # #cursor.execute("SELECT * FROM mpesaTransactions_audit WHERE clientRefNo ='BL-UBP-164702' OR clientRefNo = 'BL-UBP-064249' ORDER BY id")
    #cursor.execute("SELECT * FROM bankTransactions_1 WHERE clientRefNo ='BL-UBP-164702' OR clientRefNo = 'BL-UBP-192701' OR clientRefNo = 'BL-UBP-165138' OR clientRefNo = 'BL-UBP-165277' OR clientRefNo = 'BL-UBP-164997' OR clientRefNo = 'BL-UBP-060215' ORDER BY id")
    #cursor.execute("SELECT * FROM BankTransactionLog ORDER BY id DESC LIMIT 500 OFFSET 0")
    #cursor.execute("SELECT * FROM bankTransactions WHERE acctRefNo ='BL-UBP-198824' OR acctRefNo = 'BL-UBP-201458' OR acctRefNo = 'BL-UBP-201675' OR acctRefNo = 'BL-ADF-051165' OR acctRefNo = 'BL-LR-278399' OR acctRefNo = 'EC-BPM0-016729' OR acctRefNo = 'BL-GLR-281522' ORDER BY id DESC LIMIT 500 OFFSET 0")
    #cursor.execute("SELECT * FROM apis ORDER BY id DESC LIMIT 500 OFFSET 0")
    #cursor.execute("SELECT * FROM apis ORDER BY id DESC LIMIT 500 OFFSET 0")
    
    # Get column headers dynamically
    headers = [i[0] for i in cursor.description]
    
    # Fetch all rows from the query
    rows = cursor.fetchall()

    # Generate the HTML table
    html_output = generate_html_table(headers, rows)
    
    # Print the HTML content (this can be saved to a file if needed)
    print(html_output)

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
