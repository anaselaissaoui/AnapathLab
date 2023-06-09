<?php
require '../../database/dataBase.php';

$query = "SELECT *
FROM product
WHERE pro_quant > 0;";
$outStock = $conn->prepare($query);
$outStock->execute();
$result = $outStock->fetchAll();

$html = '
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content rounded-4">
    <div class="modal-body py-0 px-6">
      <div class="content-text p-4 px-5 align-item-stretch">
        <form method="POST" class="outStockForm" enctype="multipart/form-data">
          <div class="text-center mb-5">
            <h2 class="heading-section">Sortie De Produit(s)</h2>
          </div>
          
          <div class="rounded-3 bg-light p-4">
          <!-- name -->
            <div class="form-group mb-3">
                <label for="name" class="form-label">Nom de produit(s):</label>
                <select id="name" name="name[]" class="form-control form-select">
                <option value=""></option>';
    foreach ($result as $row) {
    $name = $row['pro_name'];
    $html .= "<option value=\"$name\">$name</option>";
    }
    $html .= '
                </select>
            </div>
          
            <!-- quantity -->
            <div class="form-group mb-3">
                <label for="quantity" class="form-label">Quantité: </label>
                <input type="number" id="quantity" name="quantity[]" class="form-control" placeholder="quantity">
            </div>
          </div>
          
          <div id="additional-fields"></div>
          
          <div class="form-group my-3">
            <a id="addMore" class="btn btn-outline-info">+ Autre</a>
          </div>
          
          <div class="form-group d-flex justify-content-around">
            <button name="cancel" style="background-color:#56c4cf; color:white;" class="form-control btn w-25">Cancel</button>
            <button type="submit" name="submit" class="form-control btn btn-primary confirmOutStock w-25">Submit</button>
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
                  <label for="name" class="form-label">Nom de produit(s):</label>
                  <select name="name[]" class="form-control form-select">
                    <option value=""></option>
                    <?php
                    foreach ($result as $row) {
                      $name = $row['pro_name'];
                      echo "<option value=\"$name\">$name</option>";
                    }
                    ?>
                  </select>
                </div>
                <div class="form-group mb-3">
                  <label for="quantity" class="form-label">Quantité: </label>
                  <input type="number" name="quantity[]" class="form-control" placeholder="quantity">
                </div>
                </div>`;

    $("#additional-fields").append(html);
  });

  $(document).on('submit', '.outStockForm', function(e) {
    e.preventDefault();

    // Get the form data
    var formData = $(this).serialize();

    // Make an AJAX request to confirmOutStock.php
    $.ajax({
      url: './confirmOutStock.php',
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
