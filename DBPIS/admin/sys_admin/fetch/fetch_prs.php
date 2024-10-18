<?php
include '../../../core/dbsys.ini'; // PDO connection file

// If a specific PRS code is requested
if (isset($_GET['prs_code'])) {
    $prs_code = $_GET['prs_code'];
    
    // Fetch purchase requisition details by PRS code
    $query = "SELECT prs_code, requested_by, department, date_requested, date_needed, approval_status, approved_by, remarks 
              FROM dbpis_prs WHERE prs_code = :prs_code"; // Added approved_by here
    $stmt = $db->prepare($query);
    $stmt->bindParam(':prs_code', $prs_code, PDO::PARAM_STR);
    $stmt->execute();
    $requisition = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch the items related to this requisition
    if ($requisition) {
        $queryDetails = "SELECT item_code, item_description, quantity, unit_price, total_price ,unit_type
                         FROM dbpis_prsdetails WHERE prs_code = :prs_code";
        $stmtDetails = $db->prepare($queryDetails);
        $stmtDetails->bindParam(':prs_code', $prs_code, PDO::PARAM_STR);
        $stmtDetails->execute();
        $items = $stmtDetails->fetchAll(PDO::FETCH_ASSOC);

        // Return requisition and item details as JSON
        echo json_encode([
            'requisition' => $requisition,
            'items' => $items
        ]);
    } else {
        echo json_encode(['error' => 'Requisition not found.']);
    }
    exit; // Exit to prevent executing the following code
}

// Fetch all requisitions
$query = "SELECT prs_code, requested_by, department, date_requested, approval_status, approved_by FROM dbpis_prs"; // Added approved_by here
$stmt = $db->prepare($query);
$stmt->execute();
$requisitions = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Prepare data with conditional approved_by
foreach ($requisitions as &$requisition) {
    if ($requisition['approval_status'] === 'Pending') {
        $requisition['approved_by'] = 'Awaiting approval'; // Change approved_by to "Not Yet Accepted"
    }
}

// Fetch total count of requisitions
$queryCount = "SELECT COUNT(*) AS total_requisitions FROM dbpis_prs";
$stmtCount = $db->prepare($queryCount);
$stmtCount->execute();
$countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
$totalRequisitions = $countResult['total_requisitions'];

// Fetch all requisitions with pending status
$queryPending = "SELECT prs_code, requested_by, department, date_requested, approval_status, approved_by 
                 FROM dbpis_prs WHERE approval_status = 'Pending'"; // Added approved_by here
$stmtPending = $db->prepare($queryPending);
$stmtPending->execute();
$pendingRequisitions = $stmtPending->fetchAll(PDO::FETCH_ASSOC);

// Get count of pending requisitions
$queryPendingCount = "SELECT COUNT(*) AS pending_requisitions FROM dbpis_prs WHERE approval_status = 'Pending'";
$stmtPendingCount = $db->prepare($queryPendingCount);
$stmtPendingCount->execute();
$pendingCountResult = $stmtPendingCount->fetch(PDO::FETCH_ASSOC);
$totalPendingRequisitions = $pendingCountResult['pending_requisitions'];

// Output data as JSON
echo json_encode([
    'requisitions' => $requisitions,
    'total_requisitions' => $totalRequisitions,
    'pending_requisitions' => $pendingRequisitions,
    'total_pending_requisitions' => $totalPendingRequisitions
]);
?>
