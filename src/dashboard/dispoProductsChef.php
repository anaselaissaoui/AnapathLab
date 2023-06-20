<?php

session_start();
require '../../database/dataBase.php';

$queryMajor = "SELECT * FROM chef_de_service WHERE chef_id = {$_SESSION['chef_id']}";

$queryProducts = "SELECT * FROM product WHERE pro_availa='Disponible'";
$contentTable = $conn->prepare($queryProducts);
$contentTable->execute();
$resultTable = $contentTable->fetchAll();
$queryNotifications = "SELECT * FROM notifications";
$contentNotifications = $conn->prepare($queryNotifications);
$contentNotifications->execute();
$resultNotifications = $contentNotifications->fetchAll();
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
    <title>Chef - Tableau De Bord</title>
</head>

<body>
    <?php
    // Check if the user is logged in
    if (!isset($_SESSION['chef_name'])) {
        // Redirect the user to the login page
        header("Location: ../../index.html");
        exit;
    }
    ?>
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
                        <img class="rounded-circle bg-white" src="../../assets/chefUser.png" alt="" style="width: 45px; height: 45px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0"><?php echo $_SESSION['chef_name'] ?></h6>
                        <span>Major</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <div class="nav-item dropdown">
                        <a href="./dispoProductsChef.php" class="nav-link dropdown-toggle active" data-bs-toggle="dropdown"><i class="bi bi-speedometer2 me-2"></i>Tableau De Bord</a>
                        <div class="dropdown-menu bg-transparent border-0">
                            <a href="./dispoProductsChef.php" class="dropdown-item active">Disponible</a>
                            <a href="./bEnRupProductsChef.php" class="dropdown-item">Bientôt En Rupture</a>
                            <a href="./enRupProductsChef.php" class="dropdown-item">En Rupture</a>
                        </div>
                    </div>
                    <a href="./productsChef.php" class="nav-link nav-item"><i class="bi bi-archive-fill me-2"></i>Produits</a>
                    <a href="./suppliers.php" class="nav-link nav-item"><i class="bi bi-truck me-2"></i>Fournisseurs</a>
                    <a href="./orders.php" class="nav-link nav-item"><i class="bi bi-file-earmark-check-fill me-2"></i></i>Commandes</a>
                    <a href="./history.php" class="nav-link nav-item"><i class="bi bi-calendar2-week me-2"></i></i>Activités</a>
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
                            <?php $notificationCount = count($resultNotifications); ?>
                            <?php if ($notificationCount > 0) : ?>
                                <span class="position-absolute top-25 start-0 badge rounded-pill bg-danger"><?php echo $notificationCount; ?></span>
                            <?php endif; ?>
                            <i class="fa fa-bell me-lg-2"></i>
                            <span class="d-none d-lg-inline-flex">Notification</span>
                        </a>
                        <div class="dropdown-menu border border-left-0 border-right-0 border-bottom-0 rounded-0 rounded-bottom bg-secondary-emphasis dropdown-menu-end m-0">
                            <?php $reversedNotifications = array_reverse($resultNotifications); ?>
                            <?php $limitedNotifications = array_slice($reversedNotifications, 0, 8); ?>
                            <?php foreach ($limitedNotifications as $notification) : ?>
                                <a href="#" class="dropdown-item text-white d-flex justify-content-between align-items-center">
                                    <?php $statusClass = ($notification['new_status'] == 'Bientôt En Rupture') ? 'text-warning' : 'text-danger'; ?>
                                    <h6 style="font-size: 12px;" class="fw-bold mb-0 me-2 <?php echo $statusClass; ?>">
                                        <?php echo $notification['product_name']; ?> is <?php echo $notification['new_status']; ?>
                                    </h6>
                                    <small style="font-size: 8px;" class="fw-bold <?php echo $statusClass; ?>"><?php echo $notification['created_at']; ?></small>
                                </a>
                                <hr class="dropdown-divider">
                            <?php endforeach; ?>
                            <?php if ($notificationCount > 8) : ?>
                            <?php endif; ?>
                            <a href="#" class="dropdown-item text-center">Toutes Les Notifications</a>
                        </div>
                    </div>

                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <img class="rounded-circle me-lg-2 bg-white" src="../../assets/chefUser.png" alt="" style="width: 45px; height: 45px;">
                            <span class="d-none d-lg-inline-flex"><?php echo $_SESSION['chef_name'] ?></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                            <a href="../signOut/signOut.php" class="dropdown-item  text-white bg-secondary">Se Déconnecter</a>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- Navbar End -->

            <div class="container-fluid pt-4 px-4">

                <!--  Tableau des Produits Start -->
                <div class="bg-light  rounded p-4">
                    <div class="d-block align-items-center justify-content-between mb-4">
                        <h4 class="me-2 ">Produits En Stock</h4>
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
                                    <th scope="col">Quantité</th>
                                    <th scope="col" style="width: 120px;">Date</th>
                                    <th scope="col">Type</th>
                                    <th scope="col">Condition de conservation</th>
                                    <th scope="col" style="width: 200px;">Action</th>
                                </tr>
                            </thead>
                            <tbody id="tableResult" style="color:green;">
                                <?php include "./tableProductsChef.php" ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!--  Tableau des Produits Start -->


            <!-- Content End -->
        </div>


        <!-- JavaScript -->

        <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
        <script src="./main.js"></script>

        <script>
            $(document).ready(function() {


                /*Function to send both the selected radio button value and search input value to the PHP script with the change of radioButton*/
                $('input[type=radio][name=btnradio]').change(function() {
                    var filterValue = $(this).val();
                    var searchValue = $('#search').val();
                    var disSituation = "Disponible";
                    $.ajax({
                        type: 'POST',
                        url: 'searchChef.php',
                        data: {
                            filter: filterValue,
                            search: searchValue,
                            dispoSituation: disSituation
                        },
                        success: function(response) {

                            $('#tableResult').html(response);
                        }
                    });
                });

                /*Function to send both the selected radio button value and search input value to the PHP script with the keyup of search*/

                $('#search').keyup(function() {
                    var search = $(this).val();
                    var filterValue = $('input[type=radio][name=btnradio]:checked').val();
                    var disSituation = "Disponible";
                    $.ajax({
                        type: 'POST',
                        url: 'searchChef.php',
                        data: {
                            search: search,
                            dispoSituation: disSituation,
                            filter: filterValue
                        },
                        success: function(response) {
                            $('#tableResult').html(response);
                        }
                    });
                });


                $('a[data-pro-id]').click(function(event) {
                    event.preventDefault();

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


        </script>
</body>


</html>

<style>
    .btn-grad,
    .btn-grad1 {
        margin: 10px;
        padding: 25px 45px;
        text-align: center;
        text-transform: uppercase;
        transition: 0.5s;
        background-size: 200% auto;
        color: white;
        box-shadow: 0 0 20px #eee;
        border-radius: 10px;
        display: block;
    }

    .btn-grad {
        background-image: linear-gradient(to right, #1A2980 0%, #26D0CE 51%, #1A2980 100%);
    }

    .btn-grad1 {
        background-image: linear-gradient(to right, #556270 0%, #FF6B6B 51%, #556270 100%);
    }
    .btn-outline-primary{
    font-size:0.8rem;
    font-weight: 600;
}
    .btn-grad:hover,
    .btn-grad1:hover {
        background-position: right center;
        color: #fff;
        text-decoration: none;
    }



    .sidebar .navbar .dropdown-item {
        font-weight: 600;
        padding-left: 38px;
        width: 95%;
        border-radius: 0 30px 30px 0;
    }

    .sidebar .navbar .dropdown-item:not(.active):hover {
        background-color: lavender;
    }
</style>