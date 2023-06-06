<?php 

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

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
            $Quantity = $row['pro_quant'];
            $Date = $row['pro_date_modif'];
            $Type = $row['pro_type'];
            $Condition = $row["pro_condition"];
            $Technics = $row['pro_techn'];
        }
    }


    $html = '<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content rounded-0">
      <div class="modal-body py-0">
        <div class="d-flex justify-content-evenly align-items-center">
          <div class="content-text p-4 px-5 align-item-stretch">
          <form method="POST" class="edit-form" enctype="multipart/form-data">
          <div class="col-md-6 text-center mb-5">
              <h2 class="heading-section">Edit Product</h2>
          </div>
          <!-- name -->
          <div class="form-group">
              <input type="text" id="name" class="form-control" placeholder="" name="name" value="'.$Name.'">
          </div>
          <!-- Unit -->
          <div class="form-group">
              <input type="text" id="unit" name="unit" class="form-control" placeholder="unit" value="'. $Unit.'">
          </div>
          <!-- Quantity -->
          <div class="form-group">
              <input type="number" id="quantity" name="quantity" class="form-control" placeholder="quantity" value="'. $Quantity.'">
          </div>

          <!-- date -->
          <div class="form-group">
              <input type="date" id="date" name="date" class="form-control" placeholder="Offer date" value="'. $Date.'">
          </div>

          <!-- Type -->
          <div class="form-group">
              <select id="type" name="type" class="form-control form-select border-0 py-3">
                  <option value="'. $Type.'">Current Type : '. $Type.' </option>
                  <option value="Chimique">Chimique</option>
                  <option value="Fongible">Fongible</option>
                  <option value="Immuno">Immuno</option>
              </select>
          </div>

          <!-- Condition de Conservation -->
          <div class="form-group">
              <select id="condition" name="condition" class="form-control form-select border-0 py-3">
                  <option value="'. $Condition.'">Current Condition : '. $Condition.' </option>
                  <option value="+15 à +25°C">+15 à +25°C</option>
                  <option value="+4°C">+4°C</option>
              </select>
          </div>
          
          <!-- techniques -->
          <div class="form-group">
              <select id="technics" name="technics" class="form-control form-select border-0 py-3">
                  <option value="'. $Technics.'">Current Techniques : '. $Technics.' </option>
                  <option value="tech1">tech1</option>
                  <option value="tech2">tech2</option>
              </select>
          </div>
          
          <div class="form-group">
              <button name="submit" id="'.$pro_id.'" class="form-control btn btn-success submit editBtn px-3">Edit Product</button>
              <button name="Cancel" class="form-control btn btn-success submit px-3">Cancel</button>
          </div>
          
      </form>
          </div>
          </div>
        </div>
      </div>
    </div>
  </div>';

echo $html;

?>
<!-- <style>
 

    form.edit-form {
        background-color: #c5c5c5d6;
        /* height: 31rem; */
        border-radius: 17px;
        text-align: -webkit-center;
    }

    h2.heading-section {
        color: #6c6c6c;
    }

    .form-group {
        display: flex;
        flex-direction: row;
        justify-content: center;
    }


    .dropzone {
        width: 100px;
        height: 100px;
        border: 1px dashed #999;
        border-radius: 3px;
        text-align: center;
        margin: 6px 6px;
    }





    .dropzone.col-md-3 {
        margin: 0px 3px;
        background-color: #f0f0f0;
    }

    .form-group.col-md-12 {
        display: flex;
        flex-direction: revert;
        margin: 29px 7px 13px 11px;
    }

    input.form-control {
        margin: 11px 0px 11px 0px;
        background-color: #ffffffe0;
        padding: 8px 18px;
    }

    select.form-control.form-select.border-0.py-3 {
        margin: 11px 0px 11px 0px;
        background-color: #ffffffe0;
        padding: 8px 18px;
    }
</style> -->