<?php
// fetch_data.php
include '../../../core/dbsys.ini'; // Your PDO connection file

// Check if a delete request is made
if (isset($_POST['delete']) && isset($_POST['barcode'])) {
    // Sanitize barcode input to prevent SQL injection
    $barcode = $_POST['barcode'];

    // Prepare and execute the delete query
    $deleteQuery = "DELETE FROM dbpis_items WHERE barcode = :barcode";
    $stmtDelete = $db->prepare($deleteQuery);
    $stmtDelete->bindParam(':barcode', $barcode, PDO::PARAM_STR);

    if ($stmtDelete->execute()) {
        // Return success response
        echo json_encode(['success' => true, 'message' => 'Item deleted successfully']);
    } else {
        // Return error response
        echo json_encode(['success' => false, 'message' => 'Failed to delete item']);
    }
    exit; // Exit after handling delete to prevent executing the rest of the code
}

// Determine which items to fetch based on the category parameter
if (isset($_GET['category'])) {
    // Sanitize category input to prevent SQL injection
    $category = $_GET['category'];

    if ($category === 'low_stock') {
        // Query to fetch items where current_stock < safety_stock
        $query = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
                  FROM dbpis_items WHERE current_stock < safety_stock";
    } elseif ($category === '') {
        // Fetch all items when no specific category is provided
        $query = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
                  FROM dbpis_items";
    } else {
        // Query to fetch item data by category
        $query = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
                  FROM dbpis_items WHERE category = :category";
    }

    $stmt = $db->prepare($query);
    
    if ($category !== '' && $category !== 'low_stock') {
        $stmt->bindParam(':category', $category, PDO::PARAM_STR);
    }

    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Return the filtered items as JSON
    echo json_encode($items);
    exit; // Exit to prevent executing the following code
}

if (isset($_GET['barcode'])) {
    // Sanitize barcode input to prevent SQL injection
    $barcode = $_GET['barcode'];
    $query = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
              FROM dbpis_items WHERE barcode = :barcode"; // Include units
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

if (isset($_GET['search'])) {
    $searchTerm = '%' . $_GET['search'] . '%';
    $query = "SELECT barcode, particular, brand FROM dbpis_items WHERE particular LIKE :search OR brand LIKE :search LIMIT 10";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':search', $searchTerm, PDO::PARAM_STR);
    $stmt->execute();
    $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['items' => $items]);
    exit;
}

// Default query to fetch all item data if no specific request is made
$query = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
          FROM dbpis_items"; // Include units
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
$queryLowStock = "SELECT barcode, particular, brand, current_stock, units, safety_stock, category 
                  FROM dbpis_items WHERE current_stock < safety_stock"; // Include units
$stmtLowStock = $db->prepare($queryLowStock);
$stmtLowStock->execute();
$lowStockItems = $stmtLowStock->fetchAll(PDO::FETCH_ASSOC);

// Query to get the total number of low stock items
$queryLowStockCount = "SELECT COUNT(*) AS low_stock_items FROM dbpis_items WHERE current_stock < safety_stock";
$stmtLowStockCount = $db->prepare($queryLowStockCount);
$stmtLowStockCount->execute();
$lowStockCountResult = $stmtLowStockCount->fetch(PDO::FETCH_ASSOC);
$totalLowStockItems = $lowStockCountResult['low_stock_items'];

// Output data as JSON, including total item count and low stock items
echo json_encode([
    'items' => $items,
    'total_items' => $totalItems,
    'low_stock_items' => $lowStockItems,
    'total_low_stock_items' => $totalLowStockItems
]);
?>
