<?php
require '../../database/dataBase.php';

$search = $_POST['search'];

$sql = "SELECT order_com.ord_id, supplier.sup_name, order_com.ord_date
        FROM order_com
        INNER JOIN supplier ON order_com.sup_id = supplier.sup_id
        WHERE order_com.ord_date LIKE :search
        OR supplier.sup_name LIKE :search";

$stmt = $conn->prepare($sql);
$stmt->bindValue(':search', '%' . $search . '%');
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

if (count($orders) > 0) {
    foreach ($orders as $order) {
        echo '<tr class="text-center text-secondary">
            <td>'.$order['ord_id'].'</td>
            <td>'.$order['sup_name'].'</td>
            <td>'.$order['ord_date'].'</td>
        </tr>';
    }
} else {
    echo "<tr><td colspan='3'><h2 class='text-center mx-auto' style='color:red;'>Aucune commande trouvée</h2></td></tr>";
}
?>
