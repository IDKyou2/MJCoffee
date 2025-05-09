<?php
require_once('dbconn.php');

$stmt = $conn->prepare("SELECT * FROM fooditem WHERE menutype IN ('smoothies') ORDER BY RAND() LIMIT 4");
$stmt->execute();
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (!empty($results)) { ?>
    <div class="container">
        <div class="row">
            <?php foreach ($results as $row) { ?>
                <div class="col-12 col-md-6 col-lg-3 mb-4">
                    <form action="add_to_cart.php?redirect=<?php echo basename($_SERVER['PHP_SELF']); ?>" method="POST">
                        <input type="hidden" name="fooditemID" value="<?php echo $row['fooditemID']; ?>">
                        <div class="card h-100 card_style" style="border: none;">
                            <div class="not-available bg-danger text-light rounded shadow <?php if ($row['availability'] == 'available')
                                echo 'd-none'; ?>">
                                <text>
                                    Out of Stock
                                </text>
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
                                            <button type="submit" name="Add_To_Cart_Search" class="cart_btn"
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
                                        <button type="button" onclick="promptLogin()" class="cart_btn <?php if ($row['availability'] != 'available')
                                            ; ?>" style="border-radius: 10px;">
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
    <?php
} else {
    echo "&nbsp&nbsp&nbspNo items available yet.";
}
?>




<script>
    function promptLogin() {
        Swal.fire({
            icon: 'warning',
            title: 'Sorry',
            text: 'You need to login first!',
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


<?php if (isset($_GET['itemAdded']) && $_GET['itemAdded'] == 'true'): ?>
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
<?php endif; ?>