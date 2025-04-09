<?php
require_once('dbconn.php');

$stmt = $conn->prepare("SELECT * FROM fooditem WHERE menutype IN ('hot coffee', 'iced coffee') ORDER BY RAND() LIMIT 4");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<div class="container">
    <div class="row">
        <?php foreach ($results as $row) { ?>
            <div class="col-12 col-md-6 col-lg-3 mb-4">
                <form action="addToCart.php?redirect=<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
                    <input type="hidden" name="fooditemID" value="<?php echo $row['fooditemID']; ?>">
                    <div class="card h-100 card_style" style="border-radius: 20px;">
                        <div
                            class="not-available bg-danger text-light rounded shadow <?php if ($row['availability'] == 'available')
                                echo 'd-none'; ?>">
                            Not Available
                        </div>
                        <img src='data:image/jpeg;base64,<?php echo base64_encode($row['menuprofile']) ?>' alt="image"
                            class="card-img-top img-fluid">
                        <div class="card-body">
                            <p class="card-text mb-3">
                                <?php echo $row['menuname']; ?>
                                <br>
                                ₱ <?php echo $row['menuprice']; ?>
                            </p>
                            <div class="text-center">
                                <?php if (isset($_SESSION['customerID'])) { ?>
                                    <?php if ($row['availability'] == 'available') { ?>
                                        <button type="submit" name="addToCart_Search" class="cart_btn"
                                            style="border-radius: 10px;">
                                            Add to Cart
                                        </button>
                                    <?php } else { ?>
                                        <button type="button" onclick="itemUnavailable()" class="cart_btn btn-danger"
                                            style="border-radius: 10px;">
                                            Unavailable
                                        </button>
                                    <?php } ?>
                                <?php } else { ?>
                                    <button type="button" onclick="promptLogin()"
                                        class="cart_btn <?php if ($row['availability'] != 'available')
                                            ; ?>"
                                        style="border-radius: 10px;">
                                        Add to Cart
                                    </button>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        <?php } ?>
    </div>
</div>

<script>
    function promptLogin() {
        Swal.fire({
            icon: 'warning',
            title: 'Sorry',
            text: 'You need to login first!',
            showCancelButton: true,
            confirmButtonText: 'Login',
            cancelButtonText: 'Cancel'
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
            title: 'Sorry!',
            text: 'This item is not available right now.',
        });
    }
</script>

<?php
// For item update
if (isset($_SESSION['itemUpdated']) && $_SESSION['itemUpdated']) {
    unset($_SESSION['itemUpdated']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'warning',
                title: 'Item already added in your cart!',
                text: 'Item in your cart has been updated.',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        });
    </script>
    <?php
}
// For adding items
if (isset($_SESSION['itemAdded']) && $_SESSION['itemAdded']) {
    unset($_SESSION['itemAdded']);
    ?>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            Swal.fire({
                icon: 'success',
                title: 'Added to cart!',
                text: 'Your item has been added to the cart.',
                showConfirmButton: true,
                confirmButtonText: 'OK'
            });
        });
    </script>
    <?php
}
?>