<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $location = $_POST['location'];

    // Check if phone number or email already exists
    $check_query = $conn->prepare("SELECT * FROM farmers WHERE phone_number = ? OR email = ?");
    $check_query->bind_param("ss", $phone_number, $email);
    $check_query->execute();
    $result = $check_query->get_result();

    if ($result->num_rows > 0) {
        echo "Phone number or email already registered!";
    } else {
        $query = $conn->prepare("INSERT INTO farmers (full_name, phone_number, email, password_hash, location) VALUES (?, ?, ?, ?, ?)");
        $query->bind_param("sssss", $full_name, $phone_number, $email, $password, $location);
        
        if ($query->execute()) {
            echo "Registration successful! You can now log in.";
        } else {
            echo "Error: " . $conn->error;
        }
    }
}
?>

<!-- HTML Form for Registration -->
<form action="register.php" method="POST">
    <input type="text" name="full_name" placeholder="Full Name" required>
    <input type="text" name="phone_number" placeholder="Phone Number" required>
    <input type="email" name="email" placeholder="Email">
    <input type="password" name="password" placeholder="Password" required>
    <input type="text" name="location" placeholder="Location" required>
    <button type="submit">Register</button>
</form>