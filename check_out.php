<?php
require_once('backend/dbconn.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['customerID'])) {
        exit();
    }
    $customerID = $_SESSION['customerID'];

    // Check if cart is empty
    $stmt = $conn->prepare("SELECT COUNT(*) as item_count FROM cart WHERE customerID = :customerID");
    $stmt->bindParam(':customerID', $customerID);
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($result['item_count'] == 0) {
        $_SESSION['checkout_status'] = 'error';
        $_SESSION['checkout_message'] = 'Your Cart is Empty.';
        header("Location: cart.php");
        exit();
    }

    // Fetch cart details for the user
    $stmt = $conn->prepare("SELECT cart.quantity, fooditem.menuname, fooditem.menuprice, fooditem.menuprofile FROM cart JOIN fooditem ON cart.fooditemID = fooditem.fooditemID WHERE cart.customerID = :customerID");
    $stmt->bindParam(':customerID', $customerID);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Calculate total order price
    $overallTotalPrice = 0;
    foreach ($items as $item) {
        $overallTotalPrice += ($item['menuprice'] * $item['quantity']);
    }

    // Insert into OrderSummary table
    $stmt = $conn->prepare("
    INSERT INTO OrderSummary (orderDate, customerID, totalPrice, status, pickup_at) VALUES (NOW(), :customerID, :totalPrice, 'on progress', TIMESTAMPADD(HOUR, 2, NOW()))");
    $stmt->bindParam(':customerID', $customerID);
    $stmt->bindParam(':totalPrice', $overallTotalPrice, PDO::PARAM_STR);
    $stmt->execute();


    // Fetch the recently generated orderID
    $orderID = $conn->lastInsertId();

    // Insert each item from the cart into the OrderDetails table
    foreach ($items as $item) {
        $individualTotal = $item['menuprice'] * $item['quantity'];
        $stmt = $conn->prepare("INSERT INTO OrderDetails (orderID, quantity, pricePerItem, totalPrice, menuname, menuprofile) 
        VALUES (:orderID, :quantity, :pricePerItem, :totalPrice, :menuname, :menuprofile)");

        $stmt->bindParam(':orderID', $orderID);
        $stmt->bindParam(':quantity', $item['quantity']);
        $stmt->bindParam(':pricePerItem', $item['menuprice'], PDO::PARAM_STR);
        $stmt->bindParam(':totalPrice', $individualTotal, PDO::PARAM_STR);
        $stmt->bindParam(':menuname', $item['menuname']);
        $stmt->bindParam(':menuprofile', $item['menuprofile']);




        $stmt->execute();
    }

    // Clear the cart for the user
    $deleteStmt = $conn->prepare("DELETE FROM cart WHERE customerID = :customerID");
    $deleteStmt->bindParam(':customerID', $customerID);
    $deleteStmt->execute();

    $_SESSION['checkout_status'] = 'success';
    $_SESSION['checkout_message'] = 'Check out Successfully. Please Check Your Order In Order Summary';

    //header("Location: cart.php");
    header("Location: ordersummary.php");
}
