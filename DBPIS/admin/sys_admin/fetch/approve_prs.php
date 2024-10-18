<?php
session_start();
include '../../../core/dbsys.ini'; // PDO connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents("php://input"), true);
    $prs_code = $data['prs_code'];
    $approved_by = $_SESSION['name']; // Get the name from the session

    // Update the dbpis_prs table
    $query = "UPDATE dbpis_prs SET approval_status = 'Approved', approved_by = :approved_by WHERE prs_code = :prs_code";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':approved_by', $approved_by, PDO::PARAM_STR);
    $stmt->bindParam(':prs_code', $prs_code, PDO::PARAM_STR);

    if ($stmt->execute()) {
        echo json_encode(['success' => true]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update requisition.']);
    }
}
?>
