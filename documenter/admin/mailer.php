<?php
// Database connection parameters
$host = 'localhost'; // your database host
$db = 'your_database'; // your database name
$user = 'your_username'; // your database username
$pass = 'your_password'; // your database password

// Create connection
$conn = new mysqli($host, $user, $pass, $db);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch user emails
$sql = "SELECT email FROM users";
$result = $conn->query($sql);

// Email template
$subject = "Your Subject Here";
$body = "Dear User,\n\nThis is your email template content.\n\nBest,\nYour Company";

// Send emails
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $email = $row['email'];

        // Send email using the mail() function
        if (mail($email, $subject, $body, 'From: your_email@example.com')) {
            echo "Email sent to: $email\n";
        } else {
            echo "Failed to send email to: $email\n";
        }
    }
} else {
    echo "No users found.";
}

// Close connection
$conn->close();
?>
