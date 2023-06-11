<?php
require '../../database/dataBase.php';

$query = "SELECT *
FROM supplier;";
$inStock = $conn->prepare($query);
$inStock->execute();
$result = $inStock->fetchAll();

$queryP = "SELECT *
FROM product;";
$inStock = $conn->prepare($queryP);
$inStock->execute();
$resultP = $inStock->fetchAll();


$html = '
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content rounded-4">
    <div class="modal-body py-0 px-6">
      <div class="content-text p-4 px-5 align-item-stretch">
        <form method="POST" class="inStockForm" enctype="multipart/form-data">
          <div class="text-center mb-5">
            <h2 class="heading-section">Entrée De Produit(s)</h2>
          </div>
          
          <div class="rounded-3 bg-light p-4">
          <!-- fournisseur -->
          <div class="form-group mb-3">
            <label for="fournisseur1" class="form-label">Fournisseur:</label>
            <select id="fournisseur1" name="fournisseur1" class="form-control form-select">
              <option value=""></option>';
                foreach ($result as $row) {
                    $supplier = $row['sup_name'];
                    $html .= "<option value=\"$supplier\">$supplier</option>";
                }
            $html .= '
            </select>
          </div>
            
            <div id="additional-supplier-fields"></div>
            
            <div class="form-group my-3">
              <button type="button" id="addMoreSupp" class="btn btn btn-outline-info">New Supplier</button>
            </div>
          </div>

          <div class="text-center mb-5">
            <h3 class="heading-section">Produit(s)</h3>
          </div>
          <div class="rounded-3 bg-light p-4">
            <!-- produit -->
            <div class="form-group mb-3">
              <label for="nameP" class="form-label">Produit:</label>
              <select id="nameP1" name="nameP1" class="form-control form-select">
                    <option value=""></option>';
                        foreach ($resultP as $row) {
                            $name = $row['pro_name'];
                            $html .= "<option value=\"$name\">$name</option>";
                        }
                    $html .= '
                    </select>
            </div>
            <div class="form-group mb-3">
                  <label for="quantity1" class="form-label">Quantité: </label>
                  <input type="number" id="quantity1" name="quantity1" class="form-control" placeholder="quantité">
                </div>
          </div>
          
          <div id="additional-product-fields"></div>
          
          <div class="form-group my-3 d-flex justify-content-around">
            <button type="button" id="addMoreProd" class="btn btn btn-outline-info"> + Autre </button>
            <button type="button" id="addNewProduct" class="btn btn btn-outline-info">Nouveau Produit</button>
          </div>
          
          <div class="form-group d-flex justify-content-around">
            <a href="./dispoProducts.php" name="cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Cancel</a>
            <button type="submit" name="submit" class="form-control btn btn-primary confirmInStock w-25">Suivant</button>
          </div>
          
        </form>
      </div>
    </div>
  </div>
</div>
';

echo $html;

