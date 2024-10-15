<?php
include '../../../core/dbsys.ini'; // PDO connection file

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted data
    $dept_id = $_POST['dept_id'];
    $dept_name = $_POST['dept_name'];
    $dept_group = $_POST['dept_group'];

    // Validate input (add your validation logic here if necessary)

    // Update department information in the database
    $query = "UPDATE dbpis_department SET dept_name = :dept_name, dept_group = :dept_group WHERE dept_id = :dept_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':dept_name', $dept_name);
    $stmt->bindParam(':dept_group', $dept_group);
    $stmt->bindParam(':dept_id', $dept_id, PDO::PARAM_INT);

    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Department updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update department.']);
    }
    exit; // Prevent further execution
}
?>
