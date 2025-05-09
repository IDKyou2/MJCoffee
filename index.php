<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJCoffee</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
    <link rel="stylesheet" href="style/index.css">
     <!-- Not available label css -->
    <link rel="stylesheet" href="style/not-availablee.css">

    <!-- Include the Swal library -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <style>

    </style>
</head>

<body style="background-color: #D2B48C;">
    <?php
    include("navbar.php")
        ?>
    <br><br><br><br>


    <div class="container">
        <div class="row">
            <div class="shop_header mt-3 col-12">
                <p class="head">Pick your order</p>
                <div class="d-flex flex-column flex-md-row justify-content-between mt-3">
                    <div class="btn-group mb-2 mb-md-0" style="box-shadow: none;">
                        <div class="dropdown">
                            <button class="categoryBtn dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Coffees
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="?category=all">All Menu</a>
                                <a class="dropdown-item" href="?category=hot coffee">Hot coffee</a>
                                <a class="dropdown-item" href="?category=iced coffee">Iced coffee</a>
                            </div>
                        </div>
                        <button class="categoryBtn" onclick="location.href='?category=Drinks';">
                            Smoothies
                        </button>

                    </div>
                    <!------------------------------------------------- Search button ---------------------------------------------->
                    <div class="d-flex align-items-center search mb-2 mb-md-0">
                        <form action="" method="GET" class="d-flex align-items-center">
                            <input type="text" name="searchItem" class="form-control mr-2"
                                placeholder="Search product here">
                            <button type="submit" class="btn_display">
                                <img src="image/search.svg" alt="Search" width="30" height="30">
                            </button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </div><br><br>

    <?php
    require_once('backend/dbconn.php');

    $category = $_GET['category'] ?? null;
    $searchItem = $_GET['searchItem'] ?? null;

    $query = "SELECT * FROM fooditem WHERE 1=1";
    $params = [];

    if ($category && $category != "all") {
        $query .= " AND menutype = :category";
        $params[':category'] = $category;
    }

    if ($searchItem) {
        $query .= " AND menuname LIKE :searchItem";
        $params[':searchItem'] = "%$searchItem%";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute($params);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    ?>
    <div class="container">
        <div class="row">
            <?php
            if (empty($results)) {

                echo '<div class="col-12 text-center" style="margin: 185px 0";>';
                echo '<p>No results found.</p>';
                echo '</div>';
            } else {
                foreach ($results as $row) {
                    ?>
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <form action="addToCart.php?redirect=<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
                            <input type="hidden" name="fooditemID" value="<?php echo $row['fooditemID']; ?>">
                            <div class="card h-100 card_style" style="border: none;">
                                <div class="not-available <?php if ($row['availability'] == 'available')
                                    echo 'd-none'; ?>">
                                    Not Available
                                </div>
                                <img src='data:image/jpeg;base64,<?php echo base64_encode($row['menuprofile']) ?>' alt="image"
                                    class="card-img-top img-fluid">
                                <div class="card-body">
                                    <p class="card-text mb-3">
                                        <?php echo $row['menuname']; ?>
                                        <br>
                                        ₱
                                        <?php echo $row['menuprice']; ?>
                                    </p>
                                    <div class="text-center">
                                        <?php
                                        $isLoggedIn = isset($_SESSION['customerID']);
                                        $isAvailable = ($row['availability'] === 'available');
                                        $buttonClass = $isAvailable ? 'addToCartBtn' : 'disabledBtn';
                                        $buttonText = $isAvailable ? 'Add to Cart' : 'Unavailable';

                                        if ($isLoggedIn) {
                                            if ($isAvailable) {
                                                // User is logged in and item is available
                                                ?>
                                                <button type="submit" name="addToCart" class="<?= $buttonClass ?>">
                                                    <?= $buttonText ?>
                                                </button>
                                            <?php } else {
                                                // User is logged in but item is not available
                                                ?>
                                                <button type="button" onclick="itemUnavailable()" class="<?= $buttonClass ?>">
                                                    <?= $buttonText ?>
                                                </button>
                                            <?php }
                                        } else {
                                            // User is not logged in
                                            ?>
                                            <button type="button" onclick="promptLogin()" class="<?= $buttonClass ?>">
                                                <?= $buttonText ?>
                                            </button>
                                        <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                }
            }
            ?>
        </div>
    </div>

    <script>
        function promptLogin() {
            Swal.fire({
                icon: 'warning',
                title: "Sorry, I don't recognize you.",
                text: 'You need to login first.',
                confirmButtonText: 'Login',
                cancelButtonText: 'Cancel',
                customClass: {
                    confirmButton: 'sweetAlertConfirmBtn',
                    cancelButton: 'sweetAlertCancelBtn'
                },
                showCancelButton: true,
                buttonsStyling: false, // Disable default SweetAlert2 styling

            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "login.php";
                }
            });
        }
    </script>


    <script>
        function itemUnavailable() {
            Swal.fire({
                icon: 'warning',
                title: "Forgive us!",
                text: 'This item is not available.',
            });
        }
    </script>


    <!---------------- This feature prevents pop-ups upon reloading the page. ------------------>
    <?php if (isset($_GET['added']) && $_GET['added'] == 1): {
        unset($_SESSION['added']);
    } ?>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                Swal.fire({
                    icon: 'success',
                    title: 'Added to cart!',
                    text: 'Your item has been added to the cart.',
                    showConfirmButton: true,
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Remove `added=1` from the URL without refreshing
                        const url = new URL(window.location.href);
                        url.searchParams.delete('added');
                        window.history.replaceState({}, document.title, url);
                    }
                });
            });
        </script>
    <?php endif; ?>




</body>

</html>