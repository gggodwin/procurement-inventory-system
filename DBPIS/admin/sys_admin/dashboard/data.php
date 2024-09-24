
<?php
include_once ("../../core/dbsys.ini");
$query = $db->query("SELECT DISTINCT category FROM dbpis_items");
$categories = $query->fetchAll(PDO::FETCH_COLUMN);
?>

        <div class="content-wrapper">
          <div class="content">

            <div class="row">
                <div class="col-xl-3">
                <div class="card card-default">
                  <div class="card-header">
                    <h3>SUM OF ITEMS </h3>
                        <div class="sub-title">
                            <span class="mr-1">Total number of Items</span> 
                        </div>
                  </div>
                  <div class="card-body">
                    <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                      <div class="d-flex flex-column">
                      <span class="h1 text-white mdi mdi-package-variant-closed" id="totalItemsCount">| 325,980</span>
                      </div>
                    </div>
                  </div>
                </div>
                </div>

                <div class="col-xl-3">
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
                      <span class="h1 text-white mdi mdi-package-variant-closed" id="totalLowStock">0</span>
                      </div>
                    </div>
                  </div>
                </div>
                </div>
            </div>  
            
            <div class="row">
              <div class="col-xl-8">
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>Inventory Report</h2>

                        <div class="dropdown">
                          <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" id="showAllAction">Show All</a>
                            <a class="dropdown-item" href="#" id="showLowStock">Show Low Stock</a>
                            <div class="dropdown-divider"></div>
                            <div class="dropdown-divider"></div>
                            <?php foreach ($categories as $category): ?>
                              <a class="dropdown-item categoryAction" href="#" name="<?php echo htmlspecialchars($category); ?>">
                                Show only <?php echo htmlspecialchars($category); ?>
                              </a>
                            <?php endforeach; ?>
                          </div>
                          <button type="button" data-toggle="modal" data-target="#exampleModalForm" style="background: none; border: none; padding: 0;">
                            <span class="mdi mdi-plus-box-outline" style="font-size: 24px; color: green;"></span>
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

              <div class="col-xl-4">
                    
                    <!-- Page Views  -->
                    <div class="card card-default" id="page-views">
                      <div class="card-header">
                        <h2>Low Stock Items</h2>
                      </div>
                      <div class="card-body py-0" data-simplebar style="height: 508px;">
                        <table class="table table-borderless table-thead-border">
                          <thead>
                            <tr>
                              <th>Barcode ID</th>
                              <th class="text-right px-3">Particular</th>
                              <th class="text-right">Action</th>
                            </tr>
                          </thead>
                            <tbody id="lowStockTableBody">
                              <!-- Low stock items will be appended here -->
                            </tbody>
                        </table>
                      </div>
                      <div class="card-footer bg-white py-4">
                        <a href="#" class="text-uppercase">Audience Overview</a>
                      </div>
                    </div>

              </div>
          </div>
          <?php
              include ("tables.php");   
            ?>

        </div>
      </div>                       
        

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
 $(document).ready(function() {
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

                    // Fetch updated data for the chart
                    fetchLowStockItems();
                    fetchData(); // Call the fetchData function to refresh the chart
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

// Total no of Items
fetch('fetch/fetch_items.php')
  .then(response => response.json())
  .then(data => {
    // Update the total number of items in the card's <h2> tag
    document.querySelector('#totalItemsCount').innerText = data.total_items;

    // Optionally, process the item data (data.items) as needed
    console.log(data.items);
  })
  .catch(error => console.error('Error fetching data:', error));

// Total no of Items with lesser current to safety stock
fetch('fetch/fetch_items.php')
  .then(response => response.json())
  .then(data => {
    // Update the total number of items in the card's <h2> tag
    document.querySelector('#totalLowStock').innerText = data.total_low_stock_items;

    // Optionally, process the item data (data.items) as needed
    console.log(data.total_low_stock_items);
  })
  .catch(error => console.error('Error fetching data:', error));


    // Function to fetch low stock items
    function fetchLowStockItems() {
        fetch('fetch/fetch_items.php') // This PHP file should return the low stock items in JSON format
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('lowStockTableBody');
            tableBody.innerHTML = ''; // Clear previous data
            
            data.low_stock_items.forEach(item => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td>${item.barcode}</td>
                    <td class="text-right px-3">${item.particular} (${item.brand})</td>
                    <td class="text-right">
                      <button class="btn btn-primary btn-sm" onclick="viewItemDetails('${item.barcode}')">View</button>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching low stock items:', error));
    }

    // Fetch low stock items on page load
    fetchLowStockItems();


        // Function to fetch product data
        function fetchProductData() {
        fetch('fetch/fetch_items.php') // Adjust the path if needed
        .then(response => response.json())
        .then(data => {
            const tableBody = document.querySelector('#productsTable tbody');
            tableBody.innerHTML = ''; // Clear previous data
            
            data.items.forEach(item => {
                const row = document.createElement('tr');
                
                row.innerHTML = `
                    <td></td>
                    <td>${item.particular}</td>
                    <td>${item.brand}</td>
                    <td>${item.current_stock}</td>
                    <td>${item.safety_stock}</td>
                    <td>${item.category}</td>
                    <td>
                      <button class="btn btn-info btn-sm">Edit</button>
                      <button class="btn btn-danger btn-sm">Delete</button>
                    </td>
                `;
                
                tableBody.appendChild(row);
            });
        })
        .catch(error => console.error('Error fetching product data:', error));
    }

    // Fetch product data on page load
    fetchProductData();


// Function to view item details
function viewItemDetails(barcode) {
    // Redirect or open a modal to show the item details
    alert('View details for item: ' + barcode);
}

</script>
