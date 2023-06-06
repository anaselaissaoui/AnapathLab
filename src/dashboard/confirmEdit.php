<?php
session_start();
require '../../database/dataBase.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pro_id = $_POST['pro_id'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $quantity = $_POST['quantity'];
    $date = $_POST['date'];
    $type = $_POST['type'];
    $condition = $_POST['condition'];
    $technics = $_POST['technics'];

    if (empty($name) || empty($unit) || empty($quantity) || empty($date) || empty($type) || empty($condition) || empty($technics)) {
        echo '**please enter all the values ....';
    } else {
        $stmt = $conn->prepare("UPDATE product SET pro_name=:pro_name, pro_unit=:pro_unit, pro_quant=:pro_quant, pro_date_modif=:pro_date_modif, pro_type=:pro_type, pro_condition=:pro_condition, pro_techn=:pro_techn WHERE pro_id=:pro_id");
        $stmt->bindParam(':pro_id', $pro_id);
        $stmt->bindParam(':pro_name', $name);
        $stmt->bindParam(':pro_unit', $unit);
        $stmt->bindParam(':pro_quant', $quantity);
        $stmt->bindParam(':pro_date_modif', $date);
        $stmt->bindParam(':pro_type', $type);
        $stmt->bindParam(':pro_condition', $condition);
        $stmt->bindParam(':pro_techn', $technics);
        $stmt->execute();

        // No need for header("location: ./majorDashboard.php");
        // The success function in the AJAX request will handle the redirection
        exit();
    }
} elseif (isset($_POST['Cancel'])) {
    header("location: ./majorDashboard.php");
    exit();
}


?>
