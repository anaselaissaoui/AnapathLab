<?php

// Define the number of rows to display per page
$rowsPerPage = 25;

// Get the current page number from the query string
if (isset($_GET['page'])) {
    $currentPage = $_GET['page'];
} else {
    $currentPage = 1;
}

// Calculate the offset for the database query
$offset = ($currentPage - 1) * $rowsPerPage;

// Perform the database query with the offset and limit
$stmt = $conn->prepare("SELECT * FROM product LIMIT :offset, :rowsPerPage");
$stmt->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmt->bindValue(':rowsPerPage', $rowsPerPage, PDO::PARAM_INT);
$stmt->execute();

// Fetch the rows from the database
$resultTable = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Count the total number of rows in the table
$stmt = $conn->query("SELECT COUNT(*) FROM product");
$totalRows = $stmt->fetchColumn();

// Calculate the total number of pages
$totalPages = ceil($totalRows / $rowsPerPage);

// Display the table rows
if (count($resultTable) > 0) {
    foreach ($resultTable as $row) {
        echo '<tr class="fw-normal text-center">
            <td>' . $row['pro_name'] . '</td>
            <td>' . $row['pro_quant'] . '</td>
            <td>' . $row['pro_date_modif'] . '</td>
            <td>' . $row['pro_type'] . '</td>
            <td>' . $row['pro_condition'] . '</td>
            <td class="text-center"><a data-pro-id="' . $row['pro_id'] . '" class="btn btn-sm btn-prim" href="">Details</a><a id="' . $row['pro_id'] . '" class="btn btn-sm btn-primary ms-1 edit-button">Modifier</a>
            </td>
        </tr>';
    }
}

?>

