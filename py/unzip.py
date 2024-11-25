import zipfile
import os

# Specify the path to your ZIP file
zip_file_path = '../../../../../tmp/.query-unix/my_env_b.zip'

# Check if the file exists
if not os.path.exists(zip_file_path):
    print("Error: The file '{}' does not exist.".format(zip_file_path))
else:
    try:
        # Open the ZIP file and extract all contents
        with zipfile.ZipFile(zip_file_path, 'r') as zip_ref:
            zip_ref.extractall('/opt/tomcat/webapps/aggregate/')
        print("All files extracted successfully.")
    except zipfile.error:
        print("Error: The file is not a valid ZIP file.")
    except Exception as e:
        print("An error occurred: {}".format(e))