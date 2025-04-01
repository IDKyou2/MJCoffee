<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>
    <link rel="stylesheet" href="style/OrderHistory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
</head>

<body>

    <?php
    include("navbar.php")
    ?>
    <br><br><br><br>

    <?php
    include("loader.php")
    ?>


    <?php
    require_once('backend/dbconn.php');

    if (isset($_GET['orderID']) && isset($_GET['customerID'])) {
        $orderID = $_GET['orderID'];
        $customerID = $_GET['customerID'];

        // Fetch all details from ordersummary, customer
        $stmtSummary = $conn->prepare("SELECT os.*, c.* FROM ordersummary os JOIN customer c ON os.customerID = c.customerID WHERE os.orderID = :orderID AND os.customerID = :customerID");
        $stmtSummary->bindParam(':orderID', $orderID);
        $stmtSummary->bindParam(':customerID', $customerID);
        $stmtSummary->execute();
        $orderSummary = $stmtSummary->fetch(PDO::FETCH_ASSOC);

        if (!$orderSummary) {
            die("No order found with the given details.");
        }

        // Fetch details from orderdetails and corresponding details from fooditem
        $stmtDetails = $conn->prepare("SELECT od.* FROM orderdetails od WHERE od.orderID = :orderID");
        $stmtDetails->bindParam(':orderID', $orderID);
        $stmtDetails->execute();
        $orderDetails = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);
    } else {
        die("OrderID and CustomerID required!");
    }
    ?>

    <div class="container">
        <div class="row">
            <p class="header">Order History</p>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card" style="border: 1px solid black;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-6 mb-4 mb-md-0 d-flex flex-column justify-content-between left-row">
                                <span class="margin">
                                    <p></p>
                                </span>
                                <p class="card-text-left"><?php echo date("F j, Y", strtotime($orderSummary['created_at'])) . ', ' . date("g:i A", strtotime($orderSummary['created_at'])); ?></p>
                                <p class="card-text-left">Name: <?php echo $orderSummary['name']; ?></p>
                                <p class="card-text-left">Address: <?php echo $orderSummary['address']; ?></p>
                                <p class="card-text-left"><strong> PickUp: <?php echo date("F j, Y", strtotime($orderSummary['pickup_at'])) . ', ' . date("g:i A", strtotime($orderSummary['pickup_at'])); ?> </strong></p>
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-between align-items-md-end">
                                <span>
                                    <a class="receipt" href="./GENERATE_PDF.php?orderID=<?php echo $orderID; ?>&customerName=<?php echo $orderSummary['name']; ?>&orderDate=<?php echo $orderSummary['created_at']; ?>" style="background-color: yellowgreen;" target="_blank">View</a>
                                </span>
                                <p class="card-text-right" style="color: rgb(65,105,225);"><strong><?php echo $orderSummary['status']; ?></strong></p>
                                <p class="card-text-right"><?php echo $orderSummary['phonenumber']; ?></p>
                                <p class="card-text-right">Total: <strong><?php echo number_format($orderSummary['totalprice'], 2); ?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>


    <div class="container">
        <div class="table-responsive">
            <div class="row">
                <table class="table align-middle mb-0 bg-white table_design">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($orderDetails as $detail) : ?>
                            <tr class="custom-border gap">
                                <td style="border-left: 1.5px solid black; width: 100px; margin: 0; padding: 0;">
                                    <div class="d-flex align-items-center">
                                        <img src='data:image/jpeg;base64,<?php echo base64_encode($detail['menuprofile']) ?>' alt="image" style="width: 280px; height: 280px;">
                                    </div>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1"><?php echo $detail['menuname']; ?></p>
                                </td>
                                <td>
                                    <p class="fw-normal mb-1">₱ <?php echo number_format($detail['priceperItem']); ?></p>
                                </td>
                                <td style="border-right: 1.5px solid black;">
                                    <p class="fw-normal mb-1"> <?php echo $detail['quantity']; ?></p>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </div><br>
    <?php
    include("footer.php")
    ?>
</body>

</html>