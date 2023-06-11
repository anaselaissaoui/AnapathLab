<?php



if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {

                        echo '<tr class="text-center text-secondary">
                        <td>'.$row['sup_name'].'</td>
                        <td>'.$row['sup_email'].'</td>
                        <td>'.$row['sup_phone'].'</td>
                        
                    </tr>';
                    }
                } else{
                    echo "<tr><td colspan='6'><h2 class='text-center mx-auto' style='color:red;'>Pas des Produits</h2></td></tr>";

                }

            ?>