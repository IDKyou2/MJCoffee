<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
    <link rel="stylesheet" href="style/orderdetails.css">
</head>

<body>

    <?php
    include("navbar.php")
    ?>
    <?php
    include("loader2.php")
    ?>


    <?php
    require_once('backend/dbconn.php');
    if (!$_SESSION['customerID']) {
        // Handle the error or redirect to the login page
        exit("User not logged in.");
    }

    $customerID = $_SESSION['customerID'];

    $stmt = $conn->prepare("SELECT * FROM ordersummary WHERE customerID = :customerID");
    $stmt->bindParam(':customerID', $customerID);
    $stmt->execute();
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="container mt-5">
        <p class="order_header">Order Details</p>

        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <thead>
                                <tr>
                                    <th class="text-center align-middle">Order Date</th>
                                    <th class="text-center align-middle">Order Total</th>
                                    <th class="text-center align-middle">Status</th>
                                    <th class="text-center align-middle">Actions</th>
                                </tr>
                            </thead>
                        <tbody>
                            <?php foreach ($orders as $order) : ?>
                                <tr>
                                    <td class="text-center align-middle"><?php echo $order['orderdate']; ?></td>
                                    <td class="text-center align-middle"><?php echo number_format($order['totalprice'], 2); ?></td>
                                    <td class="text-center align-middle"><?php echo $order['status']; ?></td>
                                    <td class="text-center align-middle">
                                        <a href="Orderdetails.php?orderID=<?php echo $order['orderID']; ?>&customerID=<?php echo $customerID; ?>">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                                <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8zM1.173 8a13.133 13.133 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.133 13.133 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5c-2.12 0-3.879-1.168-5.168-2.457A13.134 13.134 0 0 1 1.172 8z" />
                                                <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5zM4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0z" />
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>

    <?php
    include("footer.php");
    ?>

</body>

</html>