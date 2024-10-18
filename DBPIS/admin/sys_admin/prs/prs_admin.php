<?php
// Fetch departments from the database
include_once ("../../core/dbsys.ini");
$query = "SELECT dept_name FROM dbpis_department"; // Update with your actual table name
$stmt = $db->prepare($query);
$stmt->execute();
$departments = $stmt->fetchAll(PDO::FETCH_ASSOC);

$query = "SELECT supplier_name FROM dbpis_supplier"; // Adjust to your actual table name
$stmt = $db->prepare($query);
$stmt->execute();
$suppliers = $stmt->fetchAll(PDO::FETCH_ASSOC)
?>
<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2>REQUISITION TABLE</h2>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-underline-active-primary mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#nav-tabs-home2" role="tab" aria-controls="nav-tabs" aria-selected="true">PRS Data</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="nav-profile-tab" data-toggle="pill" href="#nav-profile2" role="tab" aria-controls="nav-profile" aria-selected="false">Details Data</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-5" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-tabs-home2" role="tabpanel" aria-labelledby="nav-home-tab">
                                <?php include ("prs/prs_approval.php") ?>
                            </div>
                            <div class="tab-pane fade" id="nav-profile2" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <?php include ("prs/prs_details.php") ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
