<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donors List</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            background-color: #f8f9fa; /* Background color */
            color: #333; /* Text color */
            font-family: Arial, sans-serif; /* Font family */
        }
        .container {
            margin-top: 50px; /* Top margin */
        }
        h2 {
            margin-bottom: 20px; /* Bottom margin for heading */
        }
        .table {
            background-color: #darksalmon; /* Table background color */
        }
        th {
            background-color: darksalmon; /* Header background color */
            color: #fff; /* Header text color */
        }
        th, td {
            border: 1px solid #dee2e6; /* Border color */
            padding: 10px; /* Padding */
        }
        tr:nth-child(even) {
            background-color: #f2f2f2; /* Alternate row background color */
        }
    </style>
    <link rel="stylesheet" href="home.css">
</head>
<body>

<div class="container mt-5">
    <h2>Donors List</h2>
    <?php
    $servername = "localhost"; // Your server address
    $username = "root"; // Your MySQL username
    $password = ""; // Your MySQL password
    $dbname = "donors"; // Your database name

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Retrieve blood group and city from POST request
    $bloodgrp = $_POST['bloodgrp'];
    $city = $_POST['city'];

    // SQL query to select donors based on blood group and city
    $sql = "SELECT * FROM users WHERE BloodGroup = '$bloodgrp' AND City = '$city'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

        echo '<table class="table table-striped">';
        echo '<thead>';
        echo '<tr>';
        echo '<th>Name</th>';
        echo '<th>Email</th>';
        echo '<th>Mobile Number</th>';
        echo '</tr>';
        echo '</thead>';
        echo '<tbody>';
        
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            echo '<tr>';
            echo '<td>' . $row["Name"]. '</td>';
            echo '<td>' . $row["Email"]. '</td>';
            echo '<td>' . $row["ContactNumber"]. '</td>';
            echo '</tr>';
        }

        echo '</tbody>';
        echo '</table>';
    } else {
        echo "No donors found for the selected criteria.";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
