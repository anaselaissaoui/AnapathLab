<?php
require '../../database/dataBase.php';
$pro_id = $_GET['id'];


$html='<div class="modal-dialog modal-lg  modal-dialog-centered" role="document">
<div class="modal-content rounded-4">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmationModalLabel">Confirmation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Voulez-vous vraiment supprimer ce produit?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
        <button type="button" id="'.$pro_id.'"class="btn btn-danger confirmDelete" >Yes</button>
      </div>
    </div>
  </div>
</div>';


echo $html;
?>