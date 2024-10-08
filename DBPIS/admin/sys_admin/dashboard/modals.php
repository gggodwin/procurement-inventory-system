                
                
                
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