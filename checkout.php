<?php include 'config.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Sports Club E-Commerce Platform</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
            color: #333;
        }
        h1 {
            color: #ff9900;
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="text"], input[type="email"], input[type="tel"], select {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .card-details {
            display: none;
        }
        button {
            background-color: #ff9900;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
        }
        button:hover {
            background-color: #ffcc66;
        }
    </style>
</head>
<body>
    <h1>Checkout</h1>
    <form id="checkout-form" method="post">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" required>

        <label for="address">Shipping Address:</label>
        <input type="text" id="address" name="address" required>

        <label for="paymentMethod">Payment Method:</label>
        <select id="paymentMethod" name="paymentMethod" onchange="toggleCardDetails()" required>
            <option value="">Select Payment Method</option>
            <option value="creditCard">Credit Card</option>
            <option value="debitCard">Debit Card</option>
        </select>

        <div id="cardDetails" class="card-details">
            <label for="cardName">Cardholder Name:</label>
            <input type="text" id="cardName" name="cardName">

            <label for="cardNumber">Card Number:</label>
            <input type="text" id="cardNumber" name="cardNumber">

            <label for="expiryDate">Expiry Date:</label>
            <input type="text" id="expiryDate" name="expiryDate">

            <label for="cvv">CVV:</label>
            <input type="text" id="cvv" name="cvv">
        </div>

        <button type="submit">Complete Purchase</button>
    </form>

    <script>
        function toggleCardDetails() {
            const paymentMethod = document.getElementById("paymentMethod");
            const cardDetails = document.getElementById("cardDetails");

            if (paymentMethod.value === "creditCard" || paymentMethod.value === "debitCard") {
                cardDetails.style.display = "block";
            } else {
                cardDetails.style.display = "none";
            }
        }
    </script>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $fullname = $_POST["fullName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $address = $_POST["address"];
        $paymentMethod = $_POST["paymentMethod"];
        $cardName = isset($_POST["cardName"]) ? $_POST["cardName"] : "";
        $cardNumber = isset($_POST["cardNumber"]) ? $_POST["cardNumber"] : "";
        $expiryDate = isset($_POST["expiryDate"]) ? $_POST["expiryDate"] : "";
        $cvv = isset($_POST["cvv"]) ? $_POST["cvv"] : "";

        $sql = "INSERT INTO Orders (FullName, Email, Phone, Address, PaymentMethod, CardName, CardNumber, ExpiryDate, CVV)
                VALUES (:fullName, :email, :phone, :address, :paymentMethod, :cardName, :cardNumber, :expiryDate, :cvv)";
        $stmt = $con->prepare($sql);
        $stmt->bindParam(':fullName', $fullname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':phone', $phone);
        $stmt->bindParam(':address', $address);
        $stmt->bindParam(':paymentMethod', $paymentMethod);
        $stmt->bindParam(':cardName', $cardName);
        $stmt->bindParam(':cardNumber', $cardNumber);
        $stmt->bindParam(':expiryDate', $expiryDate);
        $stmt->bindParam(':cvv', $cvv);

        $stmt->execute();

        echo "Order placed successfully!";
    }
    ?>
</body>
</html>
