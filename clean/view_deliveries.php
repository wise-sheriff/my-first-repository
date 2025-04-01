<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$query = $conn->prepare("SELECT delivery_date, tonnage FROM deliveries WHERE farmer_id = ?");
$query->bind_param("i", $farmer_id);
$query->execute();
$result = $query->get_result();

echo "<h2>Produce Deliveries</h2>";
echo "<table border='1'>
<tr>
    <th>Date</th>
    <th>Tonnage (kg)</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['delivery_date'] . "</td>
        <td>" . $row['tonnage'] . "</td>
    </tr>";
}

echo "</table>";
?>
<a href="dashboard.php">Back to Dashboard</a>