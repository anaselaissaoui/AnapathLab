<?php

session_start();
require '../../database/dataBase.php';

$queryMajor = "SELECT * FROM major WHERE maj_id = {$_SESSION['maj_id']}";

$queryProducts = "SELECT * FROM product WHERE pro_availa='En Rupture'";
$contentTable = $conn->prepare($queryProducts);
$contentTable->execute();
$resultTable = $contentTable->fetchAll();

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/f06fa41670.js" crossorigin="anonymous"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../assets/tablogo.png" type="image/x-icon">
    <!-- <link href="./bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="./style.css">
    <title>Major-Dashboard</title>
</head>

<body>
    <div class="modal-open">
        <div class="modal fade show" id="exampleModalCenter" tabindex="-3" role="dialog" aria-labelledby="exampleModalCenterTitle" style="display: hidden;" aria-modal="true">
        </div>
    </div>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
            <nav class="navbar bg-light navbar-light">
                <a href="index.html" class="navbar-brand mx-4 mb-3">
                    <h3 class="text-prim"><i class="bi bi-hash me-2"></i>MajorDash</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle bg-white" src="../../assets/majorUser.png" alt="" style="width: 45px; height: 45px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['maj_name'] ?></h6>
                        <span>Major</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                <div class="nav-item dropdown">
                        <a href="./dispoProducts.php" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./dispoProducts.php" class="dropdown-item">Disponible</a>
                            <a href="./bEnRupProducts.php" class="dropdown-item">Bientôt En Rupture</a>
                            <a href="./enRupProducts.php" class="dropdown-item active">En Rupture</a>
                        </div>
                    </div>
                    <a href="./products.php" class="nav-link nav-item"><i class="bi bi-archive-fill me-2"></i>Produits</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <!-- Content Start -->
        <div class="content">
            <!-- Navbar Start -->
            <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                    <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0">
                    <i class="bi bi-list fs-3"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notificatin</span>
                        </a>
                        <div class="dropdown-menu  text-white bg-secondary dropdown-menu-end  border-0 rounded-0 rounded-bottom m-0">
                            <a href="#" class="dropdown-item text-white ">
                                <h6 class="fw-normal mb-0">Profile updated</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-white">
                                <h6 class="fw-normal mb-0">New user added</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-white">
                                <h6 class="fw-normal mb-0">Password changed</h6>
                                <small>15 minutes ago</small>
                            </a>
                            <hr class="dropdown-divider">
                            <a href="#" class="dropdown-item text-white text-center">See all notifications</a>
                        </div>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2 bg-white" src="../../assets/majorUser.png" alt="" style="width: 45px; height: 45px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['maj_name'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="../signOut/signOut.php" class="dropdown-item  text-white bg-secondary">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <!-- Recent Sales Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light  rounded p-4">
                    <div class="d-block align-items-center justify-content-between mb-4">
                        <h4 class="me-2 ">Products En Stock</h4>
                        <div class="d-xxl-flex align-items-center justify-content-between mb-4 d-lg-inline justify-content-start d-sm-flex">
                            <form class="d-md-flex mw-100 pe-5">
                                <input class="form-control border-0" id="search" type="search" placeholder="Search">
                            </form>
                            <div class="">
                                <div class="bg-light rounded d-flex align-items-baseline ">
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="btnradio" value="Tous" id="Tous" autocomplete="off" checked="">
                                        <label class="btn btn-outline-primary" for="Tous">Tous</label>

                                        <input type="radio" class="btn-check" name="btnradio" value="Chimique" id="Chimique" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="Chimique">Chimique</label>

                                        <input type="radio" class="btn-check" name="btnradio" value="Fongible" id="Fongible" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="Fongible">Fongible</label>

                                        <input type="radio" class="btn-check" name="btnradio" value="Immuno" id="Immuno" autocomplete="off">
                                        <label class="btn btn-outline-primary" for="Immuno">Immuno</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table text-start align-middle table-bordered table-hover mb-0">
                            <thead>
                                <tr class="text-dark text-center" style="vertical-align: middle;">
                                    <th scope="col">Produit</th>
                                    <th scope="col">Quantite</th>
                                    <th scope="col" style="width: 120px;">Date</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Condition de conservation</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableResult" style="color:red;">
                                <?php include "./tableProducts.php" ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Recent Sales End -->


            <!-- Content End -->
        </div>


        <!-- JavaScript -->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="./main.js"></script>

        <script>
            $(document).ready(function() {
                $('input[type=radio][name=btnradio]').change(function() {
                    var filterValue = $(this).val(); // get the value of the selected radio button
                    var searchValue = $('#search').val(); // get the value of the search input
                    var disSituation = "En Rupture";
                    $.ajax({
                        type: 'POST',
                        url: 'search.php',
                        data: {
                            filter: filterValue,
                            search: searchValue,
                            dispoSituation:disSituation
                        }, // send both the selected radio button value and search input value to the PHP script
                        success: function(response) {
                            // display the filtered results returned from the PHP script
                            $('#tableResult').html(response);
                        }
                    });
                });

                $('#search').keyup(function() {
                    var search = $(this).val();
                    var filterValue = $('input[type=radio][name=btnradio]:checked')
                        .val(); // get the value of the checked radio button
                        var disSituation = "En Rupture";
                    $.ajax({
                        type: 'POST',
                        url: 'search.php',
                        data: {
                            search: search,
                            dispoSituation:disSituation,
                            filter: filterValue // send both the search input value and checked radio button value to the PHP script
                        },
                        success: function(response) {
                            $('#tableResult').html(response);
                        }
                    });
                });



                $('a[data-pro-id]').click(function(event) {
                    event.preventDefault(); // Prevent the default behavior of the <a> element

                    var proId = $(this).data('pro-id');

                    $.ajax({
                        url: 'details.php',
                        type: 'POST',
                        data: {
                            pro_id: proId
                        },
                        success: function(response) {
                            console.log('done');
                            $('#exampleModalCenter').html(response);
                            $('#exampleModalCenter').modal('show');
                        },
                        error: function() {
                            alert('Error fetching product data');
                        }
                    });
                });

            });

            $(document).on('click', '.edit-button', function(e) {
                    e.preventDefault();

                    // Get the pro_id from the button
                    var proId = $(this).attr('id');

                    // Make an AJAX request to retrieve the modal content from editProduct.php
                    $.ajax({
                    url: './editProduct.php',
                    type: 'GET',
                    data: { id: proId },
                    success: function(response) {
                        // Display the modal content in the placeholder element
                        $('#exampleModalCenter').html(response);

                        // Show the modal
                        $('#exampleModalCenter').modal('show');
                    },
                    error: function(xhr, status, error) {
                        // Handle error if the AJAX request fails
                        console.log(error);
                    }
                    });
                });

                $(document).on('click', '.editBtn', function(e) {
    e.preventDefault();

    // Get the pro_id from the button
    var proId = $(this).attr('id');

    // Get the form values
    var name = $('#name').val();
    var unit = $('#unit').val();
    var condition = $('#condition').val();
    var technics = $('#technics').val();

    // Make an AJAX request to confirmEdit.php
    $.ajax({
        url: './confirmEdit.php',
        type: 'POST',
        data: {
            pro_id: proId,
            name: name,
            unit: unit,
            condition: condition,
            technics: technics
        },
        success: function(response) {
            // Handle the success response if needed
            console.log(response);
            // Reload or update the table if required
            window.location.href = "./majorDashboard.php"; // Redirect to majorDashboard.php
        },
        error: function(xhr, status, error) {
            // Handle error if the AJAX request fails
            console.log(error);
        }
    });
});

        </script>
</body>


</html>

<style>

.sidebar .navbar .dropdown-item {
    font-weight: 600;
    padding-left: 38px;
    width: 95%;
    border-radius: 0 30px 30px 0;}
    .sidebar .navbar .dropdown-item:not(.active):hover {
    background-color:lavender;
}

</style>