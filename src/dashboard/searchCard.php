<?php
require '../../database/dataBase.php';

// Retrieve search query from AJAX request
$search = $_POST['search'];

// Retrieve filter option from AJAX request
$filter = $_POST['filter'];



// Set default filter value
$pro_type = '';

// Update filter value based on selected option
if ($filter === 'Tous') {
    $pro_type = 'Tous';
} elseif ($filter === 'Chimique') {
    $pro_type = 'Chimique';
} elseif ($filter === 'Fongible') {
    $pro_type = 'Fongible';
}elseif ($filter === 'Immuno') {
    $pro_type = 'Immuno';
}

// Prepare SQL query with filter


if ($pro_type!== "Tous") {
    $sql = "SELECT * FROM product WHERE  pro_name LIKE :search AND pro_type = :pro_type";
} else {
    $sql = "SELECT * FROM product WHERE  pro_name LIKE :search";
}

$stmt = $conn->prepare($sql);

// Bind search query parameter
// Bind search query parameter
$stmt->bindValue(':search', '%' . $search . '%');

// Bind filter parameter if present
if ($pro_type !== "Tous") {
    $stmt->bindParam(':pro_type', $pro_type);
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($products) > 0) {
    foreach ($products as $row) {
        // output the card for each work
        echo '
        <div class="cardProduct">
            <div class="main">
              <img class="productImage" src="'.$row['pro_img'].'" alt="'.$row['pro_name'].'" />
              <h5 class="text-white">'.$row['pro_name'].', '.$row['pro_unit'].'</h5 class="text-white">
              <p class="techniques">Techniques : '.$row['pro_techn'].'</p>
              <div class="productInfo">
                <div class="productType">
                  <ins>◘</ins>
                  <p>'.$row['pro_type'].'</p>
                </div>
                <div class="dateExp">
                  <ins>◷</ins>
                  <p>'.$row['pro_date_exp'].'</p>
                </div>
              </div>
            </div>
          </div>';}
        
                } else{
                    echo "<tr><td colspan='6'><h2 class='text-center mx-auto' style='color:red;'>Pas des Produits</h2></td></tr>";

                }
?>
