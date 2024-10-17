<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Base64 Decoder</title>
    <!-- Bootstrap 4 CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            background-color: #f8f9fa;
            font-family: Arial, sans-serif;
        }
        .container {
            margin-top: 50px;
        }
        .decoded-output {
            white-space: pre-wrap; /* Preserves line breaks */
            word-wrap: break-word; /* Prevents long words from overflowing */
        }
    </style>
</head>
<body>

    <div class="container">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center">Base64 Decoder</h5>
                <div class="form-group">
                    <label for="base64Input">Paste Base64-encoded text:</label>
                    <textarea class="form-control" id="base64Input" rows="4" placeholder="Paste your Base64 string here"></textarea>
                </div>
                <div class="form-group">
                    <label for="decodedOutput">Decoded Output:</label>
                    <pre class="form-control decoded-output" id="decodedOutput"></pre>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 4 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Automatically decode the Base64 input
        $(document).ready(function() {
            $('#base64Input').on('input', function() {
                var base64Text = $(this).val();
                try {
                    // Decode Base64 and display it
                    var decodedText = atob(base64Text);
                    $('#decodedOutput').text(decodedText);
                } catch (e) {
                    $('#decodedOutput').text("Invalid Base64 string.");
                }
            });
        });
    </script>

</body>
</html>
