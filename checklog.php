<?php
function check_login()
{

    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }


    if (empty($_SESSION['Username'])) {
        $_SESSION['Username'] = '';


        $host = $_SERVER['HTTP_HOST'];
        $uri  = rtrim(dirname($_SERVER['PHP_SELF']), '/\\');
        $extra = "index.php";

        header("Location: http://$host$uri/$extra");
        exit(); 
    }
}
?>
