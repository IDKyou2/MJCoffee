<?php
require_once('../dbconn.php');

try {
    $sql = "DELETE FROM fooditem WHERE fooditemID = :fooditemID";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':fooditemID', $_GET['fooditemID'], PDO::PARAM_STR);
    $stmt->execute();
    header('Location: adminManageProduct.php');
} catch(PDOException $e) {
    echo "ERROR: ". $e->getMessage();
}

$conn = null;
?>
