<?php
$servername = "localhost";  
$username = "root";      
$password = "";      
$dbname = "military";

$conn = new mysqli($servername, $username, $password, $dbname);

echo "Here";die;

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    echo("Succesful\n");
}

$successMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $email = $_POST["email"];

    $sql = "INSERT INTO users (username, password, email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $email);

    if ($stmt->execute()) {
        $successMessage = "Account created successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
        /* Your CSS styles here */
    </style>
</head>
<body>
    <div class="container">
        <h2>Register</h2>
        <?php
        if (!empty($successMessage)) {
            echo "<p style='color: green;'>$successMessage</p>";
        }
        ?>
        <form action="register.php" method="post">
            <!-- Form fields here -->
            <button type="submit">Register</button>
        </form>
    </div>
</body>
</html> 
