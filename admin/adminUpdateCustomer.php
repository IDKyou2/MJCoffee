<?php
require_once('../backend/dbconn.php');

try {
    $sql = "UPDATE customer SET name = :newname, username = :newusername, address = :newaddress, role = :newrole, phonenumber = :newphonenumber WHERE customerID = :customerID";
    $stmt = $conn->prepare($sql);

    // Bind the parameters correctly
    $stmt->bindParam(':customerID', $_GET['customerID'], PDO::PARAM_STR);
    $stmt->bindParam(':newname', $_GET['newname'], PDO::PARAM_STR);
    $stmt->bindParam(':newusername', $_GET['newusername'], PDO::PARAM_STR);
    $stmt->bindParam(':newaddress', $_GET['newaddress'], PDO::PARAM_STR);
    $stmt->bindParam(':newrole', $_GET['newrole'], PDO::PARAM_STR);
    $stmt->bindParam(':newphonenumber', $_GET['newphonenumber'], PDO::PARAM_STR);

    // Execute the query
    $stmt->execute();

    // Redirect to the managecustomer.php page after the update
    header('Location: adminManageCustomer.php');
} catch (PDOException $e) {
    echo "ERROR: " . $e->getMessage();
}

$conn = null;
?>