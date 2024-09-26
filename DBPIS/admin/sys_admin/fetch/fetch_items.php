<?php
// fetch_data.php
include '../../../core/dbsys.ini'; // your PDO connection file

if (isset($_GET['barcode'])) {
    // Sanitize barcode input to prevent SQL injection
    $barcode = $_GET['barcode'];
    $query = "SELECT barcode, particular, brand, current_stock, safety_stock, category FROM dbpis_items WHERE barcode = :barcode";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':barcode', $barcode, PDO::PARAM_STR);
    $stmt->execute();
    $item = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return the item details as JSON
    if ($item) {
        echo json_encode($item);
    } else {
        echo json_encode(['error' => 'Item not found.']);
    }
    exit; // Exit to prevent executing the following code
}


// Query to fetch item data
$query = "SELECT particular, brand, current_stock, safety_stock, category FROM dbpis_items";
$stmt = $db->prepare($query);
$stmt->execute();
$items = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query to get the total number of items
$queryCount = "SELECT COUNT(*) AS total_items FROM dbpis_items";
$stmtCount = $db->prepare($queryCount);
$stmtCount->execute();
$countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
$totalItems = $countResult['total_items'];

// Query to fetch items where current_stock < safety_stock
$queryLowStock = "SELECT barcode,particular, brand, current_stock, safety_stock, category FROM dbpis_items WHERE current_stock < safety_stock";
$stmtLowStock = $db->prepare($queryLowStock);
$stmtLowStock->execute();
$lowStockItems = $stmtLowStock->fetchAll(PDO::FETCH_ASSOC);

// Query to get the total number of low stock items
$queryLowStockCount = "SELECT COUNT(*) AS low_stock_items FROM dbpis_items WHERE current_stock < safety_stock";
$stmtLowStockCount = $db->prepare($queryLowStockCount);
$stmtLowStockCount->execute();
$lowStockCountResult = $stmtLowStockCount->fetch(PDO::FETCH_ASSOC);
$totalLowStockItems = $lowStockCountResult['low_stock_items'];

// Output data as JSON, including total item count
echo json_encode([
    'items' => $items,
    'total_items' => $totalItems,
    'low_stock_items' => $lowStockItems,
    'total_low_stock_items' => $totalLowStockItems
]);
?>
