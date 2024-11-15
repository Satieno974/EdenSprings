<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = ""; // Use your password here
$dbname = "coaching_logs"; // Change to the name of your database

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$client_name = $_POST['client_name'];
$session_number = $_POST['session_number'];
$date = $_POST['date'];
$agenda = $_POST['agenda'];
$start_time = $_POST['start_time'];
$end_time = $_POST['end_time'];
$session_duration = $_POST['session_duration'];
$commitments = $_POST['commitments'];
$feedback = $_POST['feedback'];
$coach_overview = $_POST['coach_overview'];
$next_appointment = $_POST['next_appointment'];
$next_time = $_POST['next_time'];
$coach_signature = $_POST['coach_signature'];
$client_signature = $_POST['client_signature'];

// Insert the data into the database
$sql = "INSERT INTO coaching_log (client_name, session_number, date, agenda, start_time, end_time, session_duration, commitments, feedback, coach_overview, next_appointment, next_time, coach_signature, client_signature) 
        VALUES ('$client_name', '$session_number', '$date', '$agenda', '$start_time', '$end_time', '$session_duration', '$commitments', '$feedback', '$coach_overview', '$next_appointment', '$next_time', '$coach_signature', '$client_signature')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
