<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h2>Purchase Requisitions</h2>
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Action
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" id="importButton">
                            <i class="mdi mdi-upload"></i> Import
                        </a>
                        <a class="dropdown-item" href="#" id="exportButton">
                            <i class="mdi mdi-download"></i> Export
                        </a>
                        <a class="dropdown-item" href="#" id="printButton">
                            <i class="mdi mdi-printer"></i> Print
                        </a>
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
                            <th>Total Amount</th>
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
function fetchRequisitionData() {
    const table = $('#requisitionsTable').DataTable(); // Initialize DataTable instance
    table.clear(); // Clear the existing table data

    fetch('fetch/fetch_prs.php') // Adjust the path if needed
        .then(response => response.json())
        .then(data => {
            data.requisitions.forEach(requisition => {
                // Determine the class based on approval_status
                let statusClass;
                if (requisition.approval_status === 'Approved') {
                    statusClass = 'text-success'; // Green text for approved
                } else if (requisition.approval_status === 'Pending') {
                    statusClass = 'text-warning'; // Orange text for pending
                } else if (requisition.approval_status === 'Rejected') {
                    statusClass = 'text-danger'; // Red text for rejected
                } else {
                    statusClass = ''; // Default or no class
                }

                table.row.add([
                    requisition.prs_code,
                    requisition.requested_by,
                    requisition.department,
                    requisition.date_requested,
                    `<span class="${statusClass}">${requisition.approval_status}</span>`, // Conditional styling here
                    requisition.total_amount,
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

            table.draw(); // Redraw the DataTable to display the new data
        })
        .catch(error => console.error('Error fetching requisition data:', error));
}

$(document).ready(function() {
    // Initialize DataTable
    $('#requisitionsTable').DataTable({
        paging: true,  // Enable pagination
        searching: true, // Enable search functionality
        pageLength: 5, // Default number of records per page
        lengthMenu: [5, 10, 25, 50, 100], // Options for number of records per page
    });

    // Fetch requisition data after initializing the DataTable
    fetchRequisitionData();
});

// Function to handle viewing details of a specific requisition
function viewDetails(prs_code) {
    fetch('fetch/fetch_prs.php?prs_code=' + prs_code)
        .then(response => response.json())
        .then(data => {
            if (data.requisition) {
                // Display requisition details and items in a modal or on the page
                console.log('Requisition Details:', data.requisition);
                console.log('Item Details:', data.items);
                alert('Viewing details for PRS Code: ' + prs_code);
                // You can expand this to show a modal with detailed information
            } else {
                alert('Requisition not found.');
            }
        })
        .catch(error => console.error('Error fetching requisition details:', error));
}

// Function to handle deletion of a requisition
function deleteRequisition(prs_code) {
    if (confirm('Are you sure you want to delete PRS Code: ' + prs_code + '?')) {
        // Perform the deletion logic here, such as sending an AJAX request to delete the record
        alert('Deleted PRS Code: ' + prs_code);
    }
}
</script>
