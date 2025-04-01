<?php
session_start();
include 'db_connect.php';

if (!isset($_SESSION['farmer_id'])) {
    header("Location: login.php");
    exit();
}

$farmer_id = $_SESSION['farmer_id'];
$query = $conn->prepare("SELECT input_type, quantity, issue_date FROM issued_inputs WHERE farmer_id = ?");
$query->bind_param("i", $farmer_id);
$query->execute();
$result = $query->get_result();

echo "<h2>Issued Inputs</h2>";
echo "<table border='1'>
<tr>
    <th>Input Type</th>
    <th>Quantity</th>
    <th>Issue Date</th>
</tr>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>
        <td>" . $row['input_type'] . "</td>
        <td>" . $row['quantity'] . "</td>
        <td>" . $row['issue_date'] . "</td>
    </tr>";
}

echo "</table>";
?>
<a href="dashboard.php">Back to Dashboard</a>