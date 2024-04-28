<?php
// Include the database configuration file
include 'config.php';

if (isset($_POST['employeelogin'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    try {
        // Prepare SQL statement
        $stmt = $con->prepare("SELECT * FROM employee WHERE email = :email AND password = :pass");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            // User found, log them in
            session_start();
            $_SESSION['email'] = $email; // Store user's email in the session
            echo "<script>alert('Login Successful'); window.location.href='add_stock.php';</script>";
        } else {
            echo "<script>alert('Email or password incorrect');</script>";
        }
    } catch (PDOException $e) {
        // Handle database connection or query errors
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "<script>alert('Login form not submitted');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="style.css">
    <title>Employee Login</title>
    <h2 align="center" class="h">Welcome to Employee Section</h2>
</head>
<body id="b">
<div id="d">
    <img src="employee.jpg" class="img">
    <form action="employeelogin.php" method="POST">
        <label>Email</label>
        <input name="email" type="email" id="form" placeholder="Enter your email" required>
        <label>Password</label>
        <input name="pass" type="password" id="form" placeholder="Enter your Password" required>
        <input name="employeelogin" type="submit" id="button" value="LOGIN">
    </form>
</div>
</body>
</html>
