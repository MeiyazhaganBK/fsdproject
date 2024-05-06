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
            border:2px solid black;
            width:500px;
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

<nav class="navbar navbar-expand-lg navbar-dark fixed-top">
    <a class="navbar-brand" href="#">DonateBlood</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mr-auto"></ul>
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="home.html">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="index.html">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="signin.html">Signup</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="about.html">About</a>
        </li>
      </ul>
    </div>
  </nav>


<div class="container mt-5">
    <h2>Welcome to your profile</h2>
        <?php
        session_start();

        // Check if form is submitted
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get form data
            $email = $_POST['Email'];
            $password = $_POST['Password'];

            // Database connection
            $host = "localhost";
            $dbusername = "root";
            $dbpassword = "";
            $dbname = "donors";

            // Create connection
            $conn = new mysqli($host, $dbusername, $dbpassword, $dbname);

            if (mysqli_connect_error()) {
                die('Connect Error (' . mysqli_connect_errno() . ') ' . mysqli_connect_error());
            } else {
                // SQL query to check if the email and password match
                $query = "SELECT * FROM users WHERE Email=? AND Password=?";

                // Prepare statement
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $email, $password);
                $stmt->execute();
                $result = $stmt->get_result();

                // Check if user exists
                if ($result->num_rows == 1) {
                    // Login successful, store email in session variable
                    $_SESSION['Email'] = $email;
                    // Redirect to home page or display message
                    echo "Login successful";
                    echo '<br>';
                    
                    
                    // Fetch and display user details
                    while ($row = $result->fetch_assoc()) {
                        echo '<tr>';
                        echo "Name:";
                        echo '<td>' . $row['Name'] . '</td>';
                        echo '<br>';
                        echo "Email:";
                        echo '<td>' . $row['Email'] . '</td>';
                        echo '</tr>';
                    }
                    echo '</tbody>';
                    echo '</table>';
                } else {
                    // Invalid credentials, display message to sign up
                    echo "You are not signed up. Please sign up <a href='signin.html'>here</a>";
                }

                // Close statement and connection
                $stmt->close();
                $conn->close();
            }
        }
        ?>

</div>

</body>
</html>