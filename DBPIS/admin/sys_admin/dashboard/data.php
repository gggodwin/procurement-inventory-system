
<?php
include_once ("../../core/dbsys.ini");
$query = $db->query("SELECT DISTINCT category FROM dbpis_items");
$categories = $query->fetchAll(PDO::FETCH_COLUMN);
?>

        <div class="content-wrapper">
          <div class="content">

            <div class="row">
              <div class="col-xl-4">
                  <div class="card card-default">
                      <div class="card-header">
                          <h3>SUM OF ITEMS</h3>
                          <div class="sub-title">
                              <span class="mr-1">Total number of Items</span>
                          </div>
                      </div>
                      <div class="card-body">
                          <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                          <div class="d-flex flex-column">
                            <a href="#itemTable" class="h1 text-white mdi mdi-package-variant-closed" id="totalItemsCount" style="text-decoration: none;">0</a>
                        </div>
                          </div>
                      </div>
                  </div>
              </div>


              <div class="col-xl-4">
                  <div class="card card-default">
                      <div class="card-header">
                          <h3>LOW INVENTORY ITEMS</h3>
                          <div class="sub-title">
                              <span class="mr-1">Amount of Low Stock Item</span>
                          </div>
                      </div>
                      <div class="card-body">
                          <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                              <div class="d-flex flex-column">
                                  <a href="#lowItem" class="h1 text-white mdi mdi-package-variant-closed" id="totalLowStock" style="text-decoration: none;"></a>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>


                <div class="col-xl-4">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3>PURCHASE REQUISITION</h3>
                            <div class="sub-title">
                                <span class="mr-1">Total of Pending PRS</span> 
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                                <div class="d-flex flex-column">
                                    <a href="#pendingPRs" class="h1 text-white mdi mdi-package-variant-closed" id="totalPendingPRS" style="text-decoration: none;"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                


            </div>  
            
            <div class="row">
              <div class="col-xl-12">
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>Inventory Report</h2>

                        <div class="dropdown">
                          <a class="dropdown-toggle mdi mdi-filter" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static" style="font-size: 24px;">
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" id="showAllAction">View All</a>
                            <a class="dropdown-item" href="#" id="showLowStock">View Low Stock</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <?php foreach ($categories as $category): ?>
                              <a class="dropdown-item categoryAction" href="#" name="<?php echo htmlspecialchars($category); ?>">
                                View by <?php echo htmlspecialchars($category); ?>
                              </a>
                            <?php endforeach; ?>
                          </div>
                          <button type="button" data-toggle="modal" data-target="#exampleModalForm" style="background: none; border: none; padding: 0;">
                            <span class="mdi mdi-file-plus" style="font-size: 24px; color: green;"></span>
                          </button>
                            <?php
                              include ("modals.php");  
                            ?>
                        </div>

                      </div>
                      <div class="card-body">
                        <div class="chart-wrapper">
                          <div id="mixed-chart-1"></div>
                        </div>
                      </div>
                    </div>
              </div>

              <div class="col-xl-6">
                  <!-- Page Views -->
                  <div id="lowItem">
                      <div class="card card-default" id="page-views">
                          <div class="card-header">
                              <h2>Low Stock Items</h2>
                          </div>
                          <div class="card-body py-0" data-simplebar style="height: 508px;">
                              <table class="table table-borderless table-thead-border">
                                  <thead>
                                      <tr>
                                          <th>Barcode ID</th>
                                          <th class="text-left px-3">Item</th>
                                          <th class="text-left px-3">In Stock and Safety Threshold</th>
                                          <th class="text-right">Action</th>
                                      </tr>
                                  </thead>
                                  <tbody id="lowStockTableBody">
                                      <!-- Low stock items will be appended here -->
                                  </tbody>
                              </table>
                          </div>
                          <div class="card-footer bg-white py-4">
                              <a href="#itemTable" class="text-uppercase">View All Items</a>
                          </div>
                      </div>
                  </div>
              </div>

              
            <div class="col-xl-6">
            <!-- Pending PRs -->
            <div id="pendingPRs">
                <div class="card card-default" id="pending-prs">
                    <div class="card-header">
                        <h2>Pending Purchase Requisitions</h2>
                    </div>
                    <div class="card-body py-0" data-simplebar style="height: 508px;">
                        <table class="table table-borderless table-thead-border">
                            <thead>
                                <tr>
                                    <th>PRS Code</th>
                                    <th class="text-left px-3">Requested By</th>
                                    <th class="text-left px-3">Department</th>
                                    <th class="text-left px-3">Date Requested</th>
                                    <th class="text-left px-3">Action</th>
                                </tr>
                            </thead>
                            <tbody id="pendingPRsTableBody">
                                <!-- Pending PRs will be appended here -->
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer bg-white py-4">
                        <a href="/admin/sys_admin/main_prs.php" class="text-uppercase">View All Requisitions</a>
                    </div>
                </div>
            </div>
        </div>


          </div>
          <div id = "itemTable">
          <?php
              include ("tables.php");   
            ?>
          </div>


        </div>
      </div>              
      
      
        

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
$(document).ready(function() {
    $('#productsTable').DataTable(); // Initialize DataTable on page load

    // Your existing form submission handling
    $('#itemForm').on('submit', function(e) {
        e.preventDefault(); // Prevent default form submission

        $.ajax({
            url: 'fetch/insert_items.php', // Your PHP script for data insertion
            type: 'POST',
            data: $(this).serialize(), // Serialize form data
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    alert(response.message); // Show success message
                    $('#itemForm')[0].reset(); // Reset the form
                    $('#exampleModalForm').modal('hide'); // Hide the modal

                    // Refresh data
                    totalNumberItems();
                    fetchProductData();
                    totalNumberLowStock();
                    fetchData();
                    fetchLowStockItems();
                } else {
                    alert(response.message); // Show error message
                }
            },
            error: function(xhr, status, error) {
                console.error('Error inserting data:', error);
                alert('An error occurred while inserting data. Please try again.'); // Optional error handling
            }
        });
    });
});

$(document).ready(function() {
    $('#exampleModalForm').on('show.bs.modal', function () {
        $.ajax({
            url: 'fetch/fetch_latest_id.php',
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.latest_barcode) {
                    $('#barcode').attr('value', response.latest_barcode); // Set the placeholder with the generated barcode
                } else {
                    alert('Error fetching latest barcode: ' + response.error);
                }
            }
        });
    });
});

// Fetch total number of items
function totalNumberItems(){
fetch('fetch/fetch_items.php')
  .then(response => response.json())
  .then(data => {
    document.querySelector('#totalItemsCount').innerText = data.total_items;
    console.log(data.items);
  })
  .catch(error => console.error('Error fetching data:', error));
}

$(document).ready(function() {
    totalNumberItems(); // Call the function when the page loads
});

// Fetch total number of low stock items
function totalNumberLowStock(){
fetch('fetch/fetch_items.php')
  .then(response => response.json())
  .then(data => {
    document.querySelector('#totalLowStock').innerText = data.total_low_stock_items;
    console.log(data.total_low_stock_items);
  })
  .catch(error => console.error('Error fetching data:', error));
}

$(document).ready(function() {
    totalNumberLowStock(); // Call the function when the page loads
});

function totalNumberPendingPRS() {
    fetch('fetch/fetch_prs.php')
        .then(response => response.json())
        .then(data => {
            document.querySelector('#totalPendingPRS').innerText = data.total_pending_requisitions; // Update total count
            console.log(data.total_pending_requisitions); // Log for debugging
        })
        .catch(error => console.error('Error fetching data:', error));
}

$(document).ready(function() {
    totalNumberPendingPRS(); // Call the function when the page loads
});


// Function to fetch low stock items
function fetchLowStockItems() {
    fetch('fetch/fetch_items.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('lowStockTableBody');
        tableBody.innerHTML = '';
        
        data.low_stock_items.forEach(item => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${item.barcode}</td>
                <td class="text-left px-3">${item.particular} (${item.brand})</td>
               <td class="text-left px-3" style="color: red;">
                    ${item.current_stock} < ${item.safety_stock} ${item.units}
                </td>
                <td class="text-right">
                    <button class="btn btn-primary btn-sm" onclick="viewItemDetails('${item.barcode}')">Update</button>
                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching low stock items:', error));
}


// Function to view item details and open modal
function viewItemDetails(barcode) {
    fetch(`fetch/fetch_items.php?barcode=${barcode}`) // Ensure this endpoint is correct
    .then(response => response.json())
    .then(item => {
        if (item) {
            // Populate modal fields with item details
            document.getElementById('itemBarcode').value = item.barcode; // Set the barcode
            document.getElementById('currentStock').value = item.current_stock; // Set the current stock
            document.getElementById('safetyStock').value = item.safety_stock; // Set the safety stock

            // Show the modal
            $('#updateStockModal').modal('show');
        } else {
            console.error('Item not found.');
        }
    })
    .catch(error => console.error('Error fetching item details:', error));
}

function fetchPendingPRs() {
    fetch('fetch/fetch_prs.php')
    .then(response => response.json())
    .then(data => {
        const tableBody = document.getElementById('pendingPRsTableBody');
        tableBody.innerHTML = '';
        
        // Append pending requisitions to the table
        data.pending_requisitions.forEach(pr => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${pr.prs_code}</td>
                <td class="text-left px-3">${pr.requested_by}</td>
                <td class="text-left px-3">${pr.department}</td>
                <td class="text-left px-3">${new Date(pr.date_requested).toLocaleDateString()}</td>
                <td class="text-left px-3">
                    <button class="btn btn-primary btn-sm" onclick="location.href='/admin/sys_admin/main_prs.php?prs_code=${pr.prs_code}'">View Details</button>

                </td>
            `;
            tableBody.appendChild(row);
        });
    })
    .catch(error => console.error('Error fetching pending PRs:', error));
}

function viewPRDetails(prsCode) {
    // Code to open a modal or display PR details based on the selected PR code
    const prsDetailsFrame = document.getElementById('prsDetailsFrame');
    prsDetailsFrame.src = `prs_invoice.php?prs_code=${prsCode}`;
    const viewDetailsModal = new bootstrap.Modal(document.getElementById('viewDetailsModal'));
    viewDetailsModal.show();
}

document.addEventListener('DOMContentLoaded', () => {
    fetchPendingPRs();
});



// Handle form submission for updating stock
document.getElementById('updateStockForm').addEventListener('submit', function(event) {
    event.preventDefault();

    const formData = new FormData(this);

    fetch('fetch/update_stock.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(result => {
        console.log(result); // Log server response
        if (result.success) {
            alert('Update successful!');
            $('#updateStockModal').modal('hide');
            fetchLowStockItems();
            fetchProductData();
            fetchData();
        } else {
            alert('Update failed: ' + result.message);
        }
    })
    .catch(error => console.error('Error updating item stock:', error));
});

// Fetch low stock items on page load
fetchLowStockItems();


function viewFullItemDetails(barcode) {
    fetch(`fetch/fetch_items.php?barcode=${barcode}`)
        .then(response => response.json())
        .then(item => {
            console.log("Fetched item data:", item); // Check what is fetched
            if (item) {
                // Populate modal fields with item details
                document.getElementById('updateItemBarcode').value = item.barcode; // Set the barcode
                document.getElementById('updateItemParticular').value = item.particular; // Set the particular
                document.getElementById('updateItemBrand').value = item.brand; // Set the brand
                document.getElementById('updateItemCurrentStock').value = item.current_stock; // Set the current stock
                document.getElementById('updateItemSafetyStock').value = item.safety_stock; // Set the safety stock
                document.getElementById('updateItemCategory').value = item.category; // Set the category
                document.getElementById('updateItemUnits').value = item.units;
                // Show the modal
                $('#updateItemDetailsModal').modal('show');
            } else {
                console.error('Item not found.');
            }
        })
        .catch(error => console.error('Error fetching item details:', error));
}


document.getElementById('updateItemDetailsForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission

    const formData = new FormData(this); // Collect form data

    // Send the form data using a fetch POST request
    fetch('fetch/update_item.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json()) // Parse the JSON response
    .then(result => {
        console.log(result); // Log server response

        if (result.success) {
            // Show success alert
            alert('Update successful!');

            // Hide the modal after a successful update
            $('#updateItemDetailsModal').modal('hide');

            // Call the functions to refresh the data on the page
            fetchLowStockItems();
            fetchProductData();
            fetchData();
        } else {
            // Show error alert with the server response message
            alert('Update failed: ' + result.message);
        }
    })
    .catch(error => console.error('Error updating item stock:', error)); // Handle any errors
});




// Function to view item details
function viewItemDetails1(barcode) {
    // Redirect or open a modal to show the item details
    alert('View details for item: ' + barcode);
}

</script>
