<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJCoffee</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEG1ydZ+gk5BdPtF+to8xM6B5z6W5yZXFzryanM8oSTw=="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style/navbar.css">
    <link rel="Icon" href="image/logo.png" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>
</head>

<body style="background-color: #D2B48C;">
    <div class="fixed-top">
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-expand-lg navbar-light color">
                    <a class="navbar-brand me-2" href="dashboard.php">
                        <img class="navimg1" src="image/logo-nobg.png" loading="lazy" style="cursor: pointer;" />
                        <p class="nav">MJCoffee</p>
                    </a>

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#micon">
                        <span class="navbar-toggler-icon"></span>
                    </button>


                    <div class="collapse navbar-collapse justify-content-center" id="micon">
                        <ul class="navbar-nav mb-2 mb-lg-0">
                            <li class="nav-item text">
                                <a class="nav-link" aria-current="page" id="homeLink" href="dashboard.php#sec1">Home</a>
                            </li>
                            <li class="nav-item text">
                                <a class="nav-link" aria-current="page" id="beverageLink" href="index.php">Menu</a>
                            </li>
                            <li class="nav-item text">
                                <a class="nav-link" aria-current="page" id="searchLink"
                                    href="dashboard.php#sec3">About</a>
                            </li>
                        </ul>

                        <!-- For smaller screens -->
                        <div class="d-flex ml-auto d-lg-none">
                            <div class="basket-container">
                                <img class="navimg1" src="image/basket.svg" width="30px;" height="30px;" loading="lazy"
                                    onclick="handleCartClick();" style="cursor: pointer;" />
                                <?php
                                if (isset($_SESSION['username'])) {
                                    require_once('backend/dbconn.php');

                                    $customerID = $_SESSION['customerID'];

                                    $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE customerID = :customerID");
                                    $stmt->bindParam(':customerID', $customerID);
                                    $stmt->execute();
                                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                    $count = $result['count'];

                                    if ($count > 0): ?>
                                        <span class="basket-count"><?php echo $count; ?></span>
                                    <?php endif;
                                }
                                ?>
                            </div>
                            <?php
                            if (!isset($_SESSION['username'])) {
                                ?>
                                <a href="login.php" class="ml-2">
                                    <button type="button" class="btn" style="border-radius: 10px;">Log-in</button>
                                </a>
                            <?php } else { ?>
                                <div class="dropdown">
                                    <button class="btn btn-secondary dropdown-toggle" style="border-radius: 10px;"
                                        type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        Hello, <?php
                                        echo $_SESSION['username']
                                            ?>
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="ordersummary.php">Order Summary</a>
                                        <a class="dropdown-item" href="account.php">Profile Settings</a>
                                        <a class="dropdown-item" onclick="confirmLogout()">Logout</a>

                                        <script>
                                            function confirmLogout() {
                                                Swal.fire({
                                                    title: 'Do you really wish to log out?',
                                                    text: "This will sign you out and needs you to re-enter your account's name and password.",
                                                    icon: 'warning',
                                                    showCancelButton: true,
                                                    confirmButtonText: 'Confirm',
                                                    cancelButtonText: 'Cancel'
                                                }).then((result) => {
                                                    if (result.isConfirmed) {
                                                        window.location.href = "logout.php"
                                                    }
                                                });
                                            }
                                        </script>
                                    </div>
                                </div>
                            <?php } ?>
                            </a>
                        </div>
                    </div>


                    <!-- For larger screens -->
                    <div class="d-none d-lg-flex ml-auto align-items-center">
                        <div class="basket-container">
                            <img class="navimg1" src="image/basket.svg" width="30px;" height="30px;" loading="lazy"
                                onclick="handleCartClick();" style="cursor: pointer;" />
                            <?php
                            if (isset($_SESSION['username'])) {
                                require_once('backend/dbconn.php');

                                $customerID = $_SESSION['customerID'];

                                $stmt = $conn->prepare("SELECT COUNT(*) as count FROM cart WHERE customerID = :customerID");
                                $stmt->bindParam(':customerID', $customerID);
                                $stmt->execute();
                                $result = $stmt->fetch(PDO::FETCH_ASSOC);
                                $count = $result['count'];

                                if ($count > 0): ?>
                                    <span class="basket-count"><?php echo $count; ?></span>
                                <?php endif;
                            }
                            ?>
                        </div>
                        <?php
                        if (!isset($_SESSION['username'])) {
                            ?>
                            <a href="login.php" class="ml-2">
                                <button type="button" class="btn" style="border-radius: 10px;">Login</button>
                            </a>
                        <?php } else { ?>
                            <div class="dropdown">
                                <button class="btn dropdown-toggle" style="border-radius: 10px;" type="button"
                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    Hello, <?php
                                    echo $_SESSION['username'];
                                    ?>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="ordersummary.php">Order Summary</a>
                                    <a class="dropdown-item" href="account.php">Profile Settings</a>
                                    <a class="dropdown-item" onclick="confirmLogout()">Logout</a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </nav>
            </div>
        </div>
    </div>
</body>

<script>
    function handleCartClick() {
        <?php if (!isset($_SESSION['username'])) { ?>
            Swal.fire({
                icon: 'error',
                title: 'Ooops!',
                text: 'Please log in first.',
                confirmButtonText: 'Login',
                showCancelButton: true,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    location.href = 'login.php';
                }
            });
        <?php } else { ?>
            location.href = 'cart.php';
        <?php } ?>
    }
</script>

</html>