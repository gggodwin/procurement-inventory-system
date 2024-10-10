<?php
include '../../../core/dbsys.ini'; // your PDO connection file
include_once '../../../query/system.qry';

$itemId = isset($_GET['id']) ? intval($_GET['id']) : 0;

// Call the delete function defined in system.qry
if ($itemId > 0) {
    $result = delete_item($conn, $itemId); // Call the function

    if ($result) {
        http_response_code(200); // Item deleted successfully
    } else {
        http_response_code(500); // Error occurred
    }
} else {
    http_response_code(400); // Bad request
}
