<?php
session_start();

error_reporting(E_ALL);
ini_set('display_errors', 1);

include('connect.php');

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['AccountId']) && isset($_POST['Password'])) { 
        $AccountId = $connect->real_escape_string($_POST['AccountId']);
        $Password = $_POST['Password']; 

        // Check admin credentials
        $stmt = $connect->prepare("SELECT AccountId, Password FROM bcp_sms3_admin WHERE AccountId = ?");
        if (!$stmt) {
            die("Prepare failed: " . $connect->error);
        }
        $stmt->bind_param('s', $AccountId);
        $stmt->execute();
        $stmt->bind_result($dbAccountId, $dbPassword);
        $stmt->fetch();
        
        if ($dbAccountId && password_verify($Password, $dbPassword)) {
            // Successful admin login
            $_SESSION['AccountId'] = $dbAccountId;
            $_SESSION['User'] = '1'; 
            session_regenerate_id(true);
            header("Location: admin.php");
            exit();
        }

        $stmt->close();


        $stmt = $connect->prepare("SELECT AccountId, Password FROM bcp_sms3_user WHERE AccountId = ?");
        if (!$stmt) {
            die("Prepare failed: " . $connect->error);
        }
        $stmt->bind_param('s', $AccountId);
        $stmt->execute();
        $stmt->bind_result($dbAccountId, $dbPassword);
        $stmt->fetch();
        
        if ($dbAccountId && password_verify($Password, $dbPassword)) {
            // Successful user login
            $_SESSION['AccountId'] = $dbAccountId;
            $_SESSION['User  '] = '2'; // Removed trailing space
            session_regenerate_id(true); // Prevent session fixation
            header("Location: user.php");
            exit();
        }

        $error = "Invalid Account ID or Password";
        $stmt->close();
    } else {
        $error = "Please enter both Account ID and Password";
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
    <link href="assets/css/login.css" rel="stylesheet">
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
            <input type="number" id="AccountId" name="AccountId" required aria-label="Account Id">

            <label for="Password">Password</label>
            <input type="password" id="Password" name="Password" required aria-label="Password">

            <button type="submit">LOGIN</button>
        </form>
    </div>
</body>
</html>
