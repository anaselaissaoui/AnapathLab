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
        $Picture = $row['pro_img'];
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
                        <h2 class="heading-section">Edit Product</h2>
                    </div>
                    <div class="form-group">
                        <div class="mb-4 d-flex justify-content-center">
                            <img src="' . $Picture . '" alt="example placeholder" style="width: 300px;border: 2px solid #3B71CA;" name="image" id="preview-image" />
                        </div>
                        <div class="d-flex justify-content-center">
                            <div class="btn btn-primary btn-rounded">
                                <label class="form-label text-white  m-1" for="image">Choose file</label>
                                <input type="file" class="form-control d-none" id="image" name="image" onchange="previewImage();" accept="image/*" />
                            </div>
                        </div>
                    </div>
                
                    <!-- Name -->
                    <div class="form-group">
                        <label for="name" class="form-label">Name:</label>
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
                            <option value="' . $Condition . '">Current Condition: ' . $Condition . '</option>
                            <option value="+15 à +25°C">+15 à +25°C</option>
                            <option value="+4°C">+4°C</option>
                        </select>
                    </div>
                    <!-- Techniques -->
                    <div class="form-group">
                        <label for="technics" class="form-label">Techniques:</label>
                        <div class="checkbox-group" id="technics">
                            <ul class="checkbox-list list-unstyled">
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Macroscopy" ' . (in_array("Macroscopy", $selectedTechnics) ? "checked" : "") . '>Macroscopy</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Microtomy" ' . (in_array("Microtomy", $selectedTechnics) ? "checked" : "") . '>Microtomy</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="HE Staining" ' . (in_array("HE Staining", $selectedTechnics) ? "checked" : "") . '>HE Staining</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Special Staining" ' . (in_array("Special Staining", $selectedTechnics) ? "checked" : "") . '>Special Staining</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Immunohistochemistry" ' . (in_array("Immunohistochemistry", $selectedTechnics) ? "checked" : "") . '>Immunohistochemistry</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Embedding" ' . (in_array("Embedding", $selectedTechnics) ? "checked" : "") . '>Embedding</label></li>
                                <li><label><input type="checkbox" class="me-2" name="technics[]" value="Immunofluorescence" ' . (in_array("Immunofluorescence", $selectedTechnics) ? "checked" : "") . '>Immunofluorescence</label></li>
                            </ul>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-around">
                        <button name="Cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Cancel</button>
                        <button id="' . $row['pro_id'] . '" name="submit" class="form-control btn editBtn btn-primary confirm w-25">Edit Product</button>
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
</style>

<script>
function previewImage() {
    var preview = document.getElementById("preview-image");
    var file = document.getElementById("image").files[0];
    var reader = new FileReader();

    reader.onloadend = function () {
        preview.src = reader.result;
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.src = "";
    }
}
</script>';

echo $html;
?>
