<?php
    session_start();
    session_unset();
    session_destroy();
    
    header("Location:/CUSTOMER_FEEDBACK/Frontend/admin_login.html");

    exit();
?>