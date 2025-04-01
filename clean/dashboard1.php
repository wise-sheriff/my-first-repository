<?php
session_start();
if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmer Dashboard</title>
    <link rel="stylesheet" href="style.css">
    <script src="script.js" defer></script>
</head>

<body>
    <div class="container">
        <h2>Welcome to the Maize Management System</h2>

        <button class="toggle-btn" data-target="deliveries">View Deliveries</button>
        <button class="toggle-btn" data-target="payments">View Payments</button>
        <button class="toggle-btn" data-target="inputs">View Issued Inputs</button>
        <button class="toggle-btn" data-target="reports">Generate Reports</button>
        <button onclick="window.location.href='logout.php'">Logout</button>

        <div id="deliveries" class="section" style="display:none;">
            <?php include 'view_deliveries.php'; ?>
        </div>

        <div id="payments" class="section" style="display:none;">
            <?php include 'view_payments.php'; ?>
        </div>

        <div id="inputs" class="section" style="display:none;">
            <?php include 'view_inputs.php'; ?>
        </div>

        <div id="reports" class="section" style="display:none;">
            <?php include 'generate_report.php'; ?>
        </div>
    </div>
</body>

</html>