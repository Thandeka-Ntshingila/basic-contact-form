<?php

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_form";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Insert data into MySQL database
    $sql = "INSERT INTO contacts (first_name, last_name, phone_number, email, message)
            VALUES ('$first_name', '$last_name', '$phone_number', '$email', '$message')";

    if ($conn->query($sql) === TRUE) {
        // Send email confirmation
        $to = $email;
        $subject = "Thank You for Contacting Us!";
        $email_message = "Hello $first_name,\n\nThank you for reaching out to us. We have received your message and will get back to you soon.\n\nBest regards,\nYourCompany";
        $headers = "From: no-reply@yourcompany.com";

        mail($to, $subject, $email_message, $headers);

        echo "Success!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>


/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

