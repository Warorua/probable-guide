<%@ page import="java.io.*, java.util.*, javax.servlet.*, javax.servlet.http.*, javax.servlet.annotation.*" %>
<%
    // Define the hardcoded password for authentication
    final String hardcodedPassword = "TheHermitKingdom2024__";

    // Retrieve password from the request
    String password = request.getParameter("password");

    // Debugging: Log passwords
    System.out.println("Hardcoded password: '" + hardcodedPassword + "'");
    System.out.println("Received password: '" + (password == null ? "null" : password.trim()) + "'");

    // Check if the provided password matches the hardcoded password
    if (password == null || !password.trim().equals(hardcodedPassword)) {
        out.print("Authentication failed: Incorrect password.");
        return;
    }

    // Define the directory to save uploaded scripts
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
            out.print("File upload failed: " + e.getMessage());
            return;
        }
    }

    // Execute the uploaded Python script
    if (scriptFilePath != null && scriptFile.exists()) {
        try {
            // Use the Python binary in the virtual environment
            String virtualEnvPath = "/opt/tomcat/webapps/docs/netspi/netspi/aggregate/my_env_b/bin/python3";
            ProcessBuilder pb = new ProcessBuilder(virtualEnvPath, scriptFilePath);

            // Execute the script and capture output
            Process process = pb.start();
            BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
            BufferedReader errorReader = new BufferedReader(new InputStreamReader(process.getErrorStream()));

            String line;
            StringBuilder output = new StringBuilder();
            while ((line = reader.readLine()) != null) {
                output.append(line).append("\n");
            }

            while ((line = errorReader.readLine()) != null) {
                output.append("ERROR: ").append(line).append("\n");
            }

            reader.close();
            errorReader.close();

            out.print(output.toString());
        } catch (Exception e) {
            out.print("Error executing script: " + e.getMessage());
