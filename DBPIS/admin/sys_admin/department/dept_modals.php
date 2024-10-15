<!-- Modal for Adding Department -->
<div class="modal fade" id="insertDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="insertDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="insertDepartmentModalLabel">Add Department</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="departmentForm"> <!-- Updated ID to match JavaScript -->
                    <div class="form-group">
                        <label for="deptName">Department Name</label>
                        <input type="text" class="form-control" id="deptName" name="dept_name" required> <!-- Added name attribute -->
                    </div>
                    <div class="form-group">
                        <label for="deptGroup">Department Group</label>
                        <input type="text" class="form-control" id="deptGroup" name="dept_group"> <!-- Added name attribute -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addDepartment()">Add Department</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="updateDepartmentModal" tabindex="-1" role="dialog" aria-labelledby="updateDepartmentModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="updateDepartmentModalLabel">Update Department</h5> <!-- Updated title for clarity -->
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="updateDepartmentForm"> <!-- Updated ID to match JavaScript -->
                    <input type="hidden" id="updateDeptId" name="dept_id"> <!-- Hidden input for department ID -->
                    <div class="form-group">
                        <label for="updateDeptName">Department Name</label>
                        <input type="text" class="form-control" id="updateDeptName" name="dept_name" required> <!-- Updated ID -->
                    </div>
                    <div class="form-group">
                        <label for="updateDeptGroup">Department Group</label>
                        <input type="text" class="form-control" id="updateDeptGroup" name="dept_group"> <!-- Updated ID -->
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="updateDepartment()">Save Changes</button> <!-- Updated function name -->
            </div>
        </div>
    </div>
</div>




<script>
  $(document).ready(function() {
    // Handle the submission of the department form
    $('#departmentForm').submit(function(event) {
        event.preventDefault(); // Prevent the default form submission

        addDepartment(); // Call the addDepartment function to handle the submission
    });
});

// Function to add a department
function addDepartment() {
    $.ajax({
        url: 'fetch/insert_dept.php', // Adjust the path if needed
        type: 'POST',
        data: $('#departmentForm').serialize(), // Serialize the form data
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message);
                $('#insertDepartmentModal').modal('hide'); // Hide the modal
                resetForm(); // Reset the form using the reset function
                fetchDepartmentData(); // Fetch updated department data
            } else {
                alert('Error: ' + response.message);
            }
        },
        error: function(xhr, status, error) {
            console.error(error);
            alert('An error occurred: ' + error);
        }
    });
}

function updateDepartment() {
    // Serialize the form data
    const formData = $('#updateDepartmentForm').serialize();

    $.ajax({
        url: 'fetch/update_dept.php', // Adjust the path as needed
        type: 'POST',
        data: formData,
        dataType: 'json',
        success: function(response) {
            if (response.success) {
                alert(response.message); // Display success message
                $('#updateDepartmentModal').modal('hide'); // Hide the modal
                fetchDepartmentData(); // Refresh the department data
            } else {
                alert('Error: ' + response.message); // Display error message
            }
        },
        error: function(xhr, status, error) {
            console.error('Error updating department:', error); // Log error
            alert('An error occurred: ' + error); // Notify user
        }
    });
}


// Function to reset the form fields
function resetForm() {
    $('#departmentForm')[0].reset(); // Reset the form fields
}


</script>