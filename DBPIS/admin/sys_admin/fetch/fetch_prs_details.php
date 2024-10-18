<?php
include '../../../core/dbsys.ini'; // Include your PDO connection

try {
    // Query to fetch PRS details including supplier name
    $sql = "SELECT d.prs_code, d.item_code, d.item_description, d.quantity, d.unit_price, 
                   (d.quantity * d.unit_price) AS total_price, d.requested_date, d.unit_type, d.supplier AS supplier_name
            FROM dbpis_prsdetails d"; // Ensure this table contains the correct data

    $stmt = $db->prepare($sql);
    $stmt->execute();

    // Fetch all PRS details
    $prs_details = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Return data as JSON
    header('Content-Type: application/json');
    echo json_encode(['details' => $prs_details]);

} catch (PDOException $e) {
    // Return error message as JSON
    echo json_encode(['error' => $e->getMessage()]);
}
?>
