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
  <div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
    <div class="modal-content rounded-4">
      <div class="modal-body py-0">
        <div class="d-flex row justify-content-center align-items-center">
        <div class="col-6">
        <img src="'.$row['pro_img'].'" width="100%" alt="'.$row['pro_name'].'">
        <h5 class="text-center">'.$row['pro_date_exp'].'</h5>
        </div>
          <div class=" content-text col-6">
            <div class="text-left">
            <div class="d-inline-flex flex-wrap align-items-baseline">
            <h3 class="text-primary me-1">'.$row['pro_name'].',</h3>
            <p class=" fw-semibold me-1">'.$row['pro_type'].',</p>
            <p class=" fw-normal">'.$row['pro_unit'].'</p>
            </div>
            <p class="fw-bold">Techniques : '.$row['pro_techn'].'</p>
              <p class="fw-bold">Condition de Conservation : '.$row['pro_condition'].'</p>
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