<?php
session_start(); // Start the session

// Destroy the session
session_unset(); // Unset all session variables
session_destroy(); // Destroy the session

// Return a JSON response
echo json_encode(['success' => true]);
?>
