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
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalForm">
                            <span class="mdi mdi-file-plus"></span> Insert
                        </a>
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


function deleteItem(barcode, rowElement) {
    if (confirm("Are you sure you want to delete this item?")) {
        console.log("Attempting to delete item with barcode:", barcode);

        const formData = new FormData();
        formData.append('delete', true);
        formData.append('barcode', barcode);

        fetch('fetch/fetch_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Network response was not ok');
            }
            return response.json();
        })
        .then(data => {
            console.log("Server response:", data);

            if (data.success) {
                alert("Item deleted successfully!");
                // Remove the row from DataTable
                const table = $('#productsTable').DataTable();
                table.row($(rowElement).parents('tr')).remove().draw(false); // Remove the row without redrawing the entire table
                fetchLowStockItems();
                fetchData();
                totalNumberLowStock();
                totalNumberItems(); 

            } else {
                alert("Failed to delete the item. Please try again.");
                console.error("Error from server:", data.message);
            }
        })
        .catch(error => {
            console.error("Error during fetch:", error);
            alert("An error occurred while deleting the item.");
        });
    }
}

function fetchProductData() {
    const table = $('#productsTable').DataTable();
    table.clear(); // Clear the existing table data

    fetch('fetch/fetch_items.php') // Adjust the path if needed
        .then(response => response.json())
        .then(data => {
            data.items.forEach(item => {
                // Append the row with a reference to the current row element
                const rowNode = table.row.add([
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
                              <button class="dropdown-item" onclick="viewFullItemDetails(${item.barcode})">
                                  <i class="fas fa-edit"></i> Edit
                              </button>
                              <button class="dropdown-item" onclick="deleteItem(${item.barcode}, this)">
                                  <i class="fas fa-trash-alt"></i> Delete
                              </button>
                          </div>
                      </div>
                    `
                ]).node(); // Capture the row node for later reference

                $(rowNode).attr('id', `item-${item.barcode}`); // Optionally add an ID to the row
            });

            table.draw(); // Redraw the DataTable to display the new data
        })
        .catch(error => console.error('Error fetching product data:', error));
}

$(document).ready(function() {
    $('#productsTable').DataTable({
        paging: true,
        searching: true,
        pageLength: 5,
        lengthMenu: [5, 10, 25, 50, 100],
    });

    fetchProductData();
});



</script>