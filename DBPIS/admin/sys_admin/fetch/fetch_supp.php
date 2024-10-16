<?php
include '../../../core/dbsys.ini'; // PDO connection file

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Parse the DELETE request for parameters
    parse_str(file_get_contents("php://input"), $_DELETE); // Parse the input for DELETE request
    if (isset($_DELETE['supplier_id'])) {
        $supplier_id = $_DELETE['supplier_id'];

        // Prepare and execute the delete statement
        $query = "DELETE FROM dbpis_supplier WHERE supplier_id = :supplier_id"; // Adjust table name if necessary
        $stmt = $db->prepare($query);
        $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
        $result = $stmt->execute();

        // Return success or error message
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Supplier deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete supplier.']);
        }
        exit; // Exit after processing the DELETE request
    } else {
        echo json_encode(['success' => false, 'message' => 'Supplier ID not provided.']);
        exit;
    }
}

// Handle GET request to fetch supplier details or all suppliers
if (isset($_GET['supplier_id'])) {
    $supplier_id = $_GET['supplier_id'];

    // Fetch supplier details by supplier ID
    $query = "SELECT supplier_id, supplier_name, contact_name, contact_email, contact_phone, address, created_at, updated_at 
              FROM dbpis_supplier WHERE supplier_id = :supplier_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
    $stmt->execute();
    $supplier = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return supplier details as JSON
    if ($supplier) {
        echo json_encode(['supplier' => $supplier]);
    } else {
        echo json_encode(['error' => 'Supplier not found.']);
    }
    exit; // Exit to prevent executing the following code
}

// Fetch all suppliers
$query = "SELECT supplier_id, supplier_name, contact_name, contact_email, contact_phone, address, created_at, updated_at FROM dbpis_supplier";
$stmt = $db->prepare($query);
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch total count of suppliers
$queryCount = "SELECT COUNT(*) AS total_suppliers FROM dbpis_supplier";
$stmtCount = $db->prepare($queryCount);
$stmtCount->execute();
$countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
$totalSuppliers = $countResult['total_suppliers'];

// Output data as JSON
echo json_encode([
    'suppliers' => $suppliers,
    'total_suppliers' => $totalSuppliers
]);
?>
