<?php
$email = $_POST['email'];
$user_password = $_POST['password'];

$authenticated = 0;

require_once '../config.php';

$db_password = $password; // Store DB password

$conn = new mysqli($servername, $username, $db_password, $database);
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT * FROM admin WHERE Email='$email' AND Passwrd='$user_password'";
// Execute the SQL query
$result = $conn->query($sql);

// Process the result set
if ($result->num_rows > 0) {
    $authenticated = 1;
    //echo "Authentication successful.";
} else {
  echo "<script>alert('Authentication failed. Please check your email and password.'); window.location.href = 'login.php';</script>";
  exit();
}

$testimonial_result = $conn->query("SELECT * FROM testimonial ORDER BY TestimonialID DESC");
$contact_result = $conn->query("SELECT * FROM contact ORDER BY ContactID DESC");

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1>Admin Dashboard</h1>
        <nav>
            <a href="login.php" class="btn btn-secondary">Logout</a>
        </nav>
        <br><br>
        <h2>Testimonials</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Position</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($testimonial_result && $testimonial_result->num_rows > 0) {
                    while ($row = $testimonial_result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['TestimonialID']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Position']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Message']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="4">No testimonials found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
        
        <h2>Contacts</h2>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($contact_result && $contact_result->num_rows > 0) {
                    while ($row = $contact_result->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . htmlspecialchars($row['ContactID']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Name']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Email']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Subject']) . '</td>';
                        echo '<td>' . htmlspecialchars($row['Message']) . '</td>';
                        echo '</tr>';
                    }
                } else {
                    echo '<tr><td colspan="5">No contacts found.</td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
    <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>