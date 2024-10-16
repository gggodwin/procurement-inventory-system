<?php
include '../../../core/dbsys.ini'; // PDO connection file

// Handle DELETE request
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Parse the DELETE request for parameters
    parse_str(file_get_contents("php://input"), $_DELETE); // Parse the input for DELETE request
    if (isset($_DELETE['dept_id'])) {
        $dept_id = $_DELETE['dept_id'];

        // Prepare and execute the delete statement
        $query = "DELETE FROM dbpis_department WHERE dept_id = :dept_id"; // Adjust table name if necessary
        $stmt = $db->prepare($query);
        $stmt->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);
        $result = $stmt->execute();

        // Return success or error message
        if ($result) {
            echo json_encode(['success' => true, 'message' => 'Department deleted successfully.']);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete department.']);
        }
        exit; // Exit after processing the DELETE request
    } else {
        echo json_encode(['success' => false, 'message' => 'Department ID not provided.']);
        exit;
    }
}

// Handle GET request to fetch department details or all departments
if (isset($_GET['dept_id'])) {
    $dept_id = $_GET['dept_id'];

    // Fetch department details by department ID
    $query = "SELECT dept_id, dept_name, dept_group, CreatedAt, UpdatedAt 
              FROM dbpis_department WHERE dept_id = :dept_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);
    $stmt->execute();
    $department = $stmt->fetch(PDO::FETCH_ASSOC);

    // Return department details as JSON
    if ($department) {
        echo json_encode(['department' => $department]);
    } else {
        echo json_encode(['error' => 'Department not found.']);
    }
    exit; // Exit to prevent executing the following code
}

// Fetch all departments
$query = "SELECT dept_id, dept_name, dept_group, CreatedAt, UpdatedAt FROM dbpis_department";
$stmt = $db->prepare($query);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch total count of departments
$queryCount = "SELECT COUNT(*) AS total_departments FROM dbpis_department";
$stmtCount = $db->prepare($queryCount);
$stmtCount->execute();
$countResult = $stmtCount->fetch(PDO::FETCH_ASSOC);
$totalDepartments = $countResult['total_departments'];



// Output data as JSON
echo json_encode([
    'departments' => $departments,
    'total_departments' => $totalDepartments
]);
?>
