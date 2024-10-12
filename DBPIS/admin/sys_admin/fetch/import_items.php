<?php
include '../../../core/dbsys.ini';

try {
    if (isset($_FILES['file'])) {
        $fileName = $_FILES['file']['tmp_name'];

        if ($_FILES['file']['size'] > 0) {
            $file = fopen($fileName, 'r');

            // Skip the header row if it exists
            fgetcsv($file);

            $rowCount = 0; // Counter for inserted/updated rows

            while (($column = fgetcsv($file, 10000, ',')) !== FALSE) {
                // Check if the product already exists by barcode
                $checkQuery = "SELECT COUNT(*) FROM dbpis_items WHERE barcode = :barcode";
                $stmtCheck = $db->prepare($checkQuery);
                $stmtCheck->bindParam(':barcode', $column[0]);
                $stmtCheck->execute();
                $productExists = $stmtCheck->fetchColumn();

                if ($productExists) {
                    // Update the existing product
                    $sqlUpdate = "UPDATE dbpis_items 
                                  SET particular = :particular, brand = :brand, current_stock = :current_stock, 
                                      safety_stock = :safety_stock, units = :units, category = :category 
                                  WHERE barcode = :barcode";

                    $stmt = $db->prepare($sqlUpdate);
                } else {
                    // Insert new product
                    $sqlInsert = "INSERT INTO dbpis_items (barcode, particular, brand, current_stock, safety_stock, units, category) 
                                  VALUES (:barcode, :particular, :brand, :current_stock, :safety_stock, :units, :category)";
                    
                    $stmt = $db->prepare($sqlInsert);
                }

                // Bind CSV data to the placeholders
                $stmt->bindParam(':barcode', $column[0]);
                $stmt->bindParam(':particular', $column[1]);
                $stmt->bindParam(':brand', $column[2]);
                $stmt->bindParam(':current_stock', $column[3]);
                $stmt->bindParam(':safety_stock', $column[4]);
                $stmt->bindParam(':units', $column[5]);
                $stmt->bindParam(':category', $column[6]);

                // Execute and check if the insert or update was successful
                if ($stmt->execute()) {
                    $rowCount++; // Increment row counter for each successful operation
                } else {
                    // Log any failed attempts (for debugging)
                    $errorInfo = $stmt->errorInfo();
                    error_log("Operation failed: " . print_r($errorInfo, true));
                }
            }

            fclose($file);

            if ($rowCount > 0) {
                echo "Data imported successfully! $rowCount rows inserted/updated.";
            } else {
                echo "No data was inserted/updated.";
            }
        } else {
            echo "Invalid file size.";
        }
    } else {
        echo "No file uploaded.";
    }
} catch (Exception $e) {
    // Catch any exceptions and output them for debugging
    echo "Error: " . $e->getMessage();
    error_log("Error: " . $e->getMessage());
}
?>
