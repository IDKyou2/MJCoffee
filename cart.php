<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
    <link rel="stylesheet" href="style/cart.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

</head>

<body>
    <?php
    require_once("navbar.php");
    ?>
    <br><br><br><br>


    <?php
    require_once('backend/dbconn.php');

    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    $stmt = $conn->prepare("SELECT customerID FROM customer WHERE username = :username");
    $stmt->bindParam(':username', $_SESSION['username']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    $customerID = $user['customerID'];

    $stmt = $conn->prepare("
    SELECT cart.quantity, fooditem.*, customer.customerID
    FROM cart 
    JOIN fooditem ON cart.fooditemID = fooditem.fooditemID
    JOIN customer ON cart.customerID = customer.customerID
    WHERE cart.customerID = :customerID
");

    $stmt->bindParam(':customerID', $customerID);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include('backend/check-availability.php');
    checkAvailability($items, $conn, $customerID);

    ?>


    <div class="container mt-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-6 text-md-start text-center">
                <p class="mb-0 header_p">Shopping Cart</p>
            </div>
            <div class="col-12 col-md-6 text-md-end text-center mt-2 mt-md-0">
                <form id="clearCartForm" action="clear_cart.php" method="post">
                    <input type="hidden" name="customerID"
                        value="<?php echo isset($_SESSION['customerID']) ? $_SESSION['customerID'] : ''; ?>">
                    <button type="button" onclick="confirmClearCart()" class="header_btn">Delete
                        All</button><br>
                </form>

                <script>
                    function confirmClearCart() {
                        Swal.fire({
                            title: 'Are you sure?',
                            text: 'You will delete all items from the cart.',
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonText: 'Yes',
                            cancelButtonText: 'No'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                document.getElementById("clearCartForm").submit();
                            }
                        });
                    }
                </script>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="table-responsive">
            <div class="row">
                <table class="table align-middle mb-1 bg-white tableDesign">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Product Name</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (empty($items)) { ?>
                            <tr>
                                <td colspan="5" class="text-center" style="padding: 120px 0;">Your Cart is Empty.</td>
                            </tr>
                        <?php } else { ?>
                            <?php foreach ($items as $item) { ?>
                                <tr class="custom-border gap">
                                    <td style="width: 100px; margin: 0; padding: 0;">
                                        <div class="d-flex align-items-center">
                                            <img src='data:image/jpeg;base64,<?php echo base64_encode($item['menuprofile']) ?>'
                                                alt="menu" style="width: 280px; height: 280px;" />
                                        </div>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"><?php echo $item['menuname']; ?></p>
                                    </td>
                                    <td>
                                        <p class="fw-normal mb-1"> ₱ <?php echo $item['menuprice']; ?></p>
                                    </td>
                                    <form action="update_cart.php?redirect=<?php echo basename($_SERVER['PHP_SELF']) ?>"
                                        method="POST">
                                        <td>
                                            <input type="hidden" name="fooditemID"
                                                value="<?php echo isset($item['fooditemID']) ? $item['fooditemID'] : ''; ?>">

                                            <input type="hidden" name="customerID"
                                                value="<?php echo isset($_SESSION['customerID']) ? $_SESSION['customerID'] : ''; ?>">

                                            <input class="quan_input" type="number" name="quantity"
                                                style="width: 70px; border-radius: 10px; text-align: center;" min="1" max="50"
                                                value="<?php echo $item['quantity']; ?>">
                                        </td>
                                        <td>
                                            <p class="fw-normal mb-1"><?php echo $item['menuprice'] * $item['quantity']; ?> </p>
                                        </td>
                                        <?php if (isset($_SESSION['update_success']) && $_SESSION['update_success'] == true): ?>
                                            <script>
                                                Swal.fire({
                                                    icon: 'success',
                                                    title: 'Updated!',
                                                    text: 'Quantity updated successfully.'
                                                });
                                            </script>
                                            <?php
                                            // Unset the session variable after displaying the alert
                                            unset($_SESSION['update_success']);
                                        endif;
                                        ?>
                                        <td>
                                            <!------------------------------- Update button -------------------------------->
                                            <button type="submit" class="updateBtn"><i class=""></i> Update Cart</button>
                                            <!------------------------------- Delete button -------------------------------->
                                            <a href="remove_cart.php?fooditemID=<?php echo $item['fooditemID']; ?>&customerID=<?php echo $customerID; ?>&quantity=<?php echo $item['quantity']; ?>"
                                                class="deleteBtn"><i class="bi bi-trash"></i> Delete</a>
                                        </td>
                                    </form>
                                </tr>
                            <?php } ?>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php
    if (isset($_SESSION['cart_message'])) {
        if ($_SESSION['cart_message'] === "empty") {
            echo '<script>
                Swal.fire({
                    icon: "info",
                    title: "Info",
                    text: "No items to be Deleted."
                });
              </script>';
        } elseif ($_SESSION['cart_message'] === "items_deleted") {
            echo '<script>
                Swal.fire({
                    icon: "success",
                    title: "Success",
                    text: "All items have been Deleted from the Cart."
                });
              </script>';
        }
        unset($_SESSION['cart_message']);
    }

    if (isset($_SESSION['cart-message']) && $_SESSION['cart-message'] == "item_deleted") {
        echo '<script> 
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: "success",
                title: "Deleted",
                text: "Item was successfully deleted."
            });
        });
        </script>';
        unset($_SESSION['cart-message']);
    }
    ?>




    <div class="container">
        <div class="row align-items-center justify-content-end">
            <div class="col-12 text-center text-md-right col-md-2">
                <p class="mb-2 mb-md-0 check_text">Grandtotal:</p>
            </div>
            <div class="col-12 text-center text-md-right col-md-2">
                <p class="mb-2 mb-md-0 check_text">₱
                    <?php
                    $totalPrice = 0;

                    foreach ($items as $item) {
                        $totalPrice += ($item['menuprice'] * $item['quantity']);
                    }
                    echo number_format($totalPrice, 2);
                    ?>
                </p>
            </div>
            <div class="col-12 text-center text-md-right col-md-2 pad">
                <form id="checkoutForm" action="check_out.php" method="post">
                    <button type="button" onclick="confirmCheckout()" class="btn_check">Proceed to checkout</button>
                </form>
            </div>
        </div>
    </div><br>
    </div>
    </div><br><br>

    <script>
        function confirmCheckout() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'Do you want to check out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No'
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById("checkoutForm").submit();
                }
            });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            <?php if (isset($_SESSION['checkout_status']) && $_SESSION['checkout_status'] == 'error'): ?>
                Swal.fire('Error', '<?php echo $_SESSION['checkout_message']; ?>', 'error');
                <?php unset($_SESSION['checkout_status'], $_SESSION['checkout_message']);
            endif; ?>

            <?php if (isset($_SESSION['checkout_status']) && $_SESSION['checkout_status'] == 'success'): ?>
                Swal.fire('Success', '<?php echo $_SESSION['checkout_message']; ?>', 'success');
                <?php unset($_SESSION['checkout_status'], $_SESSION['checkout_message']);
            endif; ?>
        });
    </script>
    <br><br>
</body>

</html>