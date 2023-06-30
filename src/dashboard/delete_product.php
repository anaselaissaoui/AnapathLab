<?php
require '../../database/dataBase.php';

    $productId = $_POST['productId'];
    echo "console.log(1)";

    // Perform the deletion in the database
    $deleteQuery = "DELETE FROM product WHERE pro_id = :productId";
    $deleteStmt = $conn->prepare($deleteQuery);
    $deleteStmt->bindParam(':productId', $productId);

    if ($deleteStmt->execute()) {
        // Deletion successful
        http_response_code(200);
    } else {
        // Error occurred during deletion
        http_response_code(500);
    }
?>
