<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MJCoffee</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style\adminDesign.css.css">
    <link rel="stylesheet" href="navardesign/tabledesignn.css">
    <script defer src="active_link.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

</head>

<body>
    <?php require_once('../backend/dbconn.php'); ?>

    <?php
    include("../loader.php")
        ?>

    <?php
    // Get the beverage ID from the URL
    $fooditemID = $_GET['fooditemID'];

    // Retrieve the existing beverage data from the database
    $stmt = $conn->prepare("SELECT * FROM fooditem WHERE fooditemID = ?");
    $stmt->execute([$fooditemID]);
    $row = $stmt->fetch();
    ?>
    <br><br>
    <form action="adminEditProduct.php?fooditemID=<?php echo $fooditemID; ?>" method="post"
        enctype="multipart/form-data">
        <!-------------------------------------------------- Back button -------------------------------------------->
        <div class="container">
            <div class="row mx-auto">
                <a href="adminManageProduct.php">
                    <button type="button" class="btn" style="width: 200px; background-color: #9A4444; color:white;"><i
                            class="bi bi-backspace-fill" style="padding-right: 10px;"></i>Back to Menu</button>
                </a>
            </div>
        </div>
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6 p-4" style="border: 2px solid #9A4444;">
                    <h2 style="text-align: center; font-weight: bold">Update Menu Item</h2><br>
                    <h3 style="font-size: 18px;"><strong>Old Product Name:</strong> <?php echo $row['menuname'] ?></h3>
                    <br>
                    <div class="mb-3">
                        <label for="menuname" class="form-label">Product label</label>
                        <input type="text" id="menuname" name="menuname" value="<?php echo $row['menuname']; ?>"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="menuprice" class="form-label">Price</label>
                        <input type="number" id="menuprice" name="menuprice" value="<?php echo $row['menuprice']; ?>"
                            class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="menutype" class="form-label">Category</label>
                        <select id="menutype" name="menutype" class="form-control">
                            <option value="hot coffee" <?php if ($row['menutype'] == 'hot coffee')
                                echo 'selected'; ?>>Hot
                                Coffee</option>
                            <option value="iced coffee" <?php if ($row['menutype'] == 'iced coffee')
                                echo 'selected'; ?>>
                                Iced coffee</option>
                            <option value="smoothies" <?php if ($row['menutype'] == 'smoothies')
                                echo 'selected'; ?>>
                                Smoothies</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="availability" class="form-label">Availability</label>
                        <select id="availability" name="availability" class="form-control">
                            <option value="available" <?php if ($row['availability'] == 'available')
                                echo 'selected'; ?>>
                                Available</option>
                            <option value="not available" <?php if ($row['availability'] == 'not available')
                                echo 'selected'; ?>>Not Available</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <?php
                        $img_data = base64_encode($row['menuprofile']);
                        $img_type = 'image/jpeg';
                        ?>
                        <label for="product_image">Image:</label><br>
                  
                            <img src="data:<?php echo $img_type; ?>;base64,<?php echo $img_data; ?>" width="250"
                                height="250">
                      
                    </div>  
                    <div class="mb-3">
                        <label for="menuprofile" class="form-label">Choose New Image</label>
                        <input type="file" id="menuprofile" name="menuprofile" class="form-control">
                    </div><br>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn" style="background-color: #9A4444; color:white;">Save
                            Changes</button>
                    </div>
                </div>
            </div><br><br>
        </div>
    </form>
</body>

</html>