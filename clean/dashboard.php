<?php
session_start();
if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Welcome, " . $_SESSION['full_name'] . "!</h2>";
?>
<a href="view_deliveries.php">View Deliveries</a><br>
<a href="view_payments.php">View Payments</a><br>
<a href="view_inputs.php">View Inputs</a><br>
<a href="logout.php">Logout</a>