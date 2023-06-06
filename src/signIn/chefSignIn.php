<?php
session_start();
require '../../database/dataBase.php';

$error = "";

if (isset($_POST['submit'])) {
    $Email = $_POST['email'];
    $Password = $_POST['password'];
    $Pass = md5($Password);

    // Check if the input is in email format
    if (empty($Email) || !filter_var($Email, FILTER_VALIDATE_EMAIL)) {
        $error = "*Your Email is required, try again.";
    } else if (empty($Password)) {
        $error = "*Password is required.";
    } else {
        $stmt = $conn->prepare("SELECT * FROM chef_de_service WHERE chef_email=:email AND chef_mdp=:password");
        $stmt->bindParam(':email', $Email);
        $stmt->bindParam(':password', $Password);
        $stmt->execute();
        $rowCount = $stmt->rowCount();
        if ($rowCount === 1) {
            $row = $stmt->fetch();

            if ($row['chef_email'] === $Email && $Password === $row['chef_mdp']) {
                $_SESSION['chef_name'] = $row['chef_name'];
                $_SESSION['chef_id'] = $row['chef_id'];
                header("Location: ../dashboard/majorDashboard.php");
            }
        } else {
            $error = "*The Email or the Password is incorrect, try again.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,500&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="shortcut icon" href="../../assets/tablogo.png" type="image/x-icon">
    <title>ANAPATHLAB</title>
</head>

<body style="padding-top: 50px;">
    <div class="container bg-light rounded-4 py-2">

        <div class=" d-flex flex-column align-items-center">
            <img class="mx-auto d-block" src="../../assets/Logo.png" alt="" style="max-width: 40%; max-height: 100%; ">
            <div class="d-md-flex d-inline align-items-center my-5">
                <div class="bg-light mt-2 rounded d-flex align-items-center justify-content-center">

                    <div class="col-lg-9 p-4 signinCard">
                        <div class="wow fadeInUp" data-wow-delay="0.2s" style="visibility: visible; animation-delay: 0.2s; animation-name: fadeInUp;">
                            <h2 class="mb-5 text-white text-center text-uppercase" id="signIn">Hello M.Chraibi</h2>
                            <form action="" method="POST" class="loginForm">
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="email" class="form-control" name="email" placeholder="Email">
                                            <label for="email">Email</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-floating">
                                            <input type="password" class="form-control" name="password" placeholder="Password">
                                            <label for="password">Password</label>
                                        </div>
                                    </div>

                                    <div class="col-12 text-center">
                                        <button class="btn fs-4 fw-bold w-75 py-3" name="submit" type="submit">Sign In</button>
                                        <div class="error text-danger text-center"><?php echo $error; ?></div>

                                    </div>

                                </div>

                              
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <footer>
        <p class="text-center text-secondary fw-medium my-2">ANAPATHLAB © 2023</p>
    </footer>

    <script defer>
    </script>

</body>
<style>
    * {
        font-family: 'Montserrat', sans-serif;
    }

    button[name="submit"] {
        background-color: #56c4cf;
        color: white;
    }

    button[name="submit"]:hover {
        background-color: #0686c9;
        color: white;
    }

    .error{
      
        font-size: smaller;
        
    }
    .signinCard {
        background: rgba(86, 196, 207, 0.5);
        border-radius: 16px;
        box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        backdrop-filter: blur(19.2px);
        -webkit-backdrop-filter: blur(19.2px);
        border: 1px solid rgba(86, 196, 207, 0.3);
    }
</style>

</html>