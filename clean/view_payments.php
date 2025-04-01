<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$query = $conn->prepare("SELECT payment_date, amount FROM payments WHERE farmer_id = ?");
$query->bind_param("i", $farmer_id);
$query->execute();
$result = $query->get_result();

echo "<h2>Payment History</h2>";
echo "<table border='1'>
<tr>
    <th>Payment Date</th>
    <th>Amount (Ksh)</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['payment_date'] . "</td>
        <td>Ksh " . $row['amount'] . "</td>
    </tr>";
}

echo "</table>";
?>
<a href="dashboard.php">Back to Dashboard</a>