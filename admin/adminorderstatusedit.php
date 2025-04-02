<?php
require_once('dbconn.php');

if(isset($_GET['utransac_id']) && isset($_GET['orderstatus'])) {
  $utransac_id = $_GET['utransac_id'];
  $orderstatus = $_GET['orderstatus'];

  try {
  
    $sql = "UPDATE usertransaction SET orderstatus = :orderstatus WHERE utransac_id = :utransac_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':orderstatus', $orderstatus, PDO::PARAM_STR);
    $stmt->bindParam(':utransac_id', $utransac_id, PDO::PARAM_INT);
    $stmt->execute();

    header('Location: ' . $_SERVER['HTTP_REFERER']);
    exit();
  } catch(PDOException $e) {
    echo "Error updating order status: " . $e->getMessage();
  }
} 
?>
