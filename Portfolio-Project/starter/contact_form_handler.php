<?php
$host = "localhost";
$dbname = "portfolio";
$username = "root";
$password = "";

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
  echo "error";
  exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $conn->real_escape_string(trim($_POST['Name']));
  $email = $conn->real_escape_string(trim($_POST['Email']));
  $subject = $conn->real_escape_string(trim($_POST['Subject']));
  $message = $conn->real_escape_string(trim($_POST['Message']));

  $sql = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
  if ($conn->query($sql) === TRUE) {
    // Optional email sending
    $to = "your_email@example.com"; // Replace
    $headers = "From: $email\r\nReply-To: $email\r\n";
    $mailBody = "Name: $name\nEmail: $email\nSubject: $subject\nMessage:\n$message";
    mail($to, $subject, $mailBody, $headers);
    
    echo "success";
  } else {
    echo "error";
  }
}
$conn->close();
?>
