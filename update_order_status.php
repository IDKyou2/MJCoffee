<?php
// Include your database connection code (dbconn.php) here

if (isset($_POST['orderID'])) {
    $orderID = $_POST['orderID'];
    require_once('dbconn.php');

    // Update the order status to "complete" in the ordersummary table
    $stmt = $conn->prepare("UPDATE ordersummary SET status = 'complete' WHERE orderID = :orderID");
    $stmt->bindParam(':orderID', $orderID, PDO::PARAM_INT);
    
    try {
        $stmt->execute();
        // Return a success message (you can customize this response)
        echo 'Order status updated successfully.';
    } catch (PDOException $e) {
        // Handle any errors that occur during the update
        echo 'Error updating order status: ' . $e->getMessage();
    }
} else {
    // Handle the case where 'orderID' is not provided in the POST request
    echo '';
}

// Close the database connection
$conn = null;
?>
