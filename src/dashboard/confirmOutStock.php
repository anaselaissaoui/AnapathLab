<?php
require '../../database/dataBase.php';


  // Collect the data from the form
  $names = $_POST['name'];
  $quantities = $_POST['quantity'];

  // Loop through the collected data
  foreach ($names as $index => $name) {
    $quantity = $quantities[$index];

    // Update the products table
    $updateQuery = "UPDATE product SET pro_quant = pro_quant - :quantity WHERE pro_name = :name";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindParam(':quantity', $quantity);
    $updateStmt->bindParam(':name', $name);
    $updateStmt->execute();
  }

?>