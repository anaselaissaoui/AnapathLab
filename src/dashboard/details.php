<?php
require '../../database/dataBase.php';
$proId = $_POST['pro_id'];
echo "1";


$stmt = $conn->prepare('SELECT * FROM product WHERE pro_id = :pro_id');
$stmt->bindParam(':pro_id', $proId);
$stmt->execute();
echo "2";
$row = $stmt->fetch(PDO::FETCH_ASSOC);

$html = '
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-body py-0">
        <div class="d-flex justify-content-evenly align-items-center">
          <div class="content-text p-4 px-5 align-item-stretch">
            <div class="text-center">
              <h3 class="mb-3 text-primary line">'.$row['pro_name'].'</h3>
              <p class="mb-5 fw-semibold">'.$row['pro_type'].'</p>
              <p class="mb-5 fw-semibold">'.$row['pro_date_modif'].'</p>
              <p class="mb-5 fw-bold">'.$row['pro_condition'].'</p>
            </div>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>'
;

echo $html;
?>