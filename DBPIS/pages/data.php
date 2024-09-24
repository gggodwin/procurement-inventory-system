
<?php
include_once ("../../core/dbsys.ini");
$query = $db->query("SELECT DISTINCT category FROM dbpis_items");
$categories = $query->fetchAll(PDO::FETCH_COLUMN);
?>

        <div class="content-wrapper">
          <div class="content"><div class="row">
            <div class="col-xl-12">
                    <!-- Income and Express -->
                    <div class="card card-default">
                      <div class="card-header">
                        <h2>Inventory Report</h2>

                        <div class="dropdown">
                          <a class="dropdown-toggle icon-burger-mini" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false" data-display="static">
                          </a>

                          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
                            <a class="dropdown-item" href="#" id="showAllAction">Show All</a>
                            <?php foreach ($categories as $category): ?>
                              <a class="dropdown-item categoryAction" href="#" name="<?php echo htmlspecialchars($category); ?>">
                                Show only: <?php echo htmlspecialchars($category); ?>
                              </a>
                            <?php endforeach; ?>
                          </div>
                          <button type="button" data-toggle="modal" data-target="#exampleModalForm" style="background: none; border: none; padding: 0;">
                            <span class="mdi mdi-plus-box-outline" style="font-size: 24px; color: green;"></span>
                          </button>

                          <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                              <div class="modal-dialog modal-dialog-centered" role="document">
                                  <div class="modal-content">
                                      <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalFormTitle">Insert Item Data</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                              <span aria-hidden="true">×</span>
                                          </button>
                                      </div>
                                      <div class="modal-body">
                                          <form id="itemForm">
                                              <div class="row">
                                                  <div class="col-12 col-sm-6">
                                                  <div class="form-group">
                                                    <label for="barcode">Barcode Id</label>
                                                    <input type="text" class="form-control" id="barcode" name="barcode" value="" required>
                                                </div>
                                                  </div>
                                                  <div class="col-12 col-sm-6">
                                                      <div class="form-group">
                                                          <label for="particular">Particular</label>
                                                          <input type="text" class="form-control" id="particular" name="particular" placeholder="Enter particular" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-12 col-sm-6">
                                                      <div class="form-group">
                                                          <label for="brand">Brand</label>
                                                          <input type="text" class="form-control" id="brand" name="brand" placeholder="Enter brand" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-12 col-sm-6">
                                                      <div class="form-group">
                                                          <label for="category">Category</label>
                                                          <input type="text" class="form-control" id="category" name="category" placeholder="Enter category" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-12 col-sm-6">
                                                      <div class="form-group">
                                                          <label for="safety_stock">Safety Stock</label>
                                                          <input type="number" class="form-control" id="safety_stock" name="safety_stock" placeholder="Enter safety stock" required>
                                                      </div>
                                                  </div>
                                                  <div class="col-12 col-sm-6">
                                                      <div class="form-group">
                                                          <label for="current_stock">Current Stock</label>
                                                          <input type="number" class="form-control" id="current_stock" name="current_stock" placeholder="Enter current stock" required>
                                                      </div>
                                                  </div>
                                              </div>
                                              <button type="submit" class="btn btn-primary">Submit</button>
                                          </form>
                                      </div>
                                      <div class="modal-footer">
                                          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                      </div>
                                  </div>
                              </div>
                          </div>
                              
                        </div>

                      </div>
                      <div class="card-body">
                        <div class="chart-wrapper">
                          <div id="mixed-chart-1"></div>
                        </div>
                      </div>

                    </div>
              </div>


  <div class="col-xl-12">
                    <!-- Revenue -->
                    <div class="card card-default">
                      <div class="card-header justify-content-center">
                        <h2>Progress Donut Chart</h2>
                      </div>
                      <div class="card-body pt-0">
                        <div class="chart-wrapper">
                          <div id="radial-bar-chart-1"></div>
                        </div>
                        <div class="radial-bar-chart-footer">
                          <div class="title-large">$25,350 <i class="mdi mdi-arrow-up text-success"></i></div>
                          <div class="title-small">vs $12,600 (prev)</div>
                        </div>
                      </div>
                    </div>
</div>
</div>

<div class="row">
  <div class="col-xl-6">
                    <!-- User Acquisition Statistics -->
                    <div class="card card-default" id="user-acquisition">
                      <div class="card-header border-bottom pb-0">
                        <h2>User Acquisition</h2>
                        <ul class="nav nav-underline-active-primary" role="tablist">
                          <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#traffic-channel" role="tab" aria-selected="true">Traffic
                              Channel</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#source-medium" role="tab" aria-selected="false">Source / Medium </a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="tab" href="#referrals" role="tab" aria-selected="false">Referrals</a>
                          </li>
                        </ul>
                      </div>

                      <div class="tab-content" id="myTabContent">
                        <div id="barchartlg1"></div>
                      </div>
                      <div class="card-footer d-flex flex-wrap bg-white">
                        <a href="#" class="text-uppercase py-3">Acquisition Report</a>
                      </div>
                    </div>
  </div>

  <!-- Sessions by Device -->
  <div class="col-xl-6">
                      <!-- Sessions By Device -->
                      <div class="card card-default">
                        <div class="card-header border-bottom">
                          <h2 class="mdi mdi-desktop-mac">Sessions by Device</h2>
                        </div>
                        <div class="card-body pt-6">
                          <div class="row">
                            <div class="col-lg-6">
                              <div id="donut-chart-1"></div>
                            </div>
                            <div class="col-lg-6">
                              <div class="media mb-4">
                                <i class="display-4 mdi mdi-remote-desktop text-primary mr-3"></i>
                                <div class="media-body">
                                  <p>Desktop</p>
                                  <p class="h4 my-1 text-dark">45% <span class="text-success">23.5% <i
                                        class="mdi mdi-arrow-up-bold small"></i></span>
                                  </p>
                                  <p>vs 155,900 (prev)</p>
                                </div>
                              </div>

                              <div class="media mb-4">
                                <i class="display-4 mdi mdi-tablet-android text-primary mr-3"></i>
                                <div class="media-body">
                                  <p>Tablet</p>
                                  <p class="h4 my-1 text-dark">30% <span class="text-success">13.5% <i
                                        class="mdi mdi-arrow-up-bold small"></i></span>
                                  </p>
                                  <p>vs 187,900 (prev)</p>
                                </div>
                              </div>

                              <div class="media mb-4">
                                <i class="display-4 mdi mdi-cellphone-iphone text-primary mr-3"></i>
                                <div class="media-body">
                                  <p>Mobile</p>
                                  <p class="h4 my-1 text-dark">25% <span class="text-success">35.5% <i
                                        class="mdi mdi-arrow-up-bold small"></i></span>
                                  </p>
                                  <p>vs 309,900 (prev)</p>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
</div>
</div>

<div class="row">
  <div class="col-xl-4">
    <!-- Current Users  -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Current Users</h2>
        <span>Realtime</span>
      </div>
      <div class="card-body ">
        <div id="barchartlg2"></div>
      </div>
      <div class="card-footer bg-white py-4">
        <a href="#" class="text-uppercase">Current Users Overview</a>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Pie Chart  -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Pie Chart</h2>
      </div>
      <div class="card-body p-xl-7">
        <div id="simple-pie-chart" class="d-flex justify-content-center"></div>
      </div>

    </div>
  </div>
  <div class="col-xl-4">
    <!-- User -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Users</h2>
      </div>
      <div class="card-body pb-0">
        <div class="bg-primary d-flex justify-content-between flex-wrap p-5 text-white align-items-lg-end">
          <div class="d-flex flex-column">
            <span class="h3 text-white">325,980</span>
            <span>vs 275,900 (prev)</span>
          </div>
          <div>
            <span>45%</span>
            <i class="mdi mdi-arrow-up-bold"></i>
          </div>
        </div>
        <div id="line-chart-1"></div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-xl-4">
    <!-- Radar Chart  -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Radar Chart</h2>
      </div>
      <div class="card-body pb-0">
        <div id="simple-rader-chart"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Horizontal Bar Chart  -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Horizontal Bar Chart</h2>
      </div>
      <div class="card-body pb-0">
        <div id="horizontal-bar-chart"></div>
      </div>
    </div>
  </div>
  <div class="col-xl-4">
    <!-- Aria Chart  -->
    <div class="card card-default">
      <div class="card-header">
        <h2>Aria Chart</h2>
      </div>
      <div class="card-body pb-0">
        <div id="aria-chart"></div>
      </div>
    </div>
  </div>

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

</script>
