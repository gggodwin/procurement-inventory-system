<div class="row mt-4">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h2>Purchase Requisition Details</h2>
                <div class="dropdown">
                <div class="dropdown d-inline-block ml-3">
                <a class="dropdown-item" href="#" role="button" id="printDetails"  onclick="printDetailsTable()">
                            <span class="mdi mdi-printer" style="font-size: 24px;"></span>
                        </a>
                </div>
                </div>
            </div>
            <div class="card-body">
                <table id="purchaseRequisitionsDetailsTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>PRS Code</th>
                            <th>Item Code</th>
                            <th>Item Description</th>
                            <th>Quantity</th>
                            <th>Unit Price</th>
                            <th>Total Price</th>
                            <th>Requested Date</th>
                            <th>Unit Type</th>
                            <th>Supplier Name</th>
                        </tr>
                    </thead>
                    <tbody id="purchaseRequisitionsDetailsTableBody">
                        <!-- PRS Details data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('#purchaseRequisitionsDetailsTable').DataTable(); // Initialize DataTable
    fetchPurchaseRequisitionDetails(); // Fetch and populate data
});

function fetchPurchaseRequisitionDetails() {
    const table = $('#purchaseRequisitionsDetailsTable').DataTable();
    table.clear();

    fetch('fetch/fetch_prs_details.php')
        .then(response => response.json())
        .then(data => {
            console.log(data); // Log the entire response

            // Check if 'details' is present and is an array
            if (!data.details || !Array.isArray(data.details)) {
                console.error('Expected an array for details but received:', data.details);
                return;
            }

            // Access the details array and populate the table
            data.details.forEach(detail => {
                table.row.add([
                    detail.prs_code,
                    detail.item_code,
                    detail.item_description,
                    detail.quantity,
                    detail.unit_price,
                    detail.total_price,
                    detail.requested_date,
                    detail.unit_type,
                    detail.supplier_name // Ensure this matches your PHP output
                ]);
            });

            table.draw();
        })
        .catch(error => console.error('Error fetching requisition details:', error));
}




    function printDetailsTable() {
    const printSection = document.getElementById('purchaseRequisitionsDetailsTable').outerHTML; // Change to the correct table ID
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = printSection;

    // Apply formatting to the printed table
    tempDiv.querySelectorAll('tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 0) { // If the row has cells, apply formatting
            // Example: No specific formatting for PR details status, but you can adjust as needed
        }
    });

    // Open new print window and apply styles
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Purchase Requisition Details Table</title>
                <style>
                    /* Hide columns as necessary (optional) */
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; font-weight: bold; }
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    @media print {
                        td { color: black; } /* Reset any color changes for other cells */
                    }
                </style>
            </head>
            <body>
                <h1>Purchase Requisition Details Table</h1>
                ${tempDiv.innerHTML}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
}

</script>