?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     var prodCount = 1;
     var prodNCount = 0; 
     var newSup=0;
     $(document).ready(function() {
    $("#addMoreSupp").click(function() {
      newSup ++;
      var html = `<div class="rounded-3 bg-light p-4 mt-4">
                    <div class="form-group mb-3">
                      <!-- name -->
                      <label for="fournisseur" class="form-label">Fournisseur:</label>
                      <input type="text" id="fournisseur" class="form-control" placeholder="Fournisseur" name="fournisseur">
                    </div>
                    <div class="form-group mb-3">
                      <label for="emailSup" class="form-label">Email: </label>
                      <input type="email" id="emailSup" name="emailSup" class="form-control" placeholder="Email">
                    </div>
                    <div class="form-group mb-3">
                      <label for="phoneSup" class="form-label">Telephone: </label>
                      <input type="number" id="phoneSup" name="phoneSup" class="form-control" placeholder="Numero de Telephone">
                    </div>
                  </div>`;
  
      $("#additional-supplier-fields").append(html);
      $("#fournisseur1").prop("disabled", true);
      $("#addMoreSupp").hide();
    });
         
    $("#addMoreProd").click(function() {
        prodCount++; // Increment the counter
        var html = `<div class="rounded-3 bg-light p-4 mt-4">
                    <div class="form-group mb-3">
                        <label for="nameP${prodCount}" class="form-label">Product ${prodCount}:</label>
                        <select name="nameP${prodCount}" id="nameP${prodCount}" class="form-control form-select">
                      <option value=""></option>
                      <?php
                      foreach ($resultP as $row) {
                        $name = $row['pro_name'];
                        echo "<option value=\"$name\">$name</option>";
                      }
                      ?>
                    </select>
                    </div>
                    <div class="form-group mb-3">
                        <label for="quantity${prodCount}" class="form-label">Quantité: </label>
                        <input type="number" id="quantity${prodCount}" name="quantity${prodCount}" class="form-control" placeholder="Quantité">
                    </div>
                    </div>`;
                    console.log(prodCount);

$("#additional-product-fields").append(html);
    });
  
 
    
      $("#addNewProduct").click(function() {
        prodNCount++; // Increment the counter
        var html = `<div class="rounded-3 bg-light p-4 mt-4">
                      <div class="form-group mb-3">
                        <label for="nameNP${prodNCount}" class="form-label">Nom De Produit (${prodNCount}):</label>
                        <input type="text" name="nameNP${prodNCount}" id="nameNP${prodNCount}" class="form-control" placeholder="Nom De Produit">
                      </div>
                      <div class="form-group mb-3">
                        <label for="unit${prodNCount}" class="form-label">Unité (${prodNCount}): </label>
                        <input type="text" name="unit${prodNCount}" id="unit${prodNCount}" class="form-control" placeholder="Unité">
                      </div>
                      <div class="form-group mb-3">
                        <label for="quantityNP${prodNCount}" class="form-label">Quantité (${prodNCount}): </label>
                        <input type="number" name="quantityNP${prodNCount}" id="quantityNP${prodNCount}" class="form-control" placeholder="Quantité">
                      </div>
                      <div class="form-group">
                        <label for="type${prodNCount}" class="form-label">Type De Produit (${prodNCount}):</label>
                        <select id="type${prodNCount}" name="type${prodNCount}" class="form-control form-select py-3" placeholder="Type De Produit">
                          <option value="Chimique">Chimique</option>
                          <option value="Fongible">Fongible</option>
                          <option value="Immuno">Immuno</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="condition${prodNCount}" class="form-label">Condition de Conservation (${prodNCount}):</label>
                        <select id="condition${prodNCount}" name="condition${prodNCount}" class="form-control form-select py-3" placeholder="Condition de Conservation">
                          <option value="+15 à +25°C">+15 à +25°C</option>
                          <option value="+4°C">+4°C</option>
                        </select>
                      </div>
                      <div class="form-group mb-3">
                        <label for="dateExp${prodNCount}" class="form-label">Date d'Expiration (${prodNCount}): </label>
                        <input type="date" id="dateExp${prodNCount}" name="dateExp${prodNCount}" class="form-control" placeholder="Date d'Expiration">
                      </div>
                      <div class="form-group">
  <label for="technics${prodNCount}" class="form-label">Techniques (${prodNCount}):</label>
  <div class="checkbox-group" id="technics${prodNCount}">
    <ul class="checkbox-list list-unstyled">
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Macro">Macro</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Microto">Microto</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Coloration HE">Coloration HE</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Coloration SP">Coloration SP</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Immuno">Immuno</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="En Robage">En Robage</label></li>
      <li><label><input type="checkbox" class="me-2" name="technics${prodNCount}[]" value="Imuuno FL">Imuuno FL</label></li>
    </ul>
  </div>
</div>


                      <div class="form-group mb-3">
                        <label for="image${prodNCount}" class="form-label">Image (${prodNCount}): </label>
                        <input type="file" name="image[]" id="image${prodNCount}" class="form-control input-group-text" placeholder="Image de Produit">

                      </div>
                    </div>`;
    
        $("#additional-product-fields").append(html);
      });
    });


    
  

    $(document).on('submit', '.inStockForm', function(e) {
  e.preventDefault();

  var formData = new FormData(this); 
  formData.append('prodCount', prodCount);
  formData.append('prodNCount', prodNCount);
  formData.append('newSup', newSup);
  var fileInputs = document.querySelectorAll('[name^="image"]');
  fileInputs.forEach(function(fileInput) {
    var files = fileInput.files;
    for (var i = 0; i < files.length; i++) {
      formData.append('files[]', files[i]);
    }
  });

  $.ajax({
    url: 'productsInStock.php',
    type: 'POST',
    data: formData,
    processData: false,
    contentType: false,
    success: function(response) {
      console.log(response);
      window.location.href = "./dispoProducts.php";
    },
    error: function(xhr, status, error) {
      console.log(error);
    }
  });
});


</script>
