<?php
require '../../database/dataBase.php';

try {
    // Start a transaction
    $conn->beginTransaction();

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

    // Commit the transaction
    $conn->commit();

    // Perform other actions after the updates (if any)

} catch (PDOException $e) {
    // Rollback the transaction on error
    $conn->rollback();
    echo "Error: " . $e->getMessage();
}
?>
