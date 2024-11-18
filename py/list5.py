import sys
import os
import math
from datetime import datetime

# Add the directories containing site-packages to the system path
sys.path.insert(0, os.path.abspath(os.path.join(os.path.dirname(__file__), './my_env_b/lib/python3.6/site-packages')))


from smb.SMBConnection import SMBConnection


# Function to convert bytes to human-readable format
def convert_size(size_bytes):
    if size_bytes == 0:
        return "0 B"
    size_name = ("B", "KB", "MB", "GB", "TB", "PB")
    i = int(math.floor(math.log(size_bytes, 1024)))
    p = math.pow(1024, i)
    s = round(size_bytes / p, 2)
    return f"{s} {size_name[i]}"

try:
    # Establish an SMB connection
    conn = SMBConnection('', '', 'guest_machine', '192.168.0.64', use_ntlm_v2=True)
    assert conn.connect('192.168.0.64', 445)

    # List shares
    shares = conn.listShares()
    for share in shares:
        if share.name == 'tools':
            # List files in the 'tools' share
            files = conn.listPath('tools', '/')
            # Start HTML table
            html_table = """
            <table border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Type</th>
                        <th>Filename</th>
                        <th>Size</th>
                        <th>Last Modified</th>
                    </tr>
                </thead>
                <tbody>
            """
            for file in files:
                file_type = 'Folder' if file.isDirectory else 'File'
                file_size = convert_size(file.file_size)
                last_modified = datetime.fromtimestamp(file.last_write_time).strftime('%Y-%m-%d %H:%M:%S')
                html_table += f"""
                    <tr>
                        <td>{file_type}</td>
                        <td>{file.filename}</td>
                        <td>{file_size}</td>
                        <td>{last_modified}</td>
                    </tr>
                """
            # Close the HTML table
            html_table += """
                </tbody>
            </table>
            """
            # Print the HTML table
            print(html_table)
            break
    else:
        print("Share 'tools' not found.")

    # Close the connection
    conn.close()

except Exception as e:
    print(f"An error occurred: {e}")
