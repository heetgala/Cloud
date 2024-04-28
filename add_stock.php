<?php
// Include the database configuration file
include 'config.php';

if (isset($_POST['submit'])) {
    $item_name = $_POST['item_name'];
    $quantity = $_POST['quantity'];

    try {
        // Check if the item already exists in the database
        $stmt = $con->prepare("SELECT * FROM stock WHERE item_name = :item_name");
        $stmt->bindParam(':item_name', $item_name);
        $stmt->execute();
        $check_result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($check_result && count($check_result) > 0) {
            // Item exists, update its quantity
            $update_sql = "UPDATE stock SET quantity = quantity + :quantity WHERE item_name = :item_name";
            $stmt = $con->prepare($update_sql);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':item_name', $item_name);

            if ($stmt->execute()) {
                echo '<div class="success">Quantity updated successfully!</div>';
            } else {
                echo '<div class="error">Error updating quantity: ' . $stmt->errorInfo()[2] . '</div>';
            }
        } else {
            echo '<div class="error">Error: Item not found in stock.</div>';
        }
    } catch (PDOException $e) {
        // Handle database connection or query errors
        echo '<div class="error">Error: ' . $e->getMessage() . '</div>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Add Sports Stock</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 0;
      background-color: #f5f5f5;
    }

    .container {
      max-width: 600px;
      margin: 0 auto;
      padding: 20px;
      background-color: #fff;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    h2 {
      text-align: center;
      color: #333;
      margin-top: 0;
    }

    form {
      display: flex;
      flex-direction: column;
    }

    label {
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="number"],
    select {
      padding: 8px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 4px;
    }

    input[type="submit"] {
      background-color: #4CAF50;
      color: #fff;
      padding: 10px 20px;
      border: none;
      border-radius: 4px;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }

    input[type="submit"]:hover {
      background-color: #45a049;
    }

    .success {
      background-color: #d4edda;
      color: #155724;
      padding: 10px;
      border: 1px solid #c3e6cb;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    .error {
      background-color: #f8d7da;
      color: #721c24;
      padding: 10px;
      border: 1px solid #f5c6cb;
      border-radius: 4px;
      margin-bottom: 15px;
    }

    .logo {
      position: absolute;
      top: 20px;
      left: 20px;
      width: 100px;
      height: 100px;
    }
  </style>
</head>
<body>
  <img src="download.jpeg" alt="Company Logo" class="logo">
  <div class="container">
    <h2>Add Sports Stock</h2>
    <form action="add_stock.php" method="POST">
      <label for="item_name">Item Name:</label>
      <select id="item_name" name="item_name" required>
        <option value="">Select Item Name</option>
        <option value="Football">Football</option>
        <option value="Basketball">Basketball</option>
        <option value="Tennis Racket">Tennis Racket</option>
        <option value="Volleyball">Volleyball</option>
        <option value="Cricket Bat">Cricket Bat</option>
        <option value="Golf Clubs Set">Golf Clubs Set</option>
      </select>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" min="1" required>

      <input type="submit" name="submit" value="Add Stock">
    </form>
  </div>
</body>
</html>
