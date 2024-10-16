<div class="content-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-xl-12">
                <div class="card card-default">
                    <div class="card-header">
                        <h2>Supplier Table</h2>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-underline-active-primary mb-3" id="pills-tab2" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#nav-tabs-home3" role="tab" aria-controls="nav-tabs" aria-selected="true">Home</a>
                            </li>
                            <!--
                            <li class="nav-item">
                                <a class="nav-link" id="nav-profile-tab" data-toggle="pill" href="#nav-profile3" role="tab" aria-controls="nav-profile" aria-selected="false">Details Data</a>
                            </li>
-->
                        </ul>
                        <div class="tab-content mt-5" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-tabs-home3" role="tabpanel" aria-labelledby="nav-home-tab">
                                <?php include ("supplier/supp_tables.php") ?>
                            </div>
                            <div class="tab-pane fade" id="nav-profile3" role="tabpanel" aria-labelledby="nav-profile-tab">
                                ...
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
