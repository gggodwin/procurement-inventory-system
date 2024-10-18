<?php
include '../../../core/dbsys.ini'; // Your existing PDO connection

try {
    // Fetch the latest barcode
    $sql = "SELECT MAX(barcode) AS latest_barcode FROM dbpis_items"; 
    $stmt = $db->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $latest_barcode = $row['latest_barcode'] ? intval($row['latest_barcode']) + 1 : 1; // Start from 1 if no barcodes exist

    // Fetch the latest PR code
    $sql_pr = "SELECT MAX(prs_code) AS last_pr_code FROM dbpis_prs"; 
    $stmt_pr = $db->query($sql_pr);
    $row_pr = $stmt_pr->fetch(PDO::FETCH_ASSOC);
    // Increment the last PR code or start at 6000 if no PR codes exist
    $latest_pr_code = $row_pr['last_pr_code'] ? intval($row_pr['last_pr_code']) + 1 : 6000; // Start from 6000 if no PR codes exist

    // Return both latest codes in a single JSON response
    echo json_encode([
        'latest_barcode' => $latest_barcode,
        'latest_pr_code' => $latest_pr_code
    ]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
