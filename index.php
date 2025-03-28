<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['AccountId']) && !empty($_POST['password'])) { 
        $AccountId = $connect->real_escape_string($_POST['AccountId']);
        $password = $_POST['password']; 

        $stmt = $connect->prepare("SELECT AccountId, password FROM bcp_sms3_admin WHERE AccountId = ?");
        if (!$stmt) {
            die("Prepare failed: " . $connect->error);
        }

        $stmt->bind_param('s', $AccountId);
        $stmt->execute();
        $stmt->bind_result($dbAccountId, $dbpassword);

        if ($stmt->fetch() && $password === $dbpassword) { // Use password_verify() if stored as hashed
            $_SESSION['AccountId'] = $dbAccountId;
            $_SESSION['admin'] = '1'; 
            session_regenerate_id(true);
            $stmt->close();
            header("Location: admin.php");
            exit();
        }

        $stmt->close(); // Close only once
        $error = "Invalid Account ID or password";
    } else {
        $error = "Please enter both Account ID and password";
    }
}

$connect->close();
?>
<?php if ($error): ?>
    <div class="error"><?php echo htmlspecialchars($error); ?></div>
<?php endif; ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Prefect Management System.">
    <link rel="stylesheet" href="assets\css\login.css">
    <title>Login - Prefect</title>
</head>
<body>
    <div class="logo">
        <img src="logo.png" alt="Logo">
        <p>Prefect Management System</p> 
    </div>
    
    <div class="login-container">
        <h2>Log Into Your Account</h2>
        
        <?php if (!empty($error)): ?>
            <div class="error-message" style="color: red;">
                <?= htmlspecialchars($error) ?>
            </div>
        <?php endif; ?>

        <form id="loginForm" method="post">
            <label for="AccountId">Account ID</label>
            <input type="number" id="AccountId" name="AccountId" required aria-label="AccountId">

            <label for="password">Password</label>
            <input type="password" id="password" name="password" required aria-label="password">

            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
