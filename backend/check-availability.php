<?php

function checkAvailability($items, $conn, $customerID)
{
  // Check and remove items that are not available
  foreach ($items as $key => $item) {
    if ($item['availability'] !== 'available') {
      // Item is not available, remove it from the cart
      $fooditemID = $item['fooditemID'];
      $stmt = $conn->prepare("DELETE FROM cart WHERE customerID = :customerID AND fooditemID = :fooditemID");
      $stmt->bindParam(':customerID', $customerID);
      $stmt->bindParam(':fooditemID', $fooditemID);
      $stmt->execute();

      // Remove the item from the $items array
      unset($items[$key]);

      // Trigger a page reload after removing the item
      echo '<script>window.location.reload();</script>';
    }
  }
}
