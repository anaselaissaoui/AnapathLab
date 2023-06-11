<?php 
session_start();
require '../../database/dataBase.php';

$pro_id = $_GET['id'];
$maj_id = $_SESSION['maj_id'];


$queryEditProd = "SELECT * FROM product WHERE pro_id = '$pro_id'";
$editProd = $conn -> prepare($queryEditProd);
$editProd ->execute();
$resultEdit = $editProd ->fetchAll();

    foreach ($resultEdit as $row) {
        if ($row['pro_id'] == $pro_id) {
            $Name = $row['pro_name'];
            $Unit = $row['pro_unit'];
    
            $Condition = $row["pro_condition"];
            $Technics = $row['pro_techn'];
        }
    }


    $html = '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content rounded-4">
      <div class="modal-body py-0 px-6">

          <div class="content-text p-4 px-5 align-item-stretch">
          <form method="POST" class="edit-form" enctype="multipart/form-data">
          <div class=" text-center mb-5">
              <h2 class="heading-section">Modifier Le Produit</h2>
          </div>
          <!-- name -->
          <div class="form-group">
          <label for="name" class="form-label">Nom:</label>
              <input type="text" id="name" class="form-control" placeholder="" name="name" value="'.$Name.'">
          </div>
          <!-- Unit -->
          <div class="form-group">
          <label for="unit" class="form-label">Unit:</label>
              <input type="text" id="unit" name="unit" class="form-control" placeholder="unit" value="'. $Unit.'">
          </div>
          <!-- Condition de Conservation -->
          <div class="form-group">
          <label for="condition" class="form-label">Condition de Conservation:</label>
              <select id="condition" name="condition" class="form-control form-select  py-3">
                  <option value="'. $Condition.'">Condition Actuelle: '. $Condition.' </option>
                  <option value="+15 à +25°C">+15 à +25°C</option>
                  <option value="+4°C">+4°C</option>
              </select>
          </div>
          
          <!-- techniques -->
          <div class="form-group">
          <label for="technics" class="form-label">Techniques:</label>
              <select id="technics" name="technics" class="form-control form-select py-3">
                  <option value="'. $Technics.'">Techniques Actuelles: '. $Technics.' </option>
                  <option value="tech1">tech1</option>
                  <option value="tech2">tech2</option>
              </select>
          </div>
          
          <div class="form-group d-flex justify-content-around">
          <button name="Cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Annuler</button>
              <button name="submit" id="'.$pro_id.'" class="form-control btn editBtn btn-primary confirm w-25 ">Modifer Le Product</button>
          </div>
          
      </form>
          </div>

        </div>
      </div>
    </div>
  </div>';

echo $html;

?>
<style>
 .form-group{
    margin-bottom: 16px;
 }
 .form-label{
    margin: 0;
 }

 .btn:hover {
  box-shadow: inset 0 0 0 10rem gray;
}
</style>