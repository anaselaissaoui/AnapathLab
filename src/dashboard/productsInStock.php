<?php
require '../../database/dataBase.php';

$query = "SELECT *
FROM product;";
$inStock = $conn->prepare($query);
$inStock->execute();
$result = $inStock->fetchAll();

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
                            $name = $row['pro_name'];
                            $html .= "<option value=\"$name\">$name</option>";
                        }
                    $html .= '
                    </select>
                </div>
        </div>
          
          <div id="additional-fields"></div>
          
          <div class="form-group my-3">
            <a id="addMore" class="btn btn btn-outline-info">New Supplier</a>
          </div>
          
          <div class="form-group d-flex justify-content-around">
            <button name="cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Cancel</button>
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
    $(document).ready(function() {
        $("#addMore").click(function() {
            var html = `<div class="rounded-3 bg-light p-4 mt-4">
                            <div class="form-group mb-3">
                                <!-- name -->
                                <label for="fournisseur" class="form-label">Fournisseur:</label>
                                <input type="text" id="fournisseur" class="form-control" placeholder="Fournisseur" name="fournisseur">
                            </div>
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email: </label>
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Telephone: </label>
                                <input type="number" name="phone" class="form-control" placeholder="Numero de Telephone">
                            </div>
                            
                        </div>`;



            $("#additional-fields").append(html);
            $("#fournisseur1").prop("disabled", true);

        });

        $(document).on('submit', '.inStockForm', function(e) {
            e.preventDefault();

            // Get the form data
            var formData = $(this).serialize();

            // Make an AJAX request to productsInStock.php
            $.ajax({
                url: './productsInStock.php',
                type: 'POST',
                data: formData,
                success: function(response) {
                    // Handle the success response if needed
                    console.log(response);
                    window.location.href = "./dispoProducts.php"; // Redirect to majorDashboard.php

                },
                error: function(xhr, status, error) {
                    // Handle error if the AJAX request fails
                    console.log(error);
                }
            });
        });
    });
</script>