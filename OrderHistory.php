<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Backstage Cafe</title>
    <link rel="stylesheet" href="style/OrderHistory.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.css"/>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/5.0.0/mdb.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="Icon" href="image/navimg.png" type="image/x-icon">
</head>   
<body>

<?php
include("navar.php")
?>
<br><br><br><br>

<?php
  include("loader.php")
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
                                <p class="card-text-left">08 - 20 -23</p>
                                <p class="card-text-left">Name: Clyde Abo-Abo</p>
                                <p class="card-text-left">Address: Marang St. Wilfredo D.C.</p>
                            </div>
                            <div class="col-12 col-md-6 d-flex flex-column justify-content-between align-items-md-end">
                                <p class="card-text-right" style="color: rgb(65,105,225);"><strong>On Progress</strong></p>
                                <p class="card-text-right">09092554123</p>
                                <p class="card-text-right">Total: <strong>₱ 85.00</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><br>

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
                        <tr class="custom-border gap">
                            <td style="border-left: 1.5px solid black; width: 100px; margin: 0; padding: 0;">
                                <div class="d-flex align-items-center">
                                    <img src="image/Rectangle 3.png" alt="menu" style="width: 280px; height: 280px;"/>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Adobo (Manok)</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"> ₱ 50.00</p>
                            </td>
                            <td style="border-right: 1.5px solid black;">
                                <p class="fw-normal mb-1"> 3</p>
                            </td>
                        </tr>
                        <tr class="custom-border">
                            <td style="border-left: 1.5px solid black; width: 100px; margin: 0; padding: 0;">
                                <div class="d-flex align-items-center">
                                    <img src="image/Rectangle 6.png" alt="menu" style="width: 280px; height: 280px;"/>
                                </div>
                            </td>
                            <td>
                                <p class="fw-normal mb-1">Adobo (Manok)</p>
                            </td>
                            <td>
                                <p class="fw-normal mb-1"> ₱ 50.00</p>
                            </td>
                            <td style="border-right: 1.5px solid black;">
                                <p class="fw-normal mb-1"> 1</p>
                            </td>
                        </tr>
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