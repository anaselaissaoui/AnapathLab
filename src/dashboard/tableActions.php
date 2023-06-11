<?php



if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {
        if ($row['tab_name'] === 'product') {
            $row['tab_name'] = 'Produit';
        } elseif ($row['tab_name'] === 'order_com') {
            $row['tab_name'] = 'Commandes';
        } elseif ($row['tab_name'] === 'supplier') {
            $row['tab_name'] = 'Fournisseurs';
        }

        echo '<li class="list-group-item px-3 border-0 rounded-3 justify-content-between list-group-item-dark mb-2">';
        echo '<div style="display: flex; justify-content: space-between; align-items: center;">';

        if ($row['act_type'] === 'UPDATE') {
            echo '<span>Mme.' . $row['usr_name'] . ' a modifié un élément dans le tableau ' . $row['tab_name'] . '</span>';
        } elseif ($row['act_type'] === 'INSERT') {
            echo '<span>Mme.' . $row['usr_name'] . ' a ajouté un élément dans le tableau ' . $row['tab_name'] . '</span>';
        } elseif ($row['act_type'] === 'DELETE') {
            echo '<span>Mme.' . $row['usr_name'] . ' a supprimé un élément dans le tableau ' . $row['tab_name'] . '</span>';
        }

        echo '<span class="fw-normal" style="font-size:0.8rem;">' . date("Y-m-d H:i:s", strtotime($row['act_date'])) . '</span>';
        echo '</div>';
        echo '</li>';
    }
}

        
            ?>