<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h2>Products Inventory</h2>
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
                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>barcode ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Current Stock</th>
                            <th>Safety Stock</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="productsTableBody">
                        <!-- Product data will be populated here -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
function fetchProductData() {
    const table = $('#productsTable').DataTable(); // Initialize DataTable instance
    table.clear(); // Clear the existing table data

    fetch('fetch/fetch_items.php') // Adjust the path if needed
        .then(response => response.json())
        .then(data => {
            data.items.forEach(item => {
                table.row.add([
                    item.barcode,
                    item.particular,
                    item.brand,
                    item.current_stock,
                    item.safety_stock,
                    item.category,
                    `
                      <div class="btn-group">
                          <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              <i class="fas fa-cog"></i>
                          </button>
                          <div class="dropdown-menu">
                              <button class="dropdown-item" onclick="editItem(${item.id})">
                                  <i class="fas fa-edit"></i> Edit
                              </button>
                              <button class="dropdown-item" onclick="deleteItem(${item.id})">
                                  <i class="fas fa-trash-alt"></i> Delete
                              </button>
                          </div>
                      </div>
                    `
                ]);
            });

            table.draw(); // Redraw the DataTable to display the new data
        })
        .catch(error => console.error('Error fetching product data:', error));
}

$(document).ready(function() {
    // Initialize DataTable
    $('#productsTable').DataTable({
        paging: true,  // Enable pagination
        searching: true, // Enable search functionality
        pageLength: 5, // Default number of records per page
        lengthMenu: [5, 10, 25, 50, 100], // Options for number of records per page
    });

    // Fetch product data after initializing the DataTable
    fetchProductData();
});

</script>