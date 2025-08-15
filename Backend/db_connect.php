<?php

    $server   = 'localhost:3307';
    $username = "root";
    $password = '';
    $db       = 'cust_feed';
    
    
    
    $conn = new mysqli($server,$username,$password,$db);

    if($conn->connect_error) {
        die("connection Failed: ". $conn->connect_error);
    }
    // else {
    //     echo "Connection Successfull...!!!";
    // }
?>