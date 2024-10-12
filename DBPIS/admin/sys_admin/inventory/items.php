<?php
include_once ("../../core/dbsys.ini");
$query = $db->query("SELECT DISTINCT category FROM dbpis_items");
$categories = $query->fetchAll(PDO::FETCH_COLUMN);
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/quagga/0.12.1/quagga.min.js"></script>
<style>
    .viewport {
        width: 1000px; /* Default width for larger screens */
        height: 150px; /* Default height for larger screens */
        border: 1px solid #ccc;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }
    #interactive video {
        width: 100%; /* Make the video fill the width */
        height: auto; /* Maintain the aspect ratio */
        object-fit: cover; /* Ensures the video fills the container */
    }

    /* Media query for tablets and smaller screens */
    @media (max-width: 768px) {
        .viewport {
            width: 500px; /* Adjust width for tablets */
            height: 150px; /* Adjust height for tablets */
        }
    }

    @media (max-width: 1600px) {
        .viewport {
            width: 800px; /* Adjust width for tablets */
            height: 150px; /* Adjust height for tablets */
        }
    }

    /* Media query for mobile devices */
    @media (max-width: 480px) {
        .viewport {
            width: 300px; /* Adjust width for mobile phones */
            height: 200px; /* Adjust height for mobile phones */
        }
    }
</style>

<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-default">
                    <div class="card-header">
                        <h3>Scan Barcode</h3>
                    </div>
                    <div class="card-body">
                        <div id="interactive" class="viewport"></div>
                        <button id="startScanner" class="btn btn-primary mt-3">Start Scanning</button>
                    </div>
                </div>
            </div>
           
              <div class="col-xl-4">
                <div class="card card-default" style="width: 100%; max-width: 500px; height: 332px;">
                      <div class="card-header">
                          <h3>SUM OF ITEMS</h3>
                          <div class="sub-title">
                              <span class="mr-1">Total number of Items</span>
                          </div>
                      </div>
                      <div class="card-body" >
                          <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
                              <div class="d-flex flex-column">
                                  <a href="#itemTable" class="h1 text-white mdi mdi-package-variant-closed" id="totalItemsCount" style="text-decoration: none;"></a>
                              </div>
                          </div>
                      </div>
                  </div>
        </div>

        <!-- Modal for displaying item details -->
        <div class="modal fade" id="itemDetailsModal" tabindex="-1" role="dialog" aria-labelledby="itemDetailsModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="itemDetailsModalLabel">Item Details</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p><strong>Barcode:</strong> <span id="itemBarcode"></span></p>
                        <p><strong>Particular:</strong> <span id="itemParticular"></span></p>
                        <p><strong>Brand:</strong> <span id="itemBrand"></span></p>
                        <p><strong>Current Stock:</strong> <span id="currentStock"></span></p>
                        <p><strong>Safety Stock:</strong> <span id="safetyStock"></span></p>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div id = "itemTable">
          <?php
              include ("dashboard/tables.php");   
            ?>
          </div>
</div>
<script>
// Start the QuaggaJS camera scanning
document.getElementById('startScanner').addEventListener('click', function() {
    // Initialize QuaggaJS with wide aspect ratio
    Quagga.init({
        inputStream: {
            name: "Live",
            type: "LiveStream",
            target: document.querySelector('#interactive'), // Target the video element
            constraints: {
                facingMode: "environment", // Use the rear camera
                width: { ideal: 800 }, // Set a wider width
                height: { ideal: 200 } // Set a smaller height for a barcode reader effect
            },
        },
        locator: {
            patchSize: "medium", // You can use 'small', 'medium', or 'large' depending on accuracy
            halfSample: false
        },
        decoder: {
            readers: ["code_128_reader", "ean_reader", "ean_8_reader", "code_39_reader", "upc_reader", "upc_e_reader"] // Specify barcode formats to read
        },
        locate: true
    }, function(err) {
        if (err) {
            console.log(err);
            return;
        }
        console.log("Initialization finished. Ready to start");
        Quagga.start();
    });

    // Event listener for detected barcode
    Quagga.onDetected(function(result) {
        const barcode = result.codeResult.code; // Get the scanned barcode
        console.log(`Barcode detected: ${barcode}`);
        
        // Stop scanning after a successful detection
        Quagga.stop();

        // Fetch item details using the detected barcode
        fetch(`fetch/fetch_items.php?barcode=${barcode}`)
            .then(response => response.json())
            .then(item => {
                if (item) {
                    // Populate the modal with item details
                    document.getElementById('itemBarcode').innerText = item.barcode;
                    document.getElementById('itemParticular').innerText = item.particular;
                    document.getElementById('itemBrand').innerText = item.brand;
                    document.getElementById('currentStock').innerText = item.current_stock;
                    document.getElementById('safetyStock').innerText = item.safety_stock;

                    // Show the modal
                    $('#itemDetailsModal').modal('show');
                } else {
                    console.error('Item not found.');
                }
            })
            .catch(error => console.error('Error fetching item details:', error));
    });
});

// Stop scanning when closing the modal
$('#itemDetailsModal').on('hidden.bs.modal', function () {
    Quagga.stop();
});

// Fetch total number of items
fetch('fetch/fetch_items.php')
  .then(response => response.json())
  .then(data => {
    document.querySelector('#totalItemsCount').innerText = data.total_items;
    console.log(data.items);
  })
  .catch(error => console.error('Error fetching data:', error));
</script>