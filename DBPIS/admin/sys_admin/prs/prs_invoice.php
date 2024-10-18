<?php
// Connect to your database (assumed using PDO)
require '../../../core/dbsys.ini'; // Adjust the path as needed

// Fetch PR data based on the passed `prs_code`
if (isset($_GET['prs_code'])) {
    $prs_code = $_GET['prs_code'];

    // Fetch PR details from the `dbpis_prs` table
    $stmt = $db->prepare("SELECT * FROM dbpis_prs WHERE prs_code = :prs_code");
    $stmt->bindParam(':prs_code', $prs_code);
    $stmt->execute();
    $prsData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch PR items from the `dbpis_prsdetails` table
    $stmtItems = $db->prepare("SELECT * FROM dbpis_prsdetails WHERE prs_code = :prs_code");
    $stmtItems->bindParam(':prs_code', $prs_code);
    $stmtItems->execute();
    $prsItems = $stmtItems->fetchAll(PDO::FETCH_ASSOC);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Purchase Requisition Slip</title>
    <style>

.prs-header span, .prs-footer span, span {
    font-weight: bold; /* Highlight spans */
}

.prs-slip {
    width: 100%;
    padding: 20px; /* Increase padding for better spacing */
    box-sizing: border-box;
    font-family: Arial, sans-serif;
}

.prs-slip h1 {
    text-align: center;
    font-size: 24px; /* Increase font size for the title */
}

.prs-header, .prs-footer {
    display: flex;
    justify-content: space-between;
    font-size: 16px; /* Increase font size */
    margin-bottom: 10px; /* Add spacing between sections */
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
}

.prs-header div, .prs-footer div {
    margin-bottom: 10px; /* Add margin between fields */
}

.prs-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 15px;
    font-size: 14px; /* Increase font size for table */
}

.prs-table th, .prs-table td {
    border: 1px solid black;
    padding: 10px; /* Increase padding for table cells */
    text-align: center;
}

.prs-footer {
    margin-top: 15px; /* Add space between table and footer */
    font-size: 16px; /* Increase font size for footer */
}

.prs-footer div {
    width: 20%;
    margin-bottom: 10px; /* Add margin for each footer field */
}

.status-approved {
    color: green; /* Green for approved */
    font-weight: bold; /* Make the text bold */
}

.status-pending {
    color: orange; /* Orange for pending */
    font-weight: bold; /* Make the text bold */
}

.status-rejected {
    color: red; /* Red for rejected */
    font-weight: bold; /* Make the text bold */
}

.status-default {
    color: gray; /* Gray for default/unknown statuses */
    font-weight: bold; /* Make the text bold */
}
    </style>
</head>
<body>
    <div class="prs-slip">
        <h1>PURCHASE REQUISITION SLIP</h1>
        
        <div class="prs-header">
            <div>Requesting Department: <span id="department"><?php echo $prsData['department']; ?></span></div>
            <div>PRS No: <span id="prsNo"><?php echo $prsData['prs_code']; ?></span></div>
        </div>
        
        <div class="prs-header">
            <div>Date Prepared: <span id="datePrepared"><?php echo $prsData['date_requested']; ?></span></div>
            <div>Date Needed: <span id="dateNeeded"><?php echo $prsData['date_needed']; ?></span></div>
        </div>
        
        <div>Purpose: <span id="purpose"><?php echo $prsData['remarks']; ?></span></div>
        
        <table class="prs-table">
    <thead>
        <tr>
            <th>ITEM NO.</th>
            <th>PARTICULARS</th>
            <th>QUANTITY</th>
            <th>UNIT</th>
            <th>SUPPLIER</th>
            <th>UNIT PRICE</th>
            <th>TOTAL PRICE</th>
        </tr>
    </thead>
    <tbody id="prsItems">
    <?php 
    // Assuming $prsItems is an array of items
    $numItems = count($prsItems);
    $maxRows = 5;
    $grandTotal = 0; // Initialize grand total

    // Fill the table with actual items
    foreach ($prsItems as $index => $item): 
        $grandTotal += $item['total_price']; // Add to grand total
    ?>
        <tr>
            <td><?php echo $item['item_code']; ?></td>
            <td><?php echo $item['item_description']; ?></td>
            <td><?php echo $item['quantity']; ?></td>
            <td><?php echo $item['unit_type']; ?></td>
            <td><?php echo $item['supplier']; ?></td>
            <td>₱<?php echo number_format($item['unit_price'], 2); ?></td>
            <td>₱<?php echo number_format($item['total_price'], 2); ?></td>
        </tr>
    <?php endforeach; ?>

    <!-- Fill remaining rows if less than 5 -->
    <?php for ($i = $numItems; $i < $maxRows; $i++): ?>
        <tr>
            <td>&nbsp;</td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    <?php endfor; ?>

    <!-- Display grand total row -->
    <tr>
        <td colspan="6" style="text-align: right; font-weight: bold;">Grand Total:</td>
        <td colspan="2" style="font-weight: bold;">₱<?php echo number_format($grandTotal, 2); ?></td>
    </tr>
</tbody>

</table>
        
        <div class="prs-footer">
            <div>Prepared by: <span id="preparedBy"><?php echo $prsData['requested_by']; ?></span></div>
            <div>Status: <span id="preparedBy" class="<?php echo getStatusClass($prsData['approval_status']); ?>"><?php echo $prsData['approval_status']; ?></span></div>
            <?php
            function getStatusClass($status) {
                switch ($status) {
                    case 'Approved':
                        return 'status-approved';
                    case 'Pending':
                        return 'status-pending';
                    case 'Rejected':
                        return 'status-rejected';
                    default:
                        return 'status-default';
                }
            }
                ?>
            <div>Approved by: <span id="approvedBy"><?php echo !empty($prsData['approved_by']) ? $prsData['approved_by'] : 'Awaiting Approval'; ?></span></div>

            
        </div>
    </div>
</body>
</html>
