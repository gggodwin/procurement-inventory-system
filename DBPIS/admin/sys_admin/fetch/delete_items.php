<?php
include '../../../core/dbsys.ini'; // your PDO connection file

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

// If no delete request, return an error
echo json_encode(['success' => false, 'message' => 'Invalid request.']);
?>
