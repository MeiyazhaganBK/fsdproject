<?php
$servername = "localhost"; // or your server address
$username = "root"; // your MySQL username
$password = ""; // your MySQL password
$dbname = "donors"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$fname = $_POST['fname'];
$email = $_POST['email'];
$password = $_POST['password'];
$gender = $_POST['gender'];
$age = $_POST['age'];
$dob = $_POST['dob'];
$bloodgrp = $_POST['bloodgrp'];
$number = $_POST['number'];
$city = $_POST['city'];


// SQL query to insert data into table
$sql = "INSERT INTO users(Name, Email, Password, Gender, Age, DOB, BloodGroup, ContactNumber, City)
VALUES ('$fname', '$email', '$password', '$gender', '$age', '$dob', '$bloodgrp', '$number', '$city')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
