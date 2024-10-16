<!-- Modal for Adding Supplier -->
<div class="modal fade" id="insertSupplierModal" tabindex="-1" role="dialog" aria-labelledby="insertSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertSupplierModalLabel">Add Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="supplierForm"> <!-- Updated ID to match JavaScript -->
                    <div class="form-group">
                        <label for="supplierName">Supplier Name</label>
                        <input type="text" class="form-control" id="supplierName" name="supplier_name" required> <!-- Added name attribute -->
                    </div>
                    <div class="form-group">
                        <label for="contactName">Contact Name</label>
                        <input type="text" class="form-control" id="contactName" name="contact_name"> <!-- Added name attribute -->
                    </div>
                    <div class="form-group">
                        <label for="contactEmail">Contact Email</label>
                        <input type="email" class="form-control" id="contactEmail" name="contact_email">
                    </div>
                    <div class="form-group">
                        <label for="contactPhone">Contact Phone</label>
                        <input type="text" class="form-control" id="contactPhone" name="contact_phone">
                    </div>
                    <div class="form-group">
                        <label for="supplierAddress">Address</label>
                        <textarea class="form-control" id="supplierAddress" name="address"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addSupplier()">Add Supplier</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for Updating Supplier -->
<div class="modal fade" id="updateSupplierModal" tabindex="-1" role="dialog" aria-labelledby="updateSupplierModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateSupplierModalLabel">Update Supplier</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateSupplierForm"> <!-- Updated ID to match JavaScript -->
                    <input type="hidden" id="updateSupplierId" name="supplier_id"> <!-- Hidden input for supplier ID -->
                    <div class="form-group">
                        <label for="updateSupplierName">Supplier Name</label>
                        <input type="text" class="form-control" id="updateSupplierName" name="supplier_name" required> <!-- Updated ID -->
                    </div>
                    <div class="form-group">
                        <label for="updateContactName">Contact Name</label>
                        <input type="text" class="form-control" id="updateContactName" name="contact_name"> <!-- Updated ID -->
                    </div>
                    <div class="form-group">
                        <label for="updateContactEmail">Contact Email</label>
                        <input type="email" class="form-control" id="updateContactEmail" name="contact_email">
                    </div>
                    <div class="form-group">
                        <label for="updateContactPhone">Contact Phone</label>
                        <input type="text" class="form-control" id="updateContactPhone" name="contact_phone">
                    </div>
                    <div class="form-group">
                        <label for="updateSupplierAddress">Address</label>
                        <textarea class="form-control" id="updateSupplierAddress" name="address"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateSupplier()">Save Changes</button> <!-- Updated function name -->
            </div>
        </div>
    </div>
</div>

<script>
  $(document).ready(function() {
    // Handle the submission of the supplier form
    $('#supplierForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        addSupplier(); // Call the addSupplier function to handle the submission
    });
});

// Function to add a supplier with debug feature
function addSupplier() {
    // Serialize the form data
    const formData = $('#supplierForm').serialize();
    
    // Log the serialized data for debugging
    console.log("Form Data being sent:", formData);

    $.ajax({
        url: 'fetch/insert_supp.php', // Adjust the path if needed
        type: 'POST',
        data: formData, // Use the serialized form data
        dataType: 'json',
        success: function(response) {
            // Log the server's response for debugging
            console.log("Server Response:", response);

            if (response.success) {
                alert(response.message);
                $('#insertSupplierModal').modal('hide'); // Hide the modal
                resetForm(); // Reset the form using the reset function
                fetchSupplierData(); // Fetch updated supplier data
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            // Log the error response for debugging
            console.error("AJAX Error:", xhr.responseText, status, error);
            alert('An error occurred: ' + error);
        }
    });
}


function updateSupplier() {
    // Serialize the form data
    const formData = $('#updateSupplierForm').serialize();

    $.ajax({
        url: 'fetch/update_supp.php', // Adjust the path as needed
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Display success message
                $('#updateSupplierModal').modal('hide'); // Hide the modal
                fetchSupplierData(); // Refresh the supplier data
            } else {
                alert('Error: ' + response.message); // Display error message
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating supplier:', error); // Log error
            alert('An error occurred: ' + error); // Notify user
        }
    });
}

// Function to reset the form fields
function resetForm() {
    $('#supplierForm')[0].reset(); // Reset the form fields
}
</script>
