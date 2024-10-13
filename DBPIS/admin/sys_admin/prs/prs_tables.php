
<?php include ("prs_modals.php"); ?>
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<!-- Bootstrap Datepicker CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
<!-- jQuery UI JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
<style>
    .low-stock {
    background-color: #f8d7da; /* Light red background */
}
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
                <h2>Purchase Requisitions</h2>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-settings" style="font-size: 24px;"></span>
                    </a>

                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" id="importButton">
                            <i class="mdi mdi-upload"></i> Import
                        </a>
                        <input type="file" id="fileInput" accept=".csv, .xls, .xlsx" style="display: none;" />
                        <a class="dropdown-item" href="#" id="exportButton" onclick="exportTable()">
                            <i class="mdi mdi-download"></i> Export
                        </a>
                        <a class="dropdown-item" href="#" id="printButton" onclick="printTable()">
                            <i class="mdi mdi-printer"></i> Print
                        </a>
                    </div>
                    

                        <div class="dropdown d-inline-block ml-3">
                            <a class="dropdown-toggle" href="#" role="button" id="departmentDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mdi mdi-filter" style="font-size: 24px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="departmentDropdown">
                                <h6 class="dropdown-header">Filter by Department</h6>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" onclick="filterByDepartment('all')">All Departments</a>
                                <a class="dropdown-item" href="#" onclick="filterByDepartment('HR')">HR</a>
                                <a class="dropdown-item" href="#" onclick="filterByDepartment('Finance')">Finance</a>
                                <a class="dropdown-item" href="#" onclick="filterByDepartment('IT')">IT</a>
                                <a class="dropdown-item" href="#" onclick="filterByDepartment('Sales')">Sales</a>
                                <!-- Add more departments as needed -->
                            </div>
                        </div>

                                                <!-- Custom Date Range Filter Dropdown -->
                        <div class="dropdown d-inline-block ml-3">
                            <a class="dropdown-toggle" href="#" role="button" id="dateRangeDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mdi mdi-calendar-search" style="font-size: 24px;"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dateRangeDropdown">
                                <h6 class="dropdown-header">Start Date</h6>
                                    <div class="px-3">
                                        <input type="date" id="startDate" class="form-control" placeholder="Start Date" onchange="filterCustomDateRange()">
                                    </div>
                                <h6 class="dropdown-header">End Date</h6>  
                                    <div class="px-3">
                                        <input type="date" id="endDate" class="form-control" placeholder="End Date" onchange="filterCustomDateRange()">
                                    </div>
                            </div>
                        </div>

                        <div class="dropdown d-inline-block ml-3">
                            <button type="button" data-toggle="modal" data-target="#insertPRModal" style="background: none; border: none; padding: 0;">
                                <span class="mdi mdi-file-plus" style="font-size: 24px; color: green;"></span>
                            </button>
                        </div>

                </div>
            </div>
            <div class="card-body">
                <table id="requisitionsTable" class="table table-hover" style="width:100%">
                    <thead>
                        <tr>
                            <th>PRS Code</th>
                            <th>Requested By</th>
                            <th>Department</th>
                            <th>Date Requested</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="requisitionsTableBody">
                        <!-- Purchase Requisitions data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
// Fetch requisition data and populate the table
function fetchRequisitionData() {
    const table = $('#requisitionsTable').DataTable();
    table.clear();

    fetch('fetch/fetch_prs.php') // Adjust the path if needed
        .then(response => response.json())
        .then(data => {
            data.requisitions.forEach(requisition => {
                let statusClass;
                if (requisition.approval_status === 'Approved') {
                    statusClass = 'text-success';
                } else if (requisition.approval_status === 'Pending') {
                    statusClass = 'text-warning';
                } else if (requisition.approval_status === 'Rejected') {
                    statusClass = 'text-danger';
                } else {
                    statusClass = '';
                }

                table.row.add([
                    requisition.prs_code,
                    requisition.requested_by,
                    requisition.department,
                    requisition.date_requested,
                    `<span class="${statusClass}">${requisition.approval_status}</span>`,
                    `
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                          </button>
                          <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="viewDetails('${requisition.prs_code}')">
                                  <i class="fas fa-eye"></i> View Details
                              </button>
                              <button class="dropdown-item" onclick="deleteRequisition('${requisition.prs_code}')">
                                  <i class="fas fa-trash-alt"></i> Delete
                              </button>
                          </div>
                      </div>
                    `
                ]);
            });

            table.draw();
        })
        .catch(error => console.error('Error fetching requisition data:', error));
}

