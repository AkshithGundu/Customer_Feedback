<?php
    session_start();
    if (!isset($_SESSION['admin_logged_in'])|| $_SESSION['admin_logged_in'] !==true) {
        header("location:/CUSTOMER_FEEDBACK/Frontend/admin_login.html");
        exit();
    }
    require 'db_connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - FashionKart</title>
    <link rel="stylesheet" href="/CUSTOMER_FEEDBACK/Frontend/style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION['admin_username']); ?></h1>
        <nav>
                <a href="admin_dashboard.php">Dashboard</a>
                <a id="ana" href="../Admin/analytics.php">Analytics</a>
                <a href="../Frontend/admin_login.html">Logout</a>
        </nav>
    </header>

    <main>
        <h2>Customer Feedback</h2>
        <table border="1" cellpadding="10" cellspacing="0">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Order ID</th>
                <th>Rating</th>
                <th>Message</th>
                <th>Submitted At</th>
            </tr>

            <?php
                $result = $conn->query("SELECT * FROM feedback ORDER BY submitted_at ASC");

                while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['email']}</td>
                            <td>{$row['order_id']}</td>
                            <td>{$row['rating']}</td>
                            <td>{$row['message']}</td>
                            <td>{$row['submitted_at']}</td>
                            </tr>";
                }
            ?>
        </table>
    </main>
</body>
</html>