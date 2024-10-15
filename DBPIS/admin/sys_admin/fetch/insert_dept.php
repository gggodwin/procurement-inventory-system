<?php
include '../../../core/dbsys.ini'; // PDO connection file

// Check if the request is a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $dept_name = $_POST['dept_name'];
    $dept_group = $_POST['dept_group'];

    // Insert the department into the database
    $query = "INSERT INTO dbpis_department (dept_name, dept_group) VALUES (:dept_name, :dept_group)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':dept_name', $dept_name, PDO::PARAM_STR);
    $stmt->bindParam(':dept_group', $dept_group, PDO::PARAM_STR);

    if ($stmt->execute()) {
        // Successful insertion
        echo json_encode(['success' => true, 'message' => 'Department added successfully!']);
    } else {
        // Insertion failed
        echo json_encode(['success' => false, 'message' => 'Failed to add department.']);
    }
    exit; // Exit to prevent executing further code
}
?>
