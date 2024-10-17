import sys
import base64
import io
import argparse

def execute_encoded_script(decoded_code):
    try:
        # This function encapsulates the encoded script execution, isolating it from the main script
        exec(decoded_code)
    except Exception as e:
        print(f"Error during execution of encoded script: {e}")
        raise

def main():
    # Set up argument parser
    parser = argparse.ArgumentParser(description="Execute decoded Python code.")
    parser.add_argument('--code', type=str, required=True, help="Base64 encoded code to decode and execute")
    args = parser.parse_args()

    # Decode the provided Base64 code from the argument
    base64_code = args.code
    try:
        decoded_code = base64.b64decode(base64_code).decode('utf-8')
    except Exception as e:
        print(f"Error decoding Base64 string: {e}")
        return

    # Redirect stdout to capture the output of the executed code
    old_stdout = sys.stdout
    new_stdout = io.StringIO()
    sys.stdout = new_stdout

    try:
        # Execute the decoded Python code in isolation
        execute_encoded_script(decoded_code)
        output = new_stdout.getvalue()
    finally:
        # Restore the original stdout
        sys.stdout = old_stdout

    # Print the output directly as plain text
    print(output)

if __name__ == "__main__":
    main()
