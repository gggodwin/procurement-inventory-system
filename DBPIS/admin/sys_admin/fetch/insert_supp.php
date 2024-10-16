<?php
include '../../../core/dbsys.ini'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted form data
    $supplier_name = $_POST['supplier_name'];
    $contact_name = $_POST['contact_name']; // Updated field name
    $contact_phone = $_POST['contact_phone']; // Updated field name
    $contact_email = $_POST['contact_email']; // Updated field name
    $address = $_POST['address']; // Address field added

    // Prepare the insert query
    $query = "INSERT INTO dbpis_supplier (supplier_name, contact_name, contact_email, contact_phone, address) 
              VALUES (:supplier_name, :contact_name, :contact_email, :contact_phone, :address)";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':supplier_name', $supplier_name, PDO::PARAM_STR);
    $stmt->bindParam(':contact_name', $contact_name, PDO::PARAM_STR); // Binding the contact name parameter
    $stmt->bindParam(':contact_phone', $contact_phone, PDO::PARAM_STR); // Binding the contact phone parameter
    $stmt->bindParam(':contact_email', $contact_email, PDO::PARAM_STR); // Binding the contact email parameter
    $stmt->bindParam(':address', $address, PDO::PARAM_STR); // Binding the address parameter

    // Execute the query and return success or failure
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Supplier added successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to add supplier.']);
    }
}
?>
