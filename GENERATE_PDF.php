<?php
require_once('dbconn.php');
require('./fpdf/fpdf.php');

$orderID = isset($_GET['orderID']) ? $_GET['orderID'] : '';
$customerName = isset($_GET['customerName']) ? $_GET['customerName'] : '';
$orderDate = isset($_GET['orderDate']) ? $_GET['orderDate'] : date("Y-m-d H:i:s"); // Use the current timestamp if not provided


$pdf = new FPDF('P', 'mm', "A4");

$pdf->AddPage();

$pdf->SetFont('Arial', 'B', 20); // Corrected font size format
$pdf->Cell(71, 10, '', 0, 0);
$pdf->Cell(50, 5, 'Receipt', 0, 0, 'C');
$pdf->Cell(59, 15, '', 0, 1);

$pdf->SetFont('Arial', 'B', 15); // Corrected font size format
$pdf->Cell(71, 5, 'Backstage Cafe', 0, 0);
$pdf->Cell(59, 5, '', 0, 0);
$pdf->Cell(59, 10, 'Details', 0, 1);

$pdf->SetFont('Arial', '', 10); // Corrected font size format
$pdf->Cell(130, 5, 'P. Sobrecarey St, Obrero, Davao City, Davao del Sur', 0, 0);
$pdf->Cell(25, 5, 'Name:', 0, 0);
$pdf->Cell(59, 5, $customerName, 0, 1);

$pdf->SetFont('Arial', '', 10); // Corrected font size format
$pdf->Cell(130, 5, 'City, 8000', 0, 0);
$pdf->Cell(25, 5, 'Order ID:', 0, 0);
$pdf->Cell(59, 5, $orderID, 0, 1);

$pdf->Cell(130, 5, '', 0, 0);
$pdf->Cell(25, 5, 'Date:', 0, 0);
$pdf->Cell(59, 5, date("F j, Y", strtotime($orderDate)) . ', ' . date("g:i A", strtotime($orderDate)), 0, 1);

$pdf->SetFont('Arial', 'B', 15);
$pdf->Cell(130, 5, 'Items', 0, 0);
$pdf->Cell(59, 5, '', 0, 0);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(189, 10, '', 0, 1);

$pdf->SetFont('Arial', 'B', 10);

/* Table Header */
$pdf->Cell(10, 6, 'No.', 1, 0, 'C');
$pdf->Cell(80, 6, 'Product Name', 1, 0, 'C');
$pdf->Cell(23, 6, 'Qty', 1, 0, 'C');
$pdf->Cell(30, 6, 'Price per Item', 1, 0, 'C');
$pdf->Cell(50, 6, 'Total', 1, 1, 'C'); // Adjusted table header

$pdf->SetFont('Arial', '', 10);


$utransac_id = isset($_GET['orderID']) ? $_GET['orderID'] : null;
$stmt = $conn->prepare("SELECT *
FROM customer
JOIN ordersummary ON customer.customerID = ordersummary.customerID
JOIN orderdetails ON orderdetails.orderID = ordersummary.orderID
WHERE ordersummary.orderID = :orderID");
$stmt->bindParam(':orderID', $utransac_id);
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Loop through the retrieved data from the database
$subtotal = 0;
foreach ($results as $row) {
  $pdf->Cell(10, 6, $row['orderdetailID'], 1, 0, 'C'); // Assuming 'orderdetailID' is the product ID
  $pdf->Cell(80, 6, $row['menuname'], 1, 0); // Use the actual column name for the product name
  $pdf->Cell(23, 6, $row['quantity'], 1, 0, 'R'); // Use the actual column name for quantity
  $pdf->Cell(30, 6, number_format($row['priceperItem'], 2), 1, 0, 'R'); // Format the price
  $totalPrice = $row['quantity'] * $row['priceperItem']; // Calculate total price
  $pdf->Cell(50, 6, number_format($totalPrice, 2), 1, 1, 'R'); // Adjusted table data with total price
  $subtotal += $totalPrice;
}

$pdf->Cell(118, 6, '', 0, 0);
$pdf->Cell(25, 7, 'Subtotal', 0, 0);
$pdf->Cell(50, 6, number_format($subtotal, 2), 1, 1, 'R'); // Display the calculated subtotal

// Define the filename for the PDF (e.g., "Order_123.pdf")
$filename = 'Order_' . $orderID . '.pdf';

// Send the appropriate headers to force download
header('Content-Type: application/pdf');
header('Content-Disposition: attachment; filename="' . $filename . '"');

$pdf->Output();
