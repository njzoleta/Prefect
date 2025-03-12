<?php
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            padding: 50px;
        }
        .error-container {
            background-color: #f8d7da;
            border: 1px solid #f5c6cb;
            padding: 20px;
            border-radius: 5px;
        }
        h1 {
            color: #721c24;
        }
        p {
            color: #856404;
        }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>Oops! Page Not Found (404)</h1>
        <p>Sorry, the page you are looking for doesn't exist.</p>
        <p><a href="user.php">Go back to the home page</a></p>
    </div>
</body>
</html>
