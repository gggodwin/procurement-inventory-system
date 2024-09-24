<?php
include '../../../core/dbsys.ini'; // Use your existing PDO connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve form data
        $barcode = $_POST['barcode'];
        $particular = $_POST['particular'];
        $brand = $_POST['brand'];
        $category = $_POST['category'];
        $safety_stock = $_POST['safety_stock'];
        $current_stock = $_POST['current_stock'];
        $last_updated = date('Y-m-d H:i:s'); // Current timestamp

        // Insert query
        $sql = "INSERT INTO dbpis_items (barcode, particular, brand, category, safety_stock, current_stock, last_updated) 
                VALUES (:barcode, :particular, :brand, :category, :safety_stock, :current_stock, :last_updated)";
        $stmt = $db->prepare($sql); // Assuming $db is your PDO connection

        // Execute the statement
        $stmt->execute([
            ':barcode' => $barcode,
            ':particular' => $particular,
            ':brand' => $brand,
            ':category' => $category,
            ':safety_stock' => $safety_stock,
            ':current_stock' => $current_stock,
            ':last_updated' => $last_updated,
        ]);

        echo json_encode(['success' => true, 'message' => 'Item inserted successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
?>
