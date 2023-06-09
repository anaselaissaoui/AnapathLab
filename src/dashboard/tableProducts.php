<?php



if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {

                        echo '<tr class="text-center">
                        <td>'.$row['pro_name'].'</td>
                        <td>'.$row['pro_quant'].'</td>
                        <td>'.$row['pro_date_exp'].'</td>
                        <td>'.$row['pro_type'].'</td>
                        <td>'.$row['pro_condition'].'</td>
                        <td  class="text-center"><a data-pro-id="'.$row['pro_id'].'" class="btn btn-sm btn-prim" href="">Details</a><a id="' . $row['pro_id'] . '" class="btn btn-sm btn-primary ms-1 edit-button">Modifier</a>
                        </td>
                    </tr>';
                    }
                } else{
                    echo "<tr><td colspan='6'><h2 class='text-center mx-auto' style='color:red;'>Pas des Produits</h2></td></tr>";

                }

            ?>