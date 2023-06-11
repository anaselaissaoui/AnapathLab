<?php
require '../../database/dataBase.php';

$prodCount = $_POST['prodCount'];
$prodNCount = $_POST['prodNCount'];


$newSup=$_POST['newSup'];
if ($newSup==0){
    $supName=$_POST['fournisseur1'];
    
}elseif($newSup==1){
    $supName=$_POST['fournisseur'];
    $supEmail=$_POST['emailSup'];
    $supPhone=$_POST['phoneSup'];
    $insertSupQuery = "INSERT INTO supplier (sup_name, sup_email, sup_phone)
                VALUES (:sup_name, :sup_email, :sup_phone)";
                $insertSupStmt = $conn->prepare($insertSupQuery);
                $insertSupStmt->bindValue(':sup_name', $supName);
                $insertSupStmt->bindValue(':sup_email', $supEmail);
                $insertSupStmt->bindValue(':sup_phone', $supPhone);
                $insertSupStmt->execute();
}




$orderDate = date('Y-m-d H:i:s');

// Insert the new order into the 'order_com' table
$insertOrderQuery = "INSERT INTO order_com (ord_date, sup_id)
                     VALUES (:order_date,
                             (SELECT sup_id
                              FROM supplier
                              WHERE sup_name = :sup_name)
                            )";

$insertOrderStmt = $conn->prepare($insertOrderQuery);
$insertOrderStmt->bindValue(':order_date', $orderDate);
$insertOrderStmt->bindValue(':sup_name', $supName);
$insertOrderStmt->execute();


$orderId = $conn->lastInsertId();



for ($i = 1; $i <= $prodCount; $i++) {
    $productName = $_POST['nameP'.$i];
    $quantity = $_POST['quantity'.$i];

    $existingProduct = "SELECT pro_id, pro_quant FROM product WHERE pro_name = :productName";
    $stmt = $conn->prepare($existingProduct);
    $stmt->bindParam(':productName', $productName);
    $stmt->execute();
    $result = $stmt->fetch();

    $newQuantity = $result['pro_quant'] + $quantity;
    $updateQuery = "UPDATE product SET pro_quant = :newQuantity, ord_id = :orderId WHERE pro_name = :productName";
    $updateStmt = $conn->prepare($updateQuery);
    $updateStmt->bindValue(':newQuantity', $newQuantity);
    $updateStmt->bindValue(':productName', $productName);
    $updateStmt->bindValue(':orderId', $orderId);
    $updateStmt->execute();
}

if ($prodNCount > 0) {
    for ($i = 1; $i <= $prodNCount; $i++) {
        $productNewName = $_POST['nameNP' . $i];
        $quantityNew = $_POST['quantityNP' . $i];
        $unit = $_POST['unit' . $i];
        $type = $_POST['type' . $i];
        $condition = $_POST['condition' . $i];
        $dateExp = $_POST['dateExp' . $i];
        $technics = isset($_POST['technics' . $i]) ? $_POST['technics' . $i] : array();

        // Get the product image file
        $productImage = $_FILES['files']['name'][$i - 1];
        $productImageTmp = $_FILES['files']['tmp_name'][$i - 1];

        // Check if a file was uploaded
        if (!empty($productImage)) {
            // Process the uploaded file
            $uploadDirectory = '../../assets/';
            $uploadedFileName = basename($productImage);
            $targetFilePath = $uploadDirectory . $uploadedFileName;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

            // Validate the file type (you can customize the allowed types)
            $allowedFileTypes = array('jpg', 'jpeg', 'png', 'gif');
            if (!in_array($fileType, $allowedFileTypes)) {
                // Handle invalid file type error
                $response = array('status' => 'error', 'message' => 'Invalid file type. Please upload a JPG, JPEG, PNG, or GIF file.');
                echo json_encode($response);
                exit;
            }

            // Move the uploaded file to the target directory
            if (move_uploaded_file($productImageTmp, $targetFilePath)) {
                // Example: Add the product image path to the insert/update query
                $technicsImploded = implode(', ', $technics);

                $insertQuery = "INSERT INTO product (pro_name, pro_unit, pro_quant, pro_type, pro_condition, pro_date_exp, pro_techn, pro_img, pro_availa, maj_id, ord_id)
                VALUES (:productNewName, :unit, :quantityNew, :productType, :productCondition, :expirationDate, :techniques, :image, :pro_availa, :maj_id, :ord_id)";
                $insertStmt = $conn->prepare($insertQuery);
                $insertStmt->bindValue(':productNewName', $productNewName);
                $insertStmt->bindValue(':unit', $unit);
                $insertStmt->bindValue(':quantityNew', $quantityNew);
                $insertStmt->bindValue(':productType', $type);
                $insertStmt->bindValue(':productCondition', $condition);
                $insertStmt->bindValue(':expirationDate', $dateExp);
                $insertStmt->bindValue(':techniques', $technicsImploded);
                $insertStmt->bindValue(':image', $targetFilePath);
                $insertStmt->bindValue(':pro_availa', "Disponible");
                $insertStmt->bindValue(':maj_id', "1");
                $insertStmt->bindValue(':ord_id', $orderId);
                $insertStmt->execute();
            } else {
                // Handle file upload error
                $response = array('status' => 'error', 'message' => 'Failed to upload the product image.');
                echo json_encode($response);
                // exit;
            }
        }
    }
}
exit;
?>
