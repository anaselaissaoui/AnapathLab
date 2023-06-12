<?php
session_start();
require '../../database/dataBase.php';
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$pro_id = $_GET['id'];
$maj_id = $_SESSION['maj_id'];

$queryEditProd = "SELECT * FROM product WHERE pro_id = '$pro_id'";
$editProd = $conn->prepare($queryEditProd);
$editProd->execute();
$resultEdit = $editProd->fetchAll();

foreach ($resultEdit as $row) {
    if ($row['pro_id'] == $pro_id) {
        $Name = $row['pro_name'];
        $Unit = $row['pro_unit'];
        $Condition = $row["pro_condition"];
        $Technics = $row['pro_techn'];
        $selectedTechnics = explode(', ', $Technics);
    }
}

$html = '
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content rounded-4">
        <div class="modal-body py-0 px-6">
            <div class="content-text p-4 px-5 align-item-stretch">
                <form method="POST" class="edit-form" enctype="multipart/form-data">
                    <div class="text-center mb-5">
                        <h2 class="heading-section">Modifier Le Produit</h2>
                    </div>
                    <!-- name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Nom:</label>
                        <input type="text" id="name" class="form-control" placeholder="" name="name" value="' . $Name . '">
                    </div>
                    <!-- Unit -->
                    <div class="form-group">
                        <label for="unit" class="form-label">Unit:</label>
                        <input type="text" id="unit" name="unit" class="form-control" placeholder="unit" value="' . $Unit . '">
                    </div>
                    <!-- Condition de Conservation -->
                    <div class="form-group">
                        <label for="condition" class="form-label">Condition de Conservation:</label>
                        <select id="condition" name="condition" class="form-control form-select py-3">
                            <option value="' . $Condition . '">Condition Actuelle: ' . $Condition . '</option>
                            <option value="+15 à +25°C">+15 à +25°C</option>
                            <option value="+4°C">+4°C</option>
                        </select>
                    </div>
                    <!-- techniques -->
                    <div class="form-group">
                        <label for="technics" class="form-label">Techniques:</label>
                        <div class="checkbox-group" id="technics">
                            <ul class="checkbox-list list-unstyled">
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Macroscopie" ' . (in_array("Macroscopie", $selectedTechnics) ? "checked" : "") . '>Macroscopie</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Microtomie" ' . (in_array("Microtomie", $selectedTechnics) ? "checked" : "") . '>Microtomie</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Colorations HE" ' . (in_array("Colorations HE", $selectedTechnics) ? "checked" : "") . '>Colorations HE</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Colorations spéciales" ' . (in_array("Colorations spéciales", $selectedTechnics) ? "checked" : "") . '>Colorations spéciales</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Immunohistochimie" ' . (in_array("Immunohistochimie", $selectedTechnics) ? "checked" : "") . '>Immunohistochimie</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Enrobage" ' . (in_array("Enrobage", $selectedTechnics) ? "checked" : "") . '>Enrobage</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Immunofluorescence" ' . (in_array("Immunofluorescence", $selectedTechnics) ? "checked" : "") . '>Immunofluorescence</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-around">
                        <button name="Cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Annuler</button>
                        <button id="'.$row['pro_id'].'" name="submit" class="form-control btn editBtn btn-primary confirm w-25">Modifier Le Produit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .form-group {
        margin-bottom: 16px;
    }

    .form-label {
        margin: 0;
    }

    .btn:hover {
        box-shadow: inset 0 0 0 10rem gray;
    }
</style>';

echo $html;
?>

