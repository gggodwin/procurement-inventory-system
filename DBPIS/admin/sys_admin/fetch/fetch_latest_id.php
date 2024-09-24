<?php
include '../../../core/dbsys.ini'; // Your existing PDO connection

try {
    $sql = "SELECT MAX(barcode) AS latest_barcode FROM dbpis_items";
    $stmt = $db->query($sql);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $latest_barcode = $row['latest_barcode'] ? intval($row['latest_barcode']) + 1 : 1; // Start from 1 if no barcodes exist
    echo json_encode(['latest_barcode' => $latest_barcode]);
} catch (PDOException $e) {
    echo json_encode(['error' => $e->getMessage()]);
}
?>
