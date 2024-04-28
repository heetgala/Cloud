<?php
// Include the database configuration file
include 'config.php';

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $pass = $_POST['pass'];

    try {
        // Prepare SQL statement
        $stmt = $con->prepare("SELECT * FROM user1 WHERE email = :email AND password = :pass");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $pass);

        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($result) {
            // User found, log them in
            session_start();
            $_SESSION['email'] = $email; // Store user's email in the session
            echo "<script>alert('Login Successful'); window.location.href='home.html';</script>";
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
    <title>WEB</title>
    <h2 align="center" class="h">Welcome to LOGIN</h2>
</head>
<body id="b">
<div id="d">
    <img src="download.jpeg" class="img">
    <form action="index.php" method="post">
        <label>Email</label>
        <input name="email" type="email" id="form" placeholder="Enter your email" required>
        <label>Password</label>
        <input name="pass" type="password" id="form" placeholder="Enter your Password" required>
        <input name="login" type="submit" id="button" value="LOGIN">
    </form>
    <a href="register.php"><input type="button" id="button" value="REGISTER"></a>
</div>
<div class="navbar">
    <a href="employeelogin.php" class="right">Employee Login</a>
</div>
</body>
</html>
