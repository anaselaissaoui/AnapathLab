<?php
require '../../database/dataBase.php';

$search = $_POST['search'];

$sql = "SELECT * FROM supplier WHERE sup_name LIKE :search";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($suppliers) > 0) {
    foreach ($suppliers as $supplier) {
        echo '<tr class="text-center text-secondary">
                        <td>'.$supplier['sup_name'].'</td>
                        <td>'.$supplier['sup_email'].'</td>
                        <td>'.$supplier['sup_phone'].'</td>
                        
                    </tr>';
    }
} else {
    echo "<tr><td colspan='3'><h2 class='text-center mx-auto' style='color:red;'>Aucune commande trouvée</h2></td></tr>";
}
?>
