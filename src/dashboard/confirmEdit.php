<?php
session_start();
require '../../database/dataBase.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $pro_id = $_POST['pro_id'];
    $name = $_POST['name'];
    $unit = $_POST['unit'];
    $condition = $_POST['condition'];
    $technics = $_POST['technics'];

    try {
        $stmt = $conn->prepare("UPDATE product SET pro_name=:pro_name, pro_unit=:pro_unit, pro_condition=:pro_condition, pro_techn=:pro_techn WHERE pro_id=:pro_id");
        $stmt->bindParam(':pro_id', $pro_id);
        $stmt->bindParam(':pro_name', $name);
        $stmt->bindParam(':pro_unit', $unit);
        $stmt->bindParam(':pro_condition', $condition);
        $stmt->bindParam(':pro_techn', $technics);
        
        if ($stmt->execute()) {
            echo "Update successful";
        } else {
            echo "Update failed";
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
    exit();
} elseif (isset($_POST['Cancel'])) {
    header('Location: ./dispoProducts.php');
    exit();
}

    


?>