// Function to delete a requisition
function deleteRequisition(prsCode) {
    if (confirm("Are you sure you want to delete this requisition?")) {
        fetch('fetch/fetch_prs.php', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ prs_code: prsCode }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Requisition deleted successfully!");
                fetchRequisitionData(); // Refresh data after deletion
            } else {
                alert("Failed to delete requisition. Please try again.");
            }
        })
        .catch(error => {
            console.error("Error during fetch:", error);
            alert("An error occurred while deleting the requisition.");
        });
    }
}

// Function to print the table
document.getElementById('printButton').addEventListener('click', function() {
    const printSection = document.getElementById('requisitionsTable').outerHTML; // Change to the correct table ID
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = printSection;

    // Loop through table rows and apply color to the status text based on its value
    tempDiv.querySelectorAll('tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 4) { // Assuming status is in the 5th column
            const statusCell = cells[4]; // Get the status cell
            const statusText = statusCell.innerText.trim(); // Get the status text

            if (statusText === 'Approved') {
                statusCell.style.color = 'green'; // Set text color to green for approved
                statusCell.style.fontWeight = 'bold'; // Optionally make the text bold
            } else if (statusText === 'Pending') {
                statusCell.style.color = 'orange'; // Set text color to orange for pending
                statusCell.style.fontWeight = 'bold'; // Optionally make the text bold
            } else if (statusText === 'Rejected') {
                statusCell.style.color = 'red'; // Set text color to red for rejected
                statusCell.style.fontWeight = 'bold'; // Optionally make the text bold
            }
        }
    });

    // Open new print window and apply styles
    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Requisitions Table</title>
                <style>
                    /* Hide action column */
                    th:nth-child(6), td:nth-child(6) { display: none; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; font-weight: bold; }
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    @media print {
                        th:nth-child(6), td:nth-child(6) { display: none; }
                        td { color: black; } /* Reset any color changes for other cells */
                    }
                </style>
            </head>
            <body>
                <h1>Purchase Requisitions Table</h1>
                ${tempDiv.innerHTML}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
});

// Function to export the table data to CSV
function exportTable() {
    const csv = [];
    const rows = document.querySelectorAll('#requisitionsTable tr');

    for (let i = 0; i < rows.length; i++) {
        const row = [], cols = rows[i].querySelectorAll('td, th');

        for (let j = 0; j < cols.length; j++) {
            let cellValue = cols[j].innerText;
            row.push('"' + cellValue.replace(/"/g, '""') + '"');
        }

        csv.push(row.join(','));
    }

    const csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
    const downloadLink = document.createElement('a');
    downloadLink.download = 'purchase_requisitions.csv';
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
}

$(document).ready(function() {
    // Initialize DataTable with responsiveness and custom search options
    const table = $('#requisitionsTable').DataTable({
        paging: true,
        searching: true,
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
    });

    // Fetch requisition data after initializing the DataTable
    fetchRequisitionData();

    // Import button functionality
    document.getElementById('importButton').addEventListener('click', function() {
        document.getElementById('fileInput').click();
    });

    // Handle CSV file input
    document.getElementById('fileInput').addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
            const validTypes = ['text/csv', 'application/vnd.ms-excel'];
            if (!validTypes.includes(file.type)) {
                alert('Please upload a valid CSV file.');
                return;
            }

            const formData = new FormData();
            formData.append('file', file);

            fetch('fetch/import_items.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                if (data.includes('success')) {
                    alert('Data imported successfully!');
                    fetchRequisitionData(); // Refresh data after import
                } else {
                    alert('Import failed.');
                }
            })
            .catch(error => {
                alert('Error importing file');
                console.error('Fetch error details:', error);
            });
        } else {
            alert('No file selected.');
        }
    });
});

function filterByDepartment(department) {
    const table = $('#requisitionsTable').DataTable();

    // Clear existing filters
    $.fn.dataTable.ext.search.pop();

    // If 'all' is selected, show all records
    if (department === 'all') {
        table.search('').draw();
        return;
    }

    // Add custom search filter based on the selected department
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        // Assuming department is in the third column (index 2)
        return data[2] === department; // Change index based on actual data structure
    });

    table.draw(); // Redraw the table to apply the filter
}

function filterCustomDateRange() {
    const table = $('#requisitionsTable').DataTable();
    const startDate = $('#startDate').val();
    const endDate = $('#endDate').val();

    // Clear existing filters
    $.fn.dataTable.ext.search.pop();

    // If both dates are provided, filter based on the range
    $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        const dateRequested = new Date(data[3]); // Assuming date_requested is in the fourth column (index 3)
        if (startDate && endDate) {
            return dateRequested >= new Date(startDate) && dateRequested <= new Date(endDate);
        }
        return true; // If no dates provided, show all
    });

    table.draw(); // Redraw the table to apply the filter
}

</script>
