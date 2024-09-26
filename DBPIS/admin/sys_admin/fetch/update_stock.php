<?php
// update_stock.php
include '../../../core/dbsys.ini'; // your PDO connection file

// Get form data
$barcode = $_POST['barcode'];
$current_stock = $_POST['current_stock'];
$safety_stock = $_POST['safety_stock'];

// Prepare and execute the update query
$query = "UPDATE dbpis_items SET current_stock = ?, safety_stock = ? WHERE barcode = ?";
$stmt = $db->prepare($query);
$success = $stmt->execute([$current_stock, $safety_stock, $barcode]);

// Return JSON response
if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update item stock.']);
}
?>
