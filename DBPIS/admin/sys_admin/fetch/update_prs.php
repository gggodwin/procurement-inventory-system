<?php
include '../../../core/dbsys.ini'; // PDO connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect POST data for the PR requisition
    $prs_code = $_POST['prs_code'];
    $requested_by = $_POST['requested_by'];
    $department = $_POST['department'];
    $date_requested = $_POST['date_requested'];
    $date_needed = $_POST['date_needed'];
    $remarks = $_POST['remarks'];

    // Prepare the update query for the requisition
    $query = "UPDATE dbpis_prs SET requested_by = :requested_by, department = :department, 
              date_requested = :date_requested, date_needed = :date_needed, remarks = :remarks 
              WHERE prs_code = :prs_code";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':requested_by', $requested_by);
    $stmt->bindParam(':department', $department);
    $stmt->bindParam(':date_requested', $date_requested);
    $stmt->bindParam(':date_needed', $date_needed);
    $stmt->bindParam(':remarks', $remarks);
    $stmt->bindParam(':prs_code', $prs_code);

    // Execute the update query for the requisition
    if ($stmt->execute()) {
        // Proceed to handle PR items in dbpis_prsdetails

        // Collect POST data for the PR items (assuming arrays for each item field)
        $item_codes = $_POST['item_code'];
        $item_descriptions = $_POST['item_description'];
        $quantities = $_POST['quantity'];
        $unit_types = $_POST['unit_type'];
        $suppliers = $_POST['supplier'];
        $unit_prices = $_POST['unit_price'];
        $total_prices = $_POST['total_price'];

        // First, delete all current details for this PR code (to reset)
        $deleteQuery = "DELETE FROM dbpis_prsdetails WHERE prs_code = :prs_code";
        $deleteStmt = $db->prepare($deleteQuery);
        $deleteStmt->bindParam(':prs_code', $prs_code);
        $deleteStmt->execute();

        // Then, insert each item back into the prsdetails table
        $insertQuery = "INSERT INTO dbpis_prsdetails (prs_code, item_code, item_description, quantity, unit_type, supplier, unit_price, total_price)
                        VALUES (:prs_code, :item_code, :item_description, :quantity, :unit_type, :supplier, :unit_price, :total_price)";
        $insertStmt = $db->prepare($insertQuery);

        // Loop through each item and insert
        for ($i = 0; $i < count($item_codes); $i++) {
            $insertStmt->bindParam(':prs_code', $prs_code);
            $insertStmt->bindParam(':item_code', $item_codes[$i]);
            $insertStmt->bindParam(':item_description', $item_descriptions[$i]);
            $insertStmt->bindParam(':quantity', $quantities[$i]);
            $insertStmt->bindParam(':unit_type', $unit_types[$i]);
            $insertStmt->bindParam(':supplier', $suppliers[$i]);
            $insertStmt->bindParam(':unit_price', $unit_prices[$i]);
            $insertStmt->bindParam(':total_price', $total_prices[$i]);

            // Execute the insert statement for each item
            $insertStmt->execute();
        }

        // Return success message after updating both the PR and details
        echo json_encode(['success' => true, 'message' => 'Purchase Requisition and its details updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update Purchase Requisition.']);
    }
}
?>
