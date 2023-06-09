<?php



if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {
        echo '
        <div class="cardProduct">
            <div class="main">
              <img class="productImage" src="'.$row['pro_img'].'" alt="'.$row['pro_name'].'" />
              <h5 class="text-white">'.$row['pro_name'].', '.$row['pro_unit'].'</h5 class="text-white">
              <p class="techniques">Techniques : '.$row['pro_techn'].'</p>
              <div class="productInfo">
                <div class="productType">
                  <ins>◘</ins>
                  <p>'.$row['pro_type'].'</p>
                </div>
                <div class="dateExp">
                  <ins>◷</ins>
                  <p>'.$row['pro_date_exp'].'</p>
                </div>
              </div>
            </div>
          </div>';}
        
                } else{
                    echo "<tr><td colspan='6'><h2 class='text-center mx-auto' style='color:red;'>Pas des Produits</h2></td></tr>";

                }
