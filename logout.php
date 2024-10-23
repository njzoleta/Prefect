php
Copy code
<?php
    session_start();

    unset($_SESSION['Account_Id']);
    
    session_destroy();

    header("Location: /Prefect/index.php");
    exit;
?>