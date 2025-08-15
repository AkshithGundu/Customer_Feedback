<?php

session_start();

require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"]== "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    $stmt = $conn->prepare("SELECT * FROM admin WHERE username=? AND password=? LIMIT 1");
    $stmt->bind_param("ss",$username,$password);

    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows === 1) {
        // $_SESSION['admin'] = $username;
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;

        header("location:admin_dashboard.php");
        exit();
    }
    else {
        echo "<script>
                    alert('Invalid Credentials.');
                    window.location.href='/CUSTOMER_FEEDBACK/Frontend/admin_login.html';
            </script>";
    }
}

?>