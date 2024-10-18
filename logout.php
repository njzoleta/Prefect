php
Copy code
<?php
    session_start();
    
    // Unset all session variables
    unset($_SESSION['Account_Id']);
    
    // Destroy the session
    session_destroy();
    
    // Redirect to login page (use relative URL)
    header("Location: /Prefect/login.php");
    exit;
?>