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
  $sql = "SELECT * FROM product WHERE pro_name LIKE ? AND pro_type = ?";
}else{
  $sql = "SELECT * FROM product WHERE pro_name LIKE ?";
}

$stmt = $conn->prepare($sql);

// Bind search query parameter
$stmt->bindValue(1, '%'.$search.'%');

// Bind filter parameter if present
if ($pro_type!== "Tous") {
    $stmt->bindValue(2, $pro_type);
}

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($products) > 0) {
    foreach ($products as $row) {
        // output the card for each work
        echo '<tr class=" fw-normal text-center">
        <td>'.$row['pro_name'].'</td>
        <td>'.$row['pro_quant'].'</td>
        <td>'.$row['pro_date_modif'].'</td>
        <td>'.$row['pro_type'].'</td>
        <td>'.$row['pro_condition'].'</td>
        <td  class="text-center"><a class="btn btn-sm btn-prim" href="">Details</a><a class="btn btn-sm btn-primary ms-1" href="">Modifier</a></td>
    </tr>';
    }
} else {
  echo "<tr><td colspan='6'><h2 class='text-center text-danger mx-auto'>No Results Found</h2></td></tr>";
}
?>
