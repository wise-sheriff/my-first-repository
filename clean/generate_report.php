<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];

// Get total tonnage
$query = $conn->prepare("SELECT SUM(tonnage) AS total_tonnage FROM deliveries WHERE farmer_id = ?");
$query->bind_param("i", $farmer_id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$total_tonnage = $row['total_tonnage'] ?? 0;

// Get total payments
$query = $conn->prepare("SELECT SUM(amount) AS total_paid FROM payments WHERE farmer_id = ?");
$query->bind_param("i", $farmer_id);
$query->execute();
$result = $query->get_result();
$row = $result->fetch_assoc();
$total_paid = $row['total_paid'] ?? 0;

// Get total inputs received
$query = $conn->prepare("SELECT input_type, SUM(quantity) AS total_quantity FROM issued_inputs WHERE farmer_id = ? GROUP BY input_type");
$query->bind_param("i", $farmer_id);
$query->execute();
$input_results = $query->get_result();

echo "<h2>Farmer Report</h2>";
echo "<p><strong>Total Maize Delivered:</strong> " . $total_tonnage . " kg</p>";
echo "<p><strong>Total Payments Received:</strong> Ksh " . $total_paid . "</p>";

echo "<h3>Issued Inputs</h3>";
echo "<table border='1'>
<tr>
    <th>Input Type</th>
    <th>Total Quantity</th>
</tr>";

while ($row = $input_results->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['input_type'] . "</td>
        <td>" . $row['total_quantity'] . "</td>
    </tr>";
}

echo "</table>";
?>
<a href="dashboard.php">Back to Dashboard</a>