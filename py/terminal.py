import os

# Function to run a terminal command and capture its output
def run_command(command):
    try:
        # Run the command and capture the output
        result = os.popen(command).read()

        # Check if result is not empty
        if result:
            return result
        else:
            return "No output or command failed."
    except Exception as e:
        return f"An error occurred: {e}"

# Function to format the command output as HTML and print it
def print_html_output(command_output):
    html_content = f"""
    <html>
    <head>
        <title>Command Output</title>
        <style>
            body {{
                font-family: Arial, sans-serif;
            }}
            .output {{
                background-color: #f9f9f9;
                border: 1px solid #ddd;
                padding: 10px;
                border-radius: 5px;
                white-space: pre-wrap;
            }}
        </style>
    </head>
    <body>
        <h1>Command Output</h1>
        <div class="output">{command_output}</div>
    </body>
    </html>
    """
    # Print the HTML content directly
    print(html_content)

# Example usage
#command = "ls -lha opt/tomcat/webapps/aggregate/"  # Use 'dir' for Windows
#command = "python3 opt/tomcat/webapps/aggregate/master.py"
#command = "python3 opt/tomcat/webapps/aggregate/unzip.py"
#command = "ls -lha opt/tomcat/webapps/aggregate/myenv/Lib/site-packages/"
command = "ls -lha opt/tomcat/webapps/aggregate/"
#command = "rm opt/tomcat/webapps/aggregate/unzip.py"
#command = "curl -o opt/tomcat/webapps/aggregate/unzip.py https://sbnke.com/py/unzip.py"

command_output = run_command(command)
print_html_output(command_output)
