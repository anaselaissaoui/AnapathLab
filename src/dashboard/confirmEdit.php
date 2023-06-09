<?php
session_start();
require '../../database/dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pro_id = $_POST['pro_id'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
   
    $condition = $_POST['condition'];
    $technics = $_POST['technics'];

    if (empty($name) || empty($unit) || empty($condition) || empty($technics)) {
        echo '**please enter all the values ....';
    } else {
        $stmt = $conn->prepare("UPDATE product SET pro_name=:pro_name, pro_unit=:pro_unit, pro_condition=:pro_condition, pro_techn=:pro_techn WHERE pro_id=:pro_id");
        $stmt->bindParam(':pro_id', $pro_id);
        $stmt->bindParam(':pro_name', $name);
        $stmt->bindParam(':pro_unit', $unit);
        $stmt->bindParam(':pro_condition', $condition);
        $stmt->bindParam(':pro_techn', $technics);
        $stmt->execute();

        // No need for header("location: ./majorDashboard.php");
        // The success function in the AJAX request will handle the redirection
        exit();
    }
} elseif (isset($_POST['Cancel'])) {
    header("location: ./dispoProducts.php");
    exit();
}


?>
