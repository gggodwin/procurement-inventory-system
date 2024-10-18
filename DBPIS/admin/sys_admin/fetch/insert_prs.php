<?php
include '../../../core/dbsys.ini'; // Use your existing PDO connection

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        // Retrieve form data
        $prs_code = $_POST['prs_code'];
        $requested_by = $_POST['requested_by'];
        $department = $_POST['department'];
        $date_requested = $_POST['date_requested'];
        $date_needed = $_POST['date_needed']; // Retrieve the new field
        $remarks = $_POST['remarks'];

        // Prepare to insert into dbpis_prs
        $sqlPrs = "INSERT INTO dbpis_prs (prs_code, requested_by, department, date_requested, approval_status, remarks, date_needed) 
                   VALUES (:prs_code, :requested_by, :department, :date_requested, 'Pending', :remarks, :date_needed)";
        
        $stmtPrs = $db->prepare($sqlPrs);
        $stmtPrs->execute([
            ':prs_code' => $prs_code,
            ':requested_by' => $requested_by,
            ':department' => $department,
            ':date_requested' => $date_requested,
            ':date_needed' => $date_needed, // Bind the new field
            ':remarks' => $remarks
        ]);

        // Get the last inserted PR ID
        $prs_id = $db->lastInsertId();

        // Prepare to insert into dbpis_prsdetails
        $item_codes = $_POST['item_code'];
        $item_descriptions = $_POST['item_description'];
        $quantities = $_POST['quantity'];
        $unit_prices = $_POST['unit_price'];
        $unit_types = $_POST['unit_type'];
        $suppliers = $_POST['supplier']; // Get the supplier field from the form

        // Prepare insert query for dbpis_prsdetails
        $sqlDetails = "INSERT INTO dbpis_prsdetails (prs_code, item_code, item_description, quantity, unit_price, total_price, requested_date, unit_type, supplier) 
                       VALUES (:prs_code, :item_code, :item_description, :quantity, :unit_price, :total_price, :requested_date, :unit_type, :supplier)";
        
        // Loop through the items and insert them into dbpis_prsdetails
        for ($i = 0; $i < count($item_codes); $i++) {
            $total_price = $quantities[$i] * $unit_prices[$i]; // Calculate total price
            
            $stmtDetails = $db->prepare($sqlDetails);
            $stmtDetails->execute([
                ':prs_code' => $prs_code,
                ':item_code' => $item_codes[$i],
                ':item_description' => $item_descriptions[$i],
                ':quantity' => $quantities[$i],
                ':unit_price' => $unit_prices[$i],
                ':total_price' => $total_price,
                ':requested_date' => $date_requested,
                ':unit_type' => $unit_types[$i],
                ':supplier' => $suppliers[$i] // Add supplier to the execution array
            ]);

            // Debugging: output the inserted values
            error_log("Inserted item: PR Code: $prs_code, Item Code: {$item_codes[$i]}, Quantity: {$quantities[$i]}, Unit Price: {$unit_prices[$i]}, Total Price: $total_price, Supplier: {$suppliers[$i]}");
        }

        echo json_encode(['success' => true, 'message' => 'Purchase Requisition inserted successfully']);
    } catch (PDOException $e) {
        echo json_encode(['success' => false, 'message' => 'Error: ' . $e->getMessage()]);
    }
}
