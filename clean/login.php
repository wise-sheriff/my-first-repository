<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $phone_number = $_POST['phone_number'];
    $password = $_POST['password'];

    $query = $conn->prepare("SELECT farmer_id, full_name, password_hash FROM farmers WHERE phone_number = ?");
    $query->bind_param("s", $phone_number);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            $_SESSION['farmer_id'] = $row['farmer_id'];
            $_SESSION['full_name'] = $row['full_name'];
            echo "Login successful! Redirecting...";
            header("refresh:2;url=dashboard.php");
        } else {
            echo "Incorrect password!";
        }
    } else {
        echo "No farmer found with this phone number!";
    }
}
?>

<!-- HTML Form for Login -->
<form action="login.php" method="POST">
    <input type="text" name="phone_number" placeholder="Phone Number" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Login</button>
</form>