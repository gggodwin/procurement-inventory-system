
<style>

    
.modal-custom {
max-width: 80%; /* You can adjust this percentage */
width: 95%; /* Adjust this value as needed */
}

.modal-invoice {
max-width: 70%; /* You can adjust this percentage */
width: 100%; /* Adjust this value as needed */
}


        /* Set the height and width of the Select2 selection box */
.select2-container--default .select2-selection--single {
    width: 100%; /* Make the dropdown span full width */
    display: flex;
    align-items: center; /* Center align items vertically */
    
}

.select2-selection__rendered {
    line-height: 40px !important;
}
.select2-container .select2-selection--single {
    height: 40px !important;
}
.select2-selection__arrow {
    height: 40px !important;
}

.select2-results__option--highlighted {
  color: white !important;
  background-color:  #242f3f !important;
}

.select2-container--default .select2-selection__clear {
    display: none; /* Hides the clear button */
}

/* Optionally, hide the 'x' on selected items as well */
.select2-container--default .select2-selection__choice__remove {
    display: none; /* Hides the 'x' on selected items */
}

#insertPRModal{
    overflow-x:hidden;
}



        
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>


<div class="modal fade" id="insertPRModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom modal-dialog " role="document">
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
                                <input type="text" class="form-control" id="prs_code" name="prs_code" required readonly>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="requested_by">Requested By</label>
                                <input type="text" class="form-control" id="requested_by" name="requested_by" value="<?php echo $_SESSION['name']; ?>" readonly required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="department">Department</label>
                                <select class="form-control" id="department" name="department" required>
                                    <option value="">Select a Department</option> <!-- Default option -->
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_requested">Date Requested</label>
                                <input type="date" class="form-control" id="date_requested" name="date_requested" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="date_needed">Date needed</label>
                                <input type="date" class="form-control" id="date_needed" name="date_needed" required>
                            </div>
                        </div>
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
                                <th>Supplier</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="prsDetailsContainer">
                            <tr>
                                <td><input type="text" name="item_code[]" class="form-control item_code" readonly></td>
                                <td>
                                    <select name="item_description[]" class="form-control item_description" required>
                                        <option value="" disabled selected>Select Item</option>
                                        <!-- Options will be populated via JS -->
                                    </select>
                                </td>
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

<div class="modal fade" id="viewDetailsModal" tabindex="-1" aria-labelledby="viewDetailsModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-invoice">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="viewDetailsModalLabel">Purchase Requisition Details</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe id="prsDetailsFrame" style="width:100%; height:600px;" frameborder="0"></iframe>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="printContent()">Print</button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="updateRequisitionModal" tabindex="-1" role="dialog" aria-labelledby="updateRequisitionLabel" aria-hidden="true">
    <div class="modal-dialog modal-custom" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateRequisitionLabel">Update Purchase Requisition</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updatePrsForm" method="POST">
                    <!-- dbpis_prs fields (vertical columns layout) -->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updatePrsCode">PR Code</label>
                                <input type="text" class="form-control" id="updatePrsCode" name="prs_code" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updateRequestedBy">Requested By</label>
                                <input type="text" class="form-control" id="updateRequestedBy" name="requested_by" value="<?php echo $_SESSION['name']; ?>" readonly required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updateDepartment">Department</label>
                                    <select class="form-control" id="updateDepartment" name="department" required>
                                        <option value="">Select new Department</option> <!-- Default option -->
                                        <?php foreach ($departments as $department): ?>
                                            <option value="<?php echo $department['dept_name']; ?>"><?php echo $department['dept_name']; ?></option>
                                        <?php endforeach; ?>
                                    </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updateDateRequested">Date Requested</label>
                                <input type="date" class="form-control" id="updateDateRequested" name="date_requested" required readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updateDateNeeded">Date Needed</label>
                                <input type="date" class="form-control" id="updateDateNeeded" name="date_needed" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="updateRemarks">Remarks</label>
                                <textarea class="form-control" id="updateRemarks" name="remarks" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    
                    <h5>PR Items</h5>
                    <table class="table table-hover table-product" id="updatePrsDetailsTable">
                        <thead>
                            <tr>
                                <th>Item Code</th>
                                <th>Description</th>
                                <th>Quantity</th>
                                <th>Unit Type</th>
                                <th>Supplier</th>
                                <th>Unit Price</th>
                                <th>Total Price</th>
                                <!--<th>Actions</th>-->
                            </tr>
                        </thead>
                        <tbody id="updatePrsDetailsContainer">
                            <!-- Existing rows will be populated dynamically -->
                        </tbody>
                    </table>
                    <div class="row mb-3">
                        <div class="col-md-8">
                            <!--<button type="button" class="btn btn-success" id="updateAddRow">Add Row</button>-->
                        </div>
                        <div class="col-md-3 text-right">
                            <!--<h5>Grand Total: <span id="updateGrandTotal">0.00</span></h5>-->
                        </div>
                    </div>

                    <!-- Submit button -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" onclick="updateRequisition()">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<script>
    function printContent() {
    const iframe = document.getElementById('prsDetailsFrame');
    if (iframe) {
        iframe.contentWindow.print();
    } else {
        console.error("Iframe not found");
    }
}
    
$(document).ready(function() {
    let items = []; // To store fetched items

    // Fetch all items and populate the description dropdown
    $.ajax({
        url: 'fetch/fetch_items.php',
        method: 'GET',
        dataType: 'json',
        success: function(data) {
            items = data.items; // Store fetched items
            populateDescriptionDropdown(); // Populate dropdowns for existing row
        }
    });

    // Function to populate the description dropdown
    function populateDescriptionDropdown() {
    $('.item_description').select2({
        placeholder: "Select Item", 
        allowClear: true,
        width: '240px', // Set a fixed width for the dropdown
        dropdownParent: $('#insertPRModal .modal-content'),
        ajax: {
            url: 'fetch/fetch_items.php', // Your backend URL to handle the search
            dataType: 'json',
            delay: 250, // Delay to avoid overwhelming the server with requests
            data: function (params) {
                return {
                    search: params.term // Search term sent to server
                };
            },
            processResults: function (data) {
                return {
                    results: data.items.map(function(item) {
                        return {
                            id: `${item.particular} - ${item.brand}`, // Use item description as value
                            text: `${item.particular} - ${item.brand}`, // Displayed text
                            barcode: item.barcode // Include barcode in the result if needed for later use
                        
                        };
                    })
                };
            },
            cache: true
        }
    });

    $('#insertPRModal').on('shown.bs.modal', function () {
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('date_requested').value = today;
});

    // When an item is selected, populate the corresponding barcode
    $('.item_description').on('select2:select', function(e) {
        // Get the selected item's data
        let selectedItem = e.params.data;
        let selectedBarcode = selectedItem.barcode; // Retrieve the barcode from the selected item
        $(this).closest('tr').find('.item_code').val(selectedBarcode); // Populate the input field with the barcode
    });
}


function populateSupplierDropdown() {
    // Initialize Select2 for the supplier dropdown
    $('.supplier').select2({
        placeholder: "Select Supplier", 
        allowClear: true,
        width: '240px', // Set a fixed width for the dropdown
        dropdownParent: $('#insertPRModal .modal-content'),
        ajax: {
            url: 'fetch/fetch_supp.php', // Your backend URL to handle the supplier search
            dataType: 'json',
            delay: 250, // Delay to avoid overwhelming the server with requests
            data: function (params) {
                return {
                    search: params.term // Search term sent to server
                };
            },
            processResults: function (data) {
                return {
                    results: data.suppliers.map(function(supplier) {
                        return {
                            id: supplier.supplier_name, // Use supplier name as value
                            text: supplier.supplier_name, // Displayed text
                            contact_email: supplier.contact_email, // Include other details if needed
                            contact_phone: supplier.contact_phone // Include phone for further use if necessary
                        };
                    })
                };
            },
            cache: true
        }
    });

    // Reinitialize the date input for 'date_requested' when the modal is shown
    $('#insertPRModal').on('shown.bs.modal', function () {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('date_requested').value = today;
    });

    // If needed, handle additional logic when a supplier is selected
    $('.supplier').on('select2:select', function(e) {
        // Get the selected supplier's data
        let selectedSupplier = e.params.data;
        let selectedEmail = selectedSupplier.contact_email; // Retrieve email (or other data) if needed
        let selectedPhone = selectedSupplier.contact_phone; // Retrieve phone if needed
        
        // You can now populate other fields in the form using the selected supplier data
        console.log(`Selected Supplier: ${selectedSupplier.text}, Email: ${selectedEmail}, Phone: ${selectedPhone}`);
        
        // Optionally populate other fields if necessary
        // Example:
        // $(this).closest('tr').find('.supplier_email').val(selectedEmail);
    });


}



$.ajax({
    url: 'fetch/fetch_supp.php', // Correct path to fetch suppliers
    method: 'GET',
    dataType: 'json',
    success: function(data) {
        suppliers = data.suppliers; // Store fetched suppliers
        populateSupplierDropdown(); // Populate supplier dropdown
    }
});

    // Add a new row
$('#addRow').click(function() {
    var newRow = `
        <tr>
            <td><input type="text" name="item_code[]" class="form-control item_code" readonly></td>
            <td>
                <select name="item_description[]" class="form-control item_description" required>
                    <option value="" disabled selected>Select Item</option>
                    <!-- Options will be populated via JS -->
                </select>
            </td>
            <td><input type="number" name="quantity[]" class="form-control quantity" required></td>
            <td>
                <select name="unit_type[]" class="form-control" required>
                    <option value="pcs">Pieces</option>
                    <option value="kg">Kilograms</option>
                    <option value="ltr">Liters</option>
                    <option value="box">Box</option>
                </select>
            </td>
            <td>
                <select name="supplier[]" class="form-control supplier" required>
                    <option value="" disabled selected>Select Supplier</option>
                    <!-- Options will be populated via JS -->
                </select>
            </td>
            <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price" required></td>
            <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>`;
    
    $('#prsDetailsContainer').append(newRow);

    // Scroll to the newly added row
    var container = $('#prsDetailsContainer');
    var newRowElement = container.find('tr').last();
    $('#insertPRModal, .modal-body').animate({
        scrollTop: newRowElement.offset().top
    }, 800); // Adjust the scroll speed as necessary (800ms)

    // Populate the description dropdown in the new row
    populateDescriptionDropdown();
    populateSupplierDropdown();
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

    // Function to reset the form and grand total
    function resetForm() {
        // Reset the form fields
        $('#prsForm')[0].reset();

        // Clear all rows in the PR details table
        $('#prsDetailsContainer').empty();
        addInitialRow(); // Optionally add the initial row back

        // Reset the grand total
        $('#grandTotal').text('0.00');
    }

    // Function to add the initial row back
    function addInitialRow() {
    var initialRow = `
        <tr>
            <td><input type="text" name="item_code[]" class="form-control item_code" readonly></td>
            <td>
                <select name="item_description[]" class="form-control item_description" required>
                    <option value="" disabled selected>Select Item</option>
                    <!-- Options will be populated via JS -->
                </select>
            </td>
            <td><input type="number" name="quantity[]" class="form-control quantity" required></td>
            <td>
                <select name="unit_type[]" class="form-control" required>
                    <option value="pcs">Pieces</option>
                    <option value="kg">Kilograms</option>
                    <option value="ltr">Liters</option>
                    <option value="box">Box</option>
                </select>
            </td>
            <td>
                <select name="supplier[]" class="form-control supplier" required>
                    <option value="" disabled selected>Select Supplier</option>
                    <!-- Options will be populated via JS -->
                </select>
            </td>
            <td><input type="number" step="0.01" name="unit_price[]" class="form-control unit_price" required></td>
            <td><input type="text" name="total_price[]" class="form-control total_price" readonly></td>
            <td><button type="button" class="btn btn-danger removeRow">Remove</button></td>
        </tr>`;
    $('#prsDetailsContainer').append(initialRow);

}

    // Handle form submission
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
                    resetForm(); // Reset the form using the reset function
                    fetchRequisitionData(); // Fetch updated data if necessary
                    fetchPurchaseRequisitionDetails();
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

    resetForm();

    function fetchDepartments() {
        console.log('Fetching departments...'); // Debugging: Start of the fetch process
        $.ajax({
            url: 'fetch/fetch_dept.php', // Adjust the path to your department fetch script
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log('Response received:', response); // Debugging: Log the response
                if (response.departments) {
                    const departmentSelect = $('#department');
                    departmentSelect.empty(); // Clear existing options
                    departmentSelect.append('<option value="">Select a Department</option>'); // Default option

                    response.departments.forEach(department => {
                        departmentSelect.append(
                            `<option value="${department.dept_name}">${department.dept_name}</option>`
                        ); // Add each department to the dropdown
                    });
                } else {
                    console.error('No departments found in the response.');
                }
            },
            error: function(xhr, status, error) {
                console.error('Error fetching departments:', error);
                console.log('XHR:', xhr); // Log the XHR object for more details
                console.log('Status:', status); // Log the status
            }
        });
    }

    // Call fetchDepartments when the modal is opened
    $('#insertPRModal').on('show.bs.modal', function() {
        fetchDepartments(); // Fetch and populate departments when the modal is opened
    });
    
            // Fetch and set the new PR Code and Barcode when the modal is opened
        $('#insertPRModal').on('show.bs.modal', function() {
            $.ajax({
                url: 'fetch/fetch_latest_id.php', // Adjust the path as needed
                type: 'GET',
                dataType: 'json',
                success: function(response) {
                    console.log('New IDs fetched:', response); // Debugging: Log the response
                    if (response.latest_pr_code) {
                        $('#prs_code').val(response.latest_pr_code); // Set the PR Code in the input field
                    } else {
                        console.error('No PR Code returned from server.');
                    }
                    if (response.latest_barcode) {
                        $('#barcode').val(response.latest_barcode); // Set the Barcode in the input field
                    } else {
                        console.error('No Barcode returned from server.');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('Error fetching new IDs:', error);
                }
            });
        });

        function updateRequisition() {
    // Create a FormData object to hold form data
    const formData = new FormData(document.getElementById('updatePrsForm'));

    // Send the data via fetch to the server
    fetch('fetch/update_prs.php', {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Success: Notify the user and refresh the data
            alert(data.message); // You might want to use a better UI for notifications
            $('#updateRequisitionModal').modal('hide'); // Hide the modal
            
            // Optionally refresh the requisitions table here
            fetchPurchaseRequisitionDetails(); // Call your existing function to refresh data
        } else {
            // Error: Notify the user
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error updating requisition:', error);
        alert('An error occurred while updating the requisition.');
    });
}


});





</script>