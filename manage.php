<?php 

$action = $_POST['action'];

require_once 'config.php';

// VARIABLES

$name = $_POST['name'] ?? '';
$email = $_POST['email'] ?? '';
$subject = $_POST['subject'] ?? '';
$message = $_POST['message'] ?? '';
$position = $_POST['position'] ?? '';

function add_testimonal() {
        global $servername, $username, $password, $database;
    global $name, $email, $position, $message;
    $conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  echo "Connection failed: " . $conn->connect_error;
  return;
}

$sql = "INSERT INTO testimonal (Name, Position, Message)
VALUES ('$name', '$position', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Testimonial submitted successfully.'); window.location.href = 'index.html';</script>";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
}

function contact() {
    global $servername, $username, $password, $database;
    global $name, $email, $subject, $message;
    $conn = new mysqli($servername, $username, $password, $database);
// Check connection
if ($conn->connect_error) {
  echo "Connection failed: " . $conn->connect_error;
  return;
}

$sql = "INSERT INTO contact (Name, Email, Subject, Message)
VALUES ('$name', '$email', '$subject', '$message')";

if ($conn->query($sql) === TRUE) {
  echo "OK";
} else {
  echo "Error: " . $conn->error;
}

$conn->close();
}

// MAIN

if ($action == "1") {
    contact();
} else if ($action == "2") {
    add_testimonal();
} else {
    echo "Invalid action.";
}

?>