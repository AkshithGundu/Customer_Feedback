<?php
session_start();

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin_login.html");
    exit();
}

require '../Backend/db_connect.php';
 
// Fetch rating counts
$sql = "SELECT rating, COUNT(*) AS count FROM feedback GROUP BY rating ORDER BY rating ASC";
$result = $conn->query($sql);
 
$ratings = [];
$counts = [];
while ($row = $result->fetch_assoc()) {
    $ratings[] = $row['rating'];
    $counts[] = $row['count'];
}
 
// Fetch average rating
$sql_avg = "SELECT ROUND(AVG(rating), 2) AS avg_rating FROM feedback";
$result_avg = $conn->query($sql_avg);
$avg_rating = $result_avg->fetch_assoc()['avg_rating'];
 
$conn->close();
?>
 
<!DOCTYPE html>
<html>
<head>
    <title>Feedback Analytics</title>
    <link rel="stylesheet" href="admin_style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
 
<header>
    <h1>Feedback Analytics</h1>
    <nav>
        <a href="../Backend/admin_dashboard.php" class="btn">Dashboard</a>
        <a href="analytics.php" class="active">Analytics</a>
        <a href="logout.php" class="btn">Logout</a>
    </nav>
</header>
 
<main>
    <div style="width: 60%; margin: auto;">
        <canvas id="ratingChart"></canvas>
    </div>
 
    <h2 style="text-align:center; margin-top:20px;">
        Average Feedback Rating: ⭐ <?php echo $avg_rating; ?> / 5
    </h2>
</main>
 
<script>
    const ctx = document.getElementById('ratingChart').getContext('2d');
    const ratingChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?php echo json_encode($ratings); ?>,
            datasets: [{
                label: 'Number of Feedbacks',
                data: <?php echo json_encode($counts); ?>,
                backgroundColor: 'orange'
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { display: false },
                title: {
                    display: true,
                    text: 'Feedback Rating Distribution'
                }
            },
            scales: {
                y: { beginAtZero: true }
            }
        }
    });
</script>
 
</body>
</html>