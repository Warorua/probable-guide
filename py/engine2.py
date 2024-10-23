import sys
import os
import json
from datetime import datetime, timezone, timedelta
import urllib.request
import urllib.parse
import urllib.error  # Correct imports for urllib

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './myenv/Lib/site-packages')))

import pymysql

# Database connection details
db_config = {
    'host': '192.168.100.73',
    'user': 'root',
    'password': 'Happycoding',
    'database': 'db_api1_service',
    'port': 3306,
}

# Function to log records into recLog table
def rec_log(invoice, data, sql, connection):
    try:
        with connection.cursor() as cursor:
            query = "INSERT INTO recLog (`inv`,`data`,`sql`) VALUES (%s, %s, %s)"
            cursor.execute(query, (invoice, data, sql))
            connection.commit()
            cursor.execute("SELECT LAST_INSERT_ID()")
            response = cursor.fetchone()
            return response
    except pymysql.MySQLError as e:
        print(f"MySQL Error: {e}")
        return None

# Function to execute SQL commands directly instead of making HTTP requests to my.jsp
def universal_dab_b(command, connection):
    try:
        with connection.cursor() as cursor:
            cursor.execute(command)
            connection.commit()
            rows = cursor.fetchall()
            formatted_data = "<h2>Results</h2><br/><br/>"
            for row in rows:
                formatted_data += str(row) + "<br/>"
            return formatted_data
    except pymysql.MySQLError as e:
        print(f"MySQL Error: {e}")
        return None

# Convert datetime string to ISO 8601 format
def convert_to_iso8601(date_time_str, timezone_offset='+03:00'):
    date_time_str = date_time_str.split('.')[0]
    date_time_obj = datetime.strptime(date_time_str, '%Y-%m-%d %H:%M:%S')
    hours_offset = int(timezone_offset[:3])
    minutes_offset = int(timezone_offset[4:])
    tz = timezone(timedelta(hours=hours_offset, minutes=minutes_offset))
    date_time_obj = date_time_obj.replace(tzinfo=tz)
    return date_time_obj.isoformat()

# Generate an account number based on current datetime and random digits
def generate_account_number():
    date_time = datetime.now().strftime('%Y%m%d%H%M')
    random_digits = ''.join(str(i) for i in range(4))
    return date_time + random_digits

# Generate the current date with midnight time
def generate_current_date_with_midnight_time():
    date_time = datetime.now()
    return date_time.replace(hour=0, minute=0, second=0).strftime('%d-%m-%Y %H:%M:%S')

# Function to delete a bank transaction
def bank_transactions_del(id, connection):
    q = f"DELETE FROM bankTransactions WHERE id={id}"
    return universal_dab_b(q, connection)

# Function to delete transactions by clientRefNo
def transactions(client_ref_no, connection):
    q = f"DELETE FROM transactions WHERE clientRefNo='{client_ref_no}'"
    return universal_dab_b(q, connection)

# Make HTTP POST request using urllib
def http_post(url, data):
    try:
        # Encode the data to a URL-encoded format
        data = urllib.parse.urlencode(data).encode()
        
        # Create a request object
        req = urllib.request.Request(url, data=data)
        
        # Make the POST request
        with urllib.request.urlopen(req) as response:
            # Read the response and decode it
            response_data = response.read().decode()
            return json.loads(response_data)
    except urllib.error.URLError as e:
        print(f"HTTP request failed: {e}")
        return None

# Function to normalize phone number (mocked for now, update as needed)
def normalize_phone_number(phone):
    return phone

# Function to split customer name (mocked for now, update as needed)
def split_name(name):
    return name

# Main logic
try:
    connection = pymysql.connect(**db_config)

    # Simulating input (you can replace this with your actual POST data)
    input_data = {
        'invoiceNo': 'BL-UBP-192701',
        'amount': '7500.00',
        'pay': 'set',
        # 'del': '123456'
    }

    if 'del' in input_data:
        inv = input_data['del']
        cmd = f"SELECT id FROM bankTransactions WHERE billNumber='{inv}' LIMIT 1"
        sd1 = universal_dab_b(cmd, connection)
        id1 = extract_id(sd1)  # Assuming extract_id is defined elsewhere
        print(id1)
        print(bank_transactions_del(id1, connection))
        print(transactions(inv, connection))
    else:
        if 'invoiceNo' not in input_data or 'amount' not in input_data or 'pay' not in input_data:
            print({'error': 'incomplete request', 'payload': input_data})
        else:
            invoice_no = input_data['invoiceNo']
            amount = input_data['amount']
            pay_type = input_data['pay']

            # Make the HTTP POST request to the external service (https://kever.io/auto_process.php)
            post_data = {
                'invoiceNo': invoice_no,
                'amount': amount
            }

            validation = http_post('https://kever.io/auto_process.php', post_data)

            if validation is None:
                print("Error: Failed to validate the data")
            else:
                # Process amount based on payment type
                amt1 = float(validation['amount'].replace(',', '')) if pay_type == 'set' else float(amount)

                dt1 = {
                    'invoiceNo': validation['invoiceNo'],
                    'invoiceAmt': amt1,
                    'client': 0,
                    'id': '1'
                }
                dtt1 = {'name': '0'}

                if validation['success'] and validation['status'] == "Unpaid":
                    parts = invoice_no.split('-')
                    validation_amt = float(validation['amount'].replace(",", ""))

                    if parts[0] == 'BL' and validation_amt == dt1['invoiceAmt']:
                        bypass = {
                            'amount': dt1['invoiceAmt'],
                            'invoice_no': dt1['invoiceNo'],
                            'success': True,
                            'route': 'yes',
                            'record': 'yes',
                            'client': dtt1['name'],
                            'extdoc': validation['external_doc'],
                            'custname': validation['customername'],
                            'custcont': validation['mobilenumber'] or '0700000000'
                        }

                        if bypass:
                            # Additional logic as per PHP script
                            newId = 6212481
                            newBal = 378760 + 500
                            custname = split_name(bypass['custname'])
                            if bypass['custcont'] == '' or bypass['custcont'] is None:
                                bypass['custcont'] = '0700000000'
                            custcont = normalize_phone_number(bypass['custcont'])
                            time_formats = {'withSeparators': generate_current_date_with_midnight_time()}  # Mocking time formats
                            bypass_amt = float(bypass['amount'])

                            bypass['url'] = 'https://nairobiservices.go.ke/api/gateway/taifa/nrs/affirm'

                            # Simulating bty and code2
                            bty = bypass['invoice_no'].split('-')
                            bty[1] = bty[1].upper()

                            code2 = generate_account_number()
                            code2Date = generate_current_date_with_midnight_time()

                            data2 = {
                                "apiKey": "",
                                "type": None,
                                "billNumber": bypass['invoice_no'],
                                "billAmount": f"{bypass_amt:.1f}",
                                "phone": "null",
                                "transactionDate": code2Date,
                                "Field1": None,
                                "Field2": None,
                                "Field3": None,
                                "Field4": None,
                                "Field5": None,
                                "bankdetails": {
                                    "accountNumber": code2,
                                    "bankName": "Equity Bank",
                                    "debitAccount": bypass['invoice_no'],
                                    "debitCustName": f"{bypass['invoice_no']} {validation['description'].upper()}",
                                    "bankReference": code2,
                                    "customerReference": bypass['invoice_no'],
                                    "paymentMode": "cash"
                                },
                                "mpesadetails": None
                            }

                            obj2 = {
                                "success": True,
                                "description": "Payment Received Successfully",
                                "customer_no": "NULL",
                                "invoice_no": bypass['invoice_no'],
                                "invoice_report": "",
                                "balance": f"{bypass_amt:.1f}"
                            }

                            data2_json = json.dumps(data2, ensure_ascii=False)
                            obj2_json = json.dumps(obj2, ensure_ascii=False)

                            print(data2_json)

                            # SQL transaction
                            bankTransactions = f"""INSERT INTO bankTransactions (
                                bankCode, transactionRef, amount, acctRefNo, accName, description, institutionCode, institutionName, 
                                status, logDate, transacDate, apiCode, mobileNumber, transtatus, billNumber, tranParticular, paymentMode, 
                                phoneNumber, requestoutput, paymentChannel, Currency, BranchCode, status_1, ValidationDate, PushedComments, 
                                transtatus_1
                            ) VALUES (
                                '003', '{code2}', {bypass['amount']}, '{bypass['invoice_no']}', 'None', 'None', '{bypass['invoice_no']}', 
                                '{validation['description']}', 'None', '{time_formats['withSeparators']}', '{code2Date}', '2f11db8526fb2e170219e4a68215a1b8fe907a6c', 
                                null, 0, '{bypass['invoice_no']}', '{bypass['invoice_no']} {validation['description'].upper()}', 'cash', 'None', 
                                '{data2_json}', 'None', 'None', 'None', 'None', '{time_formats['withSeparators']}', '{obj2_json}', 0
                            )"""

                            print(bankTransactions)
                            print(universal_dab_b(bankTransactions, connection))

                            # API request to external service
                            url = 'http://192.168.100.116/gateway/taifa/nrs/affirm'
                            headers = {'Content-Type': 'application/json'}
                            payload = data2_json.encode('utf-8')
                            req = urllib.request.Request(url, data=payload, headers=headers)
                            with urllib.request.urlopen(req) as response:
                                print(response.read().decode())

    connection.close()

except pymysql.MySQLError as e:
    print(f"Database error: {e}")
except Exception as e:
    print(f"General error: {e}")
