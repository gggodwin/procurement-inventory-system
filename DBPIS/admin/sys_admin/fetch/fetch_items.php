<?php
// fetch_data.php
include '../../../core/dbsys.ini'; // your PDO connection file

$query = "SELECT particular, brand, current_stock, safety_stock FROM dbpis_items";
$stmt = $db->prepare($query);
$stmt->execute();

$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Output data as JSON
echo json_encode($items);
?>
