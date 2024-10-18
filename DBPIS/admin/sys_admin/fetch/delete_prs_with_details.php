<?php
include '../../../core/dbsys.ini'; // Include your PDO connection

header('Content-Type: application/json');

try {
    // Get the incoming request body
    $data = json_decode(file_get_contents('php://input'), true);
    $prs_code = $data['prs_code'];

    // Begin a transaction
    $db->beginTransaction();

    // First, delete related PR details
    $sqlDeleteDetails = "DELETE FROM dbpis_prsdetails WHERE prs_code = :prs_code";
    $stmtDetails = $db->prepare($sqlDeleteDetails);
    $stmtDetails->bindParam(':prs_code', $prs_code);
    $stmtDetails->execute();

    // Then, delete the PR record
    $sqlDeletePR = "DELETE FROM dbpis_prs WHERE prs_code = :prs_code";
    $stmtPR = $db->prepare($sqlDeletePR);
    $stmtPR->bindParam(':prs_code', $prs_code);
    $stmtPR->execute();

    // Commit the transaction
    $db->commit();

    // Return success message
    echo json_encode(['success' => true]);

} catch (PDOException $e) {
    // Rollback the transaction if an error occurs
    $db->rollBack();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}
