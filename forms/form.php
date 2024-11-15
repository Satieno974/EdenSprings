<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection settings
    $servername = "localhost";
    $username = "root"; // replace with your database username
    $password = ""; // replace with your database password
    $dbname = "chaplaincy_registration"; // replace with your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Capture form data
    $surname = $_POST['surname'];
    $other_names = $_POST['other_names'];
    $chaplaincy_level = $_POST['chaplaincy_level'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $member = $_POST['member'];
    $membership_church = $_POST['membership_church'];
    $baptized = $_POST['baptized'];

    // Insert data into the database
    $stmt = $conn->prepare("INSERT INTO registrations (surname, other_names, chaplaincy_level, phone, email, member, membership_church, baptized) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssssss", $surname, $other_names, $chaplaincy_level, $phone, $email, $member, $membership_church, $baptized);

    if ($stmt->execute()) {
        echo "<h3>Registration successful!</h3>";
    } else {
        echo "<h3>Error: " . $stmt->error . "</h3>";
    }

    // Close connections
    $stmt->close();
    $conn->close();
}
?>
