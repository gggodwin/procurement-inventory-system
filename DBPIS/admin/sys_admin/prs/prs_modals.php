
<style>
        .modal-custom {
        max-width: 80%; /* You can adjust this percentage */
        width: 95%; /* Adjust this value as needed */
        }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<div class="modal fade" id="insertPRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insert Purchase Requisition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="prsForm" method="POST">
                    <!-- dbpis_prs fields (vertical columns layout) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="prs_code">PR Code</label>
                                <input type="text" class="form-control" id="prs_code" name="prs_code" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requested_by">Requested By</label>
                                <input type="text" class="form-control" id="requested_by" name="requested_by" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <input type="text" class="form-control" id="department" name="department" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_requested">Date Requested</label>
                                <input type="date" class="form-control" id="date_requested" name="date_requested" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="remarks">Remarks</label>
                                <textarea class="form-control" id="remarks" name="remarks" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <h5>PR Items</h5>
                    <table class="table table-hover table-product" id="prsDetailsTable">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Type</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="prsDetailsContainer">
                            <tr>
                                <td><input type="text" name="item_code[]" class="form-control" required></td>
                                <td><input type="text" name="item_description[]" class="form-control" required></td>
                                <td><input type="number" name="quantity[]" class="form-control quantity" required></td>
                                <td>
                                    <select name="unit_type[]" class="form-control" required>
                                        <option value="pcs">Pieces</option>
                                        <option value="kg">Kilograms</option>
                                        <option value="ltr">Liters</option>
                                        <option value="box">Box</option>
                                        <!-- Add more unit types as needed -->
                                    </select>
                                </td>
                                <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price" required></td>
                                <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
                                <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <button type="button" class="btn btn-success" id="addRow">Add Row</button>
                        </div>
                        <div class="col-md-3 text-right">
                            <h5>Grand Total: <span id="grandTotal">0.00</span></h5>
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>

$(document).ready(function() {
    // Add a new row in the PR details section
    $('#addRow').click(function() {
        var newRow = `
            <tr>
                <td><input type="text" name="item_code[]" class="form-control" required></td>
                <td><input type="text" name="item_description[]" class="form-control" required></td>
                <td><input type="number" name="quantity[]" class="form-control quantity" required></td>
                <td>
                    <select name="unit_type[]" class="form-control" required>
                        <option value="pcs">Pieces</option>
                        <option value="kg">Kilograms</option>
                        <option value="ltr">Liters</option>
                        <option value="box">Box</option>
                        <!-- Add more unit types as needed -->
                    </select>
                </td>
                <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price" required></td>
                <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
                <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
            </tr>`;
        $('#prsDetailsContainer').append(newRow);
    });

    // Remove a row
    $(document).on('click', '.removeRow', function() {
        $(this).closest('tr').remove();
        calculateTotal();
    });

    // Calculate total price for each row
    $(document).on('input', '.quantity, .unit_price', function() {
        var row = $(this).closest('tr');
        var quantity = parseFloat(row.find('.quantity').val()) || 0;
        var unit_price = parseFloat(row.find('.unit_price').val()) || 0;
        var total_price = (quantity * unit_price).toFixed(2);
        row.find('.total_price').val(total_price);
        calculateTotal();
    });

    // Calculate the grand total
    function calculateTotal() {
        var grandTotal = 0;
        $('.total_price').each(function() {
            grandTotal += parseFloat($(this).val()) || 0;
        });
        $('#grandTotal').text(grandTotal.toFixed(2));
    }

    // Handle form submission
        $(document).ready(function() {
        $('#prsForm').submit(function(event) {
            event.preventDefault(); // Prevent the default form submission

            $.ajax({
                url: 'fetch/insert_prs.php',
                type: 'POST',
                data: $(this).serialize(), // Serialize the form data
                dataType: 'json',
                success: function(response) {
                    if (response.success) {
                        alert(response.message);
                        $('#insertPRModal').modal('hide');
                        $('#prsForm')[0].reset(); // Reset the form
                        fetchRequisitionData();
                        // Optionally, refresh the data in your table or perform other actions
                    } else {
                        alert('Error: ' + response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred: ' + error);
                }
            });
        });
    });
});


</script>