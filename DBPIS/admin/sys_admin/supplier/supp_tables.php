<?php include ("supp_modals.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<style>
    .dropdown-toggle::after {
        display: none;
    }
</style>

<span id="showAllAction"></span>
<span id="showLowStock"></span>
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h2>Suppliers</h2>
                <div class="dropdown">
                    <button type="button" data-toggle="modal" data-target="#insertSupplierModal">
                        <span class="mdi mdi-file-plus" style="font-size: 24px; color: green;"></span>
                    </button>
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-settings" style="font-size: 24px;"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#supplierTable" id="importSupplierButton">
                            <i class="mdi mdi-upload"></i> Import Suppliers
                        </a>
                        <input type="file" id="supplierFileInput" accept=".csv, .xls, .xlsx" style="display: none;" />
                        <a class="dropdown-item" href="#" id="exportSupplierButton">
                            <i class="mdi mdi-download"></i> Export Suppliers
                        </a>
                        <a class="dropdown-item" href="#suppliersTable" id="printSupplierButton">
                            <i class="mdi mdi-printer"></i> Print Suppliers
                        </a>
                    </div>

                </div>
            </div>
            <div class="card-body">
                <table id="suppliersTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>Supplier ID</th>
                            <th>Supplier Name</th>
                            <th>Contact Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Address</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="suppliersTableBody">
                        <!-- Supplier data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#suppliersTable').DataTable(); // Initialize DataTable
        fetchSupplierData(); // Fetch and populate data
    });

    function fetchSupplierData() {
        const table = $('#suppliersTable').DataTable();
        table.clear();

        fetch('fetch/fetch_supp.php')
            .then(response => response.json())
            .then(data => {
                console.log(data); // Check the data structure
                if (data.error) {
                    console.error(data.error);
                    return;
                }

                data.suppliers.forEach(supplier => {
                    table.row.add([
                        supplier.supplier_id,
                        supplier.supplier_name,
                        supplier.contact_name,
                        supplier.contact_email,
                        supplier.contact_phone,
                        supplier.address,
                        `
                        <div class="btn-group">
                            <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-cog"></i>
                            </button>
                            <div class="dropdown-menu">
                                <button class="dropdown-item" onclick="openUpdateSupplierModal('${supplier.supplier_id}', '${supplier.supplier_name}', '${supplier.contact_name}', '${supplier.contact_email}', '${supplier.contact_phone}', '${supplier.address}')">
                                    <i class="fas fa-edit"></i> Update
                                </button>

                                <button class="dropdown-item" onclick="deleteSupplier('${supplier.supplier_id}')">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </div>
                        </div>
                        `
                    ]);
                });

                table.draw();
            })
            .catch(error => console.error('Error fetching supplier data:', error));
    }

    function deleteSupplier(supplierId) {
        if (confirm('Are you sure you want to delete this supplier?')) {
            $.ajax({
                url: 'fetch/fetch_supp.php', // Path to your delete PHP file
                type: 'DELETE',
                data: { supplier_id: supplierId }, // Send the supplier ID to be deleted
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        fetchSupplierData(); // Refresh the table data
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred: ' + error);
                }
            });
        }
    }

    function openUpdateSupplierModal(supplierId, supplierName, contactName, contactEmail, contactPhone, address) {
        console.log('Supplier ID:', supplierId, 'Supplier Name:', supplierName, 'Contact Name:', contactName, 'add:',address); // Debugging line
        // Set the values in the modal fields
        $('#updateSupplierId').val(supplierId); // Set the hidden input
        $('#updateSupplierName').val(supplierName); // Set the supplier name
        $('#updateContactName').val(contactName); // Set the contact name
        $('#updateContactEmail').val(contactEmail); // Set the email
        $('#updateContactPhone').val(contactPhone); // Set the phone number
        $('#updateSupplierAddress').val(address); // Set the address

        // Show the modal
        $('#updateSupplierModal').modal('show');
    }

    document.getElementById('printSupplierButton').addEventListener('click', function() {
    const printSection = document.getElementById('suppliersTable').outerHTML;
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = printSection;

    // Highlight rows with missing contact phone if applicable
    tempDiv.querySelectorAll('tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 4) { // Assuming there are enough columns
            const contactPhone = cells[3].innerText; // Adjust based on the table structure
            if (!contactPhone) { // Check if contact phone is missing
                row.style.backgroundColor = 'lightcoral';
                row.classList.add('missing-contact-row');
            }
        }
    });

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Suppliers Table</title>
                <style>
                    th:last-child, td:last-child { display: none; } /* Hiding the action column */
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; font-weight: bold; }
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    @media print {
                        th:last-child, td:last-child { display: none; } /* Hiding the action column */
                        .missing-contact-row { background-color: lightcoral !important; }
                    }
                </style>
            </head>
            <body>
                <h1>Suppliers Table</h1>
                ${tempDiv.innerHTML}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
});


document.getElementById('exportSupplierButton').addEventListener('click', function() {
    var csv = [];
    var rows = document.querySelectorAll('#suppliersTable tr');

    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');

        for (var j = 0; j < cols.length; j++) {
            let cellValue = cols[j].innerText;

            // For the first column (assuming it's supplier ID or similar), just export it as a number without any special formatting
            if (j === 0) {
                cellValue = cellValue.replace(/\s+/g, ''); // Remove spaces
            }

            // Escape double quotes in all other cells
            row.push('"' + cellValue.replace(/"/g, '""') + '"');
        }

        csv.push(row.join(','));
    }

    // Join all rows with newline characters
    var csvContent = csv.join('\n') + '\n'; // Add a newline to the end

    // Create the CSV file and download link
    var csvFile = new Blob([csvContent], { type: 'text/csv' });
    var downloadLink = document.createElement('a');
    downloadLink.download = 'suppliers_inventory.csv';
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
});
</script>
