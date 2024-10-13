<!-- Include DataTables CSS and JS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.0/dist/JsBarcode.all.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<style>
    .low-stock {
    background-color: #f8d7da; /* Light red background */
}
    .dropdown-toggle::after {
    display: none;
}


</style>
<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header">
                <h2>Items Inventory</h2>
                
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="mdi mdi-settings" style="font-size: 24px;"></span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalForm">
                            <span class="mdi mdi-file-plus"></span> Insert
                        </a>
                        <a class="dropdown-item" href="#itemTable" id="importButton">
                            <i class="mdi mdi-upload"></i> Import
                        </a>
                        <input type="file" id="fileInput" accept=".csv, .xls, .xlsx" style="display: none;" />
                        <a class="dropdown-item" href="#" id="exportButton">
                            <i class="mdi mdi-download"></i> Export
                        </a>
                        <a class="dropdown-item" href="#itemTable" id="printButton">
                            <i class="mdi mdi-printer"></i> Print
                        </a>
                    </div>
                                    <!-- Category Filter Icon -->
                    <div class="dropdown d-inline-block ml-3">
                        <a class="dropdown-toggle" href="#" role="button" id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mdi mdi-filter" style="font-size: 24px;"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="categoryDropdown">
                            <?php foreach ($categories as $category): ?>
                                <a class="dropdown-item filterAction" href="#itemTable" data-category="<?php echo htmlspecialchars($category); ?>">
                                    Filter by <?php echo htmlspecialchars($category); ?>
                                </a>
                            <?php endforeach; ?>
                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item filterAction" href="#itemTable" data-category="">
                                View All Categories
                            </a>
                            <a class="dropdown-item filterAction" href="#itemTable" data-category="low_stock">
                                View Low Stock
                            </a>
                        </div>

                    </div>
                </div>

            </div>
            <div class="card-body">
                <table id="productsTable" class="table table-hover table-product" style="width:100%">
                    <thead>
                        <tr>
                            <th>Barcode ID</th>
                            <th>Product Name</th>
                            <th>Brand</th>
                            <th>Current Stock</th>
                            <th>Safety Stock</th>
                            <th>Units</th>
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
                // Determine the class to apply for low stock
                const lowStockClass = item.current_stock < item.safety_stock ? 'low-stock' : '';

                // Append the row with a reference to the current row element
                const rowNode = table.row.add([
                    item.barcode,
                    item.particular,
                    item.brand,
                    item.current_stock,
                    item.safety_stock,
                    item.units,
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
                              <button class="dropdown-item" onclick="generateBarcode(${item.barcode})">
                                  <i class="fas fa-barcode"></i> Generate Barcode
                              </button>
                          </div>
                      </div>
                    `
                ]).node(); // Capture the row node for later reference

                // Add a class for low stock highlighting
                if (lowStockClass) {
                    $(rowNode).addClass(lowStockClass); // Add the low stock class
                }

                $(rowNode).attr('id', `item-${item.barcode}`); // Optionally add an ID to the row
            });

            table.draw(); // Redraw the DataTable to display the new data
        })
        .catch(error => console.error('Error fetching product data:', error));
}


$(document).ready(function() {
    var table = $('#productsTable').DataTable({
        paging: true,
        searching: true,
        pageLength: 5,
        lengthMenu: [[5, 10, 25, -1], [5, 10, 25, "All"]],
    });

    // Event delegation for category filtering
    $('.dropdown-menu').on('click', '.categoryAction', function(e) {
        e.preventDefault(); // Prevent the default link behavior
        var selectedCategory = $(this).data('category'); // Get the category from data attribute
        
        // Filter the DataTable based on the selected category
        if (selectedCategory) {
            // Assuming category is in the seventh column (index 6)
            table.column(6).search('^' + selectedCategory + '$', true, false).draw();
        } else {
            // Show all categories
            table.column(6).search('').draw();
        }
    });

    fetchProductData(); // Load the product data
});

document.getElementById('printButton').addEventListener('click', function() {
    const printSection = document.getElementById('productsTable').outerHTML;
    const tempDiv = document.createElement('div');
    tempDiv.innerHTML = printSection;

    tempDiv.querySelectorAll('tr').forEach(row => {
        const cells = row.querySelectorAll('td');
        if (cells.length > 4) {
            const currentStock = parseInt(cells[3].innerText) || 0;
            const safetyStock = parseInt(cells[4].innerText) || 0;
            if (currentStock < safetyStock) {
                row.style.backgroundColor = 'lightcoral';
                row.classList.add('low-stock-row');
            }
        }
    });

    const printWindow = window.open('', '', 'height=600,width=800');
    printWindow.document.write(`
        <html>
            <head>
                <title>Print Products Table</title>
                <style>
                    th:nth-child(8), td:nth-child(8) { display: none; }
                    table { width: 100%; border-collapse: collapse; }
                    th, td { border: 1px solid #000; padding: 8px; text-align: left; }
                    th { background-color: #f2f2f2; font-weight: bold; }
                    body { font-family: Arial, sans-serif; margin: 20px; }
                    @media print {
                        th:nth-child(7), td:nth-child(7) { display: none; }
                        .low-stock-row { background-color: lightcoral !important; }
                    }
                </style>
            </head>
            <body>
                <h1>Products Table</h1>
                ${tempDiv.innerHTML}
            </body>
        </html>
    `);
    printWindow.document.close();
    printWindow.print();
});

document.getElementById('exportButton').addEventListener('click', function() {
    var csv = [];
    var rows = document.querySelectorAll('#productsTable tr');
    
    for (var i = 0; i < rows.length; i++) {
        var row = [], cols = rows[i].querySelectorAll('td, th');
        
        for (var j = 0; j < cols.length; j++) {
            let cellValue = cols[j].innerText;

            // Check if it's the first column (Barcode ID), prepend tab to treat as text in CSV
            if (j === 0) {
                cellValue = '\t' + cellValue; // Prepend a tab for large number handling
            }

            row.push('"' + cellValue.replace(/"/g, '""') + '"');
        }
        
        csv.push(row.join(','));
    }

    var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
    var downloadLink = document.createElement('a');
    downloadLink.download = 'products_inventory.csv';
    downloadLink.href = window.URL.createObjectURL(csvFile);
    downloadLink.style.display = 'none';
    document.body.appendChild(downloadLink);
    downloadLink.click();
    document.body.removeChild(downloadLink);
});


document.getElementById('importButton').addEventListener('click', function () {
    document.getElementById('fileInput').click();
});

document.getElementById('fileInput').addEventListener('change', function () {
    let file = this.files[0];

    if (file) {
        let validTypes = ['text/csv', 'application/vnd.ms-excel'];
        if (!validTypes.includes(file.type)) {
            alert('Please upload a valid CSV file.');
            return;
        }

        let formData = new FormData();
        formData.append('file', file);

        fetch('fetch/import_items.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            console.log('Server response:', data); // Debugging: log the raw response

            if (data.includes('success')) {
                alert('Data imported successfully!');
                fetchProductData();
                fetchLowStockItems();
                fetchData();
                totalNumberLowStock();
                totalNumberItems(); 
            } else {
                alert('Import failed.');
                console.error('Import error details:', data); // Display error details
            }
        })
        .catch(error => {
            alert('Error importing file');
            console.error('Fetch error details:', error); // Detailed fetch error
        });
    } else {
        alert('No file selected.');
    }
});

$(document).ready(function() {
    // Initialize DataTables
    const table = $('#productsTable').DataTable();

    // Function to fetch products and update the table
    function fetchProducts(category = '') {
        $.ajax({
            url: 'fetch/fetch_items.php', // Your PHP script to fetch items
            type: 'GET',
            data: { category: category },
            dataType: 'json',
            success: function(data) {
                // Clear existing data from the DataTable
                table.clear();

                // Check if data is not empty
                if (data.length > 0) {
                    // Loop through the data and add new rows to the DataTable
                    data.forEach(item => {
                        table.row.add([
                            item.barcode,
                            item.particular,
                            item.brand,
                            item.current_stock,
                            item.safety_stock,
                            item.units,
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
                              <button class="dropdown-item" onclick="generateBarcode(${item.barcode})">
                                  <i class="fas fa-barcode"></i> Generate Barcode
                              </button>
                          </div>
                      </div>
                            `
                        ]);
                    });
                } else {
                    // Optionally, show a message if no items found
                    table.row.add(['No items found for this filter.', '', '', '', '', '', '', '']).draw();
                }

                // Draw the table to update the display
                table.draw();
            },
            error: function(xhr, status, error) {
                console.error('Error fetching items:', error);
            }
        });
    }

    // Event handler for filter action
    $('.filterAction').on('click', function() {
        const selectedCategory = $(this).data('category');
        fetchProducts(selectedCategory === 'low_stock' ? 'low_stock' : selectedCategory); // Fetch products based on selected category
    });

    // Fetch all products on page load
    //fetchProducts();
});

function generateBarcode(barcode) {
    // Get the canvas element
    const canvas = document.getElementById('barcodeCanvas');

    // Generate the barcode using JsBarcode on the canvas
    JsBarcode(canvas, barcode, {
        format: "CODE128", // Set to CODE128
        lineColor: "#242f3f",
        width: 4,
        height: 40,
        displayValue: true
    });

    // Show the modal
    $('#barcodeModal').modal('show');

    // Set up download functionality
    document.getElementById('downloadBarcodeBtn').onclick = function () {
        // Trigger a download
        const link = document.createElement('a');
        link.href = canvas.toDataURL("image/png");
        link.download = `barcode_${barcode}.png`;
        link.click();
    };
}


</script>