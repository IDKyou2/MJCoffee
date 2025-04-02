<div class="fixed-top">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Container wrapper -->
        <div class="container">
            <!-- Navbar brand -->
            <a class="navbar-brand me-2" href="adminhome.php">
                <img class="logo" style="height: 60px; width: 100px; margin-right: 100px;" src="../image/admin2.jpg" loading="lazy">
            </a>

            <!-- Toggle button -->
            <div class="navbar-header">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#micon">
                    <span><i class="bi bi-list"></i></span>
                </button>
            </div>

            <!-- Collapsible wrapper -->
            <div class="collapse navbar-collapse" id="micon">
                <!-- Left links -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0 ms-4">
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="adminhomelink" href="adminhome.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="adminhomelink" href="adminManageProduct.php">Manage Menu items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" id="managecustomerLink" href="admin/managecustomer.php">Manage Customer</a>
                    </li>
                    <li class="nav-item" style="margin-right: 100px;">
                        <a class="nav-link" aria-current="page" id="searchLink" href="admin/admincustomerorder.php">Order History/Details</a>
                    </li>
                    <li class="nav-item">
                        <div class="d-flex align-items-center ms-auto me-4">
                            <a>
                                <button type="button" onclick="confirmLogout()" class="btn  me-3" style="border-radius: 10px; background-color: #9A4444; color:white">
                                    Log-Out <i class="bi bi-box-arrow-in-right"></i>
                                </button>
                            </a>
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
                                            window.location.href = "../logout.php"
                                        }
                                    });
                                }
                            </script>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>