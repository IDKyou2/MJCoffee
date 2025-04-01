<?php
session_start();
require_once('backend/dbconn.php');

if (!isset($_SESSION['customerID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['fooditemID'])) {
    $fooditemID = $_POST['fooditemID'];
    $customerID = $_SESSION['customerID'];
    $quantity = 1;

    // Check if the item already exists for the customer in the cart
    $stmt_check = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE customerID = :customerID AND fooditemID = :fooditemID");
    $stmt_check->bindParam(':customerID', $customerID);
    $stmt_check->bindParam(':fooditemID', $fooditemID);
    $stmt_check->execute();
    $result = $stmt_check->fetch(PDO::FETCH_ASSOC);

    if ($result['count'] > 0) {
        // If the item exists, update the quantity instead of inserting a new row
        $updateStmt = $conn->prepare("UPDATE cart SET quantity = quantity + :quantity WHERE customerID = :customerID AND fooditemID = :fooditemID");
        $updateStmt->bindParam(':quantity', $quantity);
        $updateStmt->bindParam(':customerID', $customerID);
        $updateStmt->bindParam(':fooditemID', $fooditemID);
        if ($updateStmt->execute()) {
            $_SESSION['itemUpdated'] = true;
            $redirectURL = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
            header('Location: ' . $redirectURL);
            exit();
        } else {
            echo "Error: Could not update cart.";
        }
    } else {
        // If the item doesn't exist, insert it into the cart
        $query = "INSERT INTO cart (quantity, customerID, fooditemID) VALUES (:quantity, :customerID, :fooditemID)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':customerID', $customerID);
        $stmt->bindParam(':fooditemID', $fooditemID);

        if ($stmt->execute()) {
            $_SESSION['itemAdded'] = true;
            $redirectURL = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
            header('Location: ' . $redirectURL);
            exit();
        } else {
            echo "Error: Could not add to cart.";
        }
    }
} else {
    die("Error: Food item not specified.");
}

?>


/* ---------------------------------------------------- COMMMMMMMMMMMMEEEEEEEEEEEEEEENTED --------------------------------------------------------------------
<?php

session_start();
require_once('backend/dbconn.php');

if (!isset($_SESSION['customerID'])) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['fooditemID'])) {
    $fooditemID = $_POST['fooditemID'];
    $customerID = $_SESSION['customerID'];

    $quantity = 1;

    $query = "INSERT INTO cart (quantity, customerID, fooditemID) VALUES (:quantity, :customerID, :fooditemID)";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':customerID', $customerID);
    $stmt->bindParam(':fooditemID', $fooditemID);

    if ($stmt->execute()) {
        $_SESSION['itemAdded'] = true;
        $redirectURL = isset($_GET['redirect']) ? $_GET['redirect'] : 'index.php';
        header('Location: ' . $redirectURL);
        exit();
    } else {
        echo "Error: Could not add to cart.";
    }
} else {
    die("Error: Food item not specified.");
}
?>
*/ ---------------------------------------------------- EEEEEEEEEEEEEEEEND LINE --------------------------------------------------------------------