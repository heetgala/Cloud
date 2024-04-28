<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css"></link>
<title>WEB</title>
<h2 align="center" class="h">Welcome to WEB</h2>
</head>
<body id="b">
<center>
<div id="d">
<img src="download.jpeg" class="img"></img>
<center><form action="register.php" method="POST">
<b><label>Name</label>
<input name="name" type="text" id="form" placeholder="Enter your name" required>
</input>
<b><label>Email</label>
<input name="email" type="email" id="form" placeholder="Enter your email" required>
</input>
<b><label>Password</label>
<input name="pass" type="password" id="form" placeholder="Enter your Password" required>
</input>
<b><label>Confirm Password</label>
<input name="cpass" type="password" id="form" placeholder="Confirm your Password" required>
</input>
<!button work>

<input name="signup" type="submit" id="button" value="SIGN-UP">
</input>
<a href="index.php"><input name="back" type="button" id="button" value="BACK TO SIGN-IN">
</input>


</form></center>

</center>
<?php
include 'config.php';

if (isset($_POST['signup'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];

    // Validate inputs
    if (empty($name) || empty($email) || empty($pass) || empty($cpass)) {
        echo "<script>alert('All fields are required');</script>";
    } elseif ($pass != $cpass) {
        echo "<script>alert('Password and Confirm Password do not match');</script>";
    } else {
        // Check if email already exists
        $stmt = $con->prepare("SELECT * FROM user1 WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo "<script>alert('User already registered');</script>";
        } else {
            // Insert new user without hashing password
            $stmt = $con->prepare("INSERT INTO user1 (name, email, password) VALUES (:name, :email, :password)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':password', $pass); // Note: No hashing
            if ($stmt->execute()) {
                echo "<script>alert('Registration Successful'); window.location.href='home.html';</script>";
            } else {
                echo "<script>alert('Registration Failed');</script>";
            }
        }
    }
}
?>

</div>
</body>

</html>
