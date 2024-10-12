<?php
// update_item.php
include '../../../core/dbsys.ini'; // your PDO connection file

// Get form data
$barcode = $_POST['barcode'];
$particular = $_POST['particular']; // Added
$brand = $_POST['brand']; // Added
$current_stock = $_POST['current_stock'];
$safety_stock = $_POST['safety_stock'];
$category = $_POST['category']; // Added
$units = $_POST['units']; // Added

// Prepare and execute the update query
$query = "UPDATE dbpis_items SET 
          particular = ?, 
          brand = ?, 
          category = ?, 
          current_stock = ?, 
          safety_stock = ?, 
          units = ? 
          WHERE barcode = ?";
$stmt = $db->prepare($query);
$success = $stmt->execute([$particular, $brand, $category, $current_stock, $safety_stock, $units, $barcode]);

// Return JSON response
if ($success) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to update item stock.']);
}
?>
