<?php

require 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"]=="POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $order_id = trim($_POST['order_id']);
    $rating = trim($_POST['rating']);
    $message = trim($_POST['message']);

    if(!empty($name)&& !empty($email) && !empty($order_id) && !empty($rating) && !empty($message) && $rating>=1 && $rating<=5) {
        $stmt = $conn->prepare("INSERT INTO feedback(name,email,order_id,rating,message) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssds",$name,$email,$order_id,$rating,$message);

        if($stmt->execute()) {
            echo "<script>
                    alert('Thank you!! Your Feedback has been submitted.');
                    window.location.href='/CUSTOMER_FEEDBACK/Frontend/feedback.html';
                 </script>";
        }
        else {
            echo "Error: ".$stmt->error;
        }
        $stmt->close();
    }
    else {
        echo "<script>
                    alert('Please fill in all the fields correctly.');
                    window.location.href='/CUSTOMER_FEEDBACK/Frontend/feedback.html';
             </script>";
    }
}

$conn->close();
?>