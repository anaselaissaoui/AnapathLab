<?php



if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {

                        echo '<tr class="text-center text-secondary">
                        <td>'.$row['ord_id'].'</td>
                        <td>'.$row['sup_name'].'</td>
                        <td>'.$row['ord_date'].'</td>
                        
                    </tr>';
                    }
                } else{
                    echo "<tr><td colspan='6'><h2 class='text-center mx-auto' style='color:red;'>Pas des Produits</h2></td></tr>";

                }

            ?>