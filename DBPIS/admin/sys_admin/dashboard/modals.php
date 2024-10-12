              
                        <div class="modal fade" id="exampleModalForm" tabindex="-1" role="dialog" aria-labelledby="exampleModalFormTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalFormTitle">Insert Item Data</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
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
                                                        <label for="updateItemCategory">Category</label>
                                                        <select class="form-control" id="updateItemCategory" name="category">
                                                            <?php foreach ($categories as $category): ?>
                                                                <option value="<?php echo htmlspecialchars($category); ?>">
                                                                    <?php echo htmlspecialchars($category); ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
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
                                                <div class="col-12 col-sm-6"> <!-- New Units Input -->
                                                    <div class="form-group">
                                                        <label for="units">Units</label>
                                                        <input type="text" class="form-control" id="units" name="units" placeholder="Enter units" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>


                                                        <!-- Update Item Modal -->
                        <div class="modal fade" id="updateStockModal" tabindex="-1" role="dialog" aria-labelledby="updateStockModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateStockModalLabel">Update Stock</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateStockForm">
                                            <input type="hidden" id="itemBarcode" name="barcode">
                                            <div class="form-group">
                                                <label for="currentStock">Current Stock</label>
                                                <input type="number" class="form-control" id="currentStock" name="current_stock" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="safetyStock">Safety Stock</label>
                                                <input type="number" class="form-control" id="safetyStock" name="safety_stock" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Update Item Details Modal -->
                        <div class="modal fade" id="updateItemDetailsModal" tabindex="-1" role="dialog" aria-labelledby="updateItemDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="updateItemDetailsModalLabel">Update Item Details</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form id="updateItemDetailsForm"> <!-- Changed the form ID -->
                                            <input type="hidden" id="updateItemBarcode" name="barcode">
                                            <div class="form-group">
                                                <label for="updateItemParticular">Particular</label>
                                                <input type="text" class="form-control" id="updateItemParticular" name="particular">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateItemBrand">Brand</label>
                                                <input type="text" class="form-control" id="updateItemBrand" name="brand">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateItemCurrentStock">Current Stock</label>
                                                <input type="number" class="form-control" id="updateItemCurrentStock" name="current_stock">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateItemSafetyStock">Safety Stock</label>
                                                <input type="number" class="form-control" id="updateItemSafetyStock" name="safety_stock">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateItemUnits">Units</label> <!-- New Units Input -->
                                                <input type="text" class="form-control" id="updateItemUnits" name="units">
                                            </div>
                                            <div class="form-group">
                                                <label for="updateItemCategory">Category</label>
                                                <select class="form-control" id="updateItemCategory" name="category">
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo htmlspecialchars($category); ?>">
                                                            <?php echo htmlspecialchars($category); ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Update</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

<!-- Add this modal to your HTML to display the barcode -->
<div class="modal fade" id="barcodeModal" tabindex="-1" role="dialog" aria-labelledby="barcodeModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="barcodeModalLabel">Generated Barcode</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <canvas id="barcodeCanvas"></canvas><!-- This is where the barcode will be rendered -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="downloadBarcodeBtn">Download</button>
            </div>
        </div>
    </div>
</div>

