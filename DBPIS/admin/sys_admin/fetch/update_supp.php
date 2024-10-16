<?php
include '../../../core/dbsys.ini'; // Include the database connection file

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the posted form data
    $supplier_id = $_POST['supplier_id']; // The hidden field in the update form
    $supplier_name = $_POST['supplier_name'];
    $contact_name = $_POST['contact_name']; // Updated field name
    $contact_phone = $_POST['contact_phone']; // Updated field name
    $contact_email = $_POST['contact_email']; // Updated field name
    $address = $_POST['address']; // Address field added

    // Prepare the update query
    $query = "UPDATE dbpis_supplier 
              SET supplier_name = :supplier_name, 
                  contact_name = :contact_name, 
                  contact_phone = :contact_phone, 
                  contact_email = :contact_email, 
                  address = :address 
              WHERE supplier_id = :supplier_id";
    
    $stmt = $db->prepare($query);
    $stmt->bindParam(':supplier_id', $supplier_id, PDO::PARAM_INT);
    $stmt->bindParam(':supplier_name', $supplier_name, PDO::PARAM_STR);
    $stmt->bindParam(':contact_name', $contact_name, PDO::PARAM_STR); // Binding the contact name parameter
    $stmt->bindParam(':contact_phone', $contact_phone, PDO::PARAM_STR); // Binding the contact phone parameter
    $stmt->bindParam(':contact_email', $contact_email, PDO::PARAM_STR); // Binding the contact email parameter
    $stmt->bindParam(':address', $address, PDO::PARAM_STR); // Binding the address parameter

    // Execute the query and return success or failure
    if ($stmt->execute()) {
        echo json_encode(['success' => true, 'message' => 'Supplier updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to update supplier.']);
    }
}
?>
