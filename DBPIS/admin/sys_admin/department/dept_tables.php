
<?php include ("dept_modals.php"); ?>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<style>
        .dropdown-toggle::after {
    display: none;
}
</style>

<span id="showAllAction"></span>
<span id="showLowStock"></span>
<div class="row">
        <div class="col-12">
            <div class="card card-default">
                <div class="card-header">
                    <h2>Departments</h2>
                    <div class="dropdown">
                        <button type="button" data-toggle="modal" data-target="#insertDepartmentModal">
                            <span class="mdi mdi-file-plus" style="font-size: 24px; color: green;"></span>
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table id="departmentsTable" class="table table-hover" style="width:100%">
                        <thead>
                            <tr>
                                <th>Dept ID</th>
                                <th>Department Name</th>
                                <th>Department Group</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody id="departmentsTableBody">
                            <!-- Department data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#departmentsTable').DataTable(); // Initialize DataTable
            fetchDepartmentData(); // Fetch and populate data
        });

        function fetchDepartmentData() {
            const table = $('#departmentsTable').DataTable();
            table.clear();

            fetch('fetch/fetch_dept.php')
                .then(response => response.json())
                .then(data => {
                    console.log(data); // Check the data structure
                    if (data.error) {
                        console.error(data.error);
                        return;
                    }

                    data.departments.forEach(department => {
                        table.row.add([
                            department.dept_id,
                            department.dept_name,
                            department.dept_group,
                            department.CreatedAt,
                            department.UpdatedAt,
                            `
                            <div class="btn-group">
                                <button type="button" class="btn btn-primary btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-cog"></i>
                                </button>
                                <div class="dropdown-menu">
                                <button class="dropdown-item" onclick="openUpdateDepartmentModal('${department.dept_id}', '${department.dept_name}', '${department.dept_group}')">
                                    <i class="fas fa-edit"></i> Update
                                </button>

                                    <button class="dropdown-item" onclick="deleteDepartment('${department.dept_id}')">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </div>
                            </div>
                            `
                        ]);
                    });

                    table.draw();
                })
                .catch(error => console.error('Error fetching department data:', error));
        }

        function deleteDepartment(deptId) {
            if (confirm('Are you sure you want to delete this department?')) {
                $.ajax({
                    url: 'fetch/fetch_dept.php', // Path to your delete PHP file
                    type: 'DELETE',
                    data: { dept_id: deptId }, // Send the department ID to be deleted
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            alert(response.message);
                            fetchDepartmentData(); // Refresh the table data
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
        }

        function openUpdateDepartmentModal(deptId, deptName, deptGroup) {
            console.log('Dept ID:', deptId, 'Dept Name:', deptName, 'Dept Group:', deptGroup); // Debugging line
            // Set the values in the modal fields
            $('#updateDeptId').val(deptId); // This should set the hidden input
            $('#updateDeptName').val(deptName); // This should set the department name
            $('#updateDeptGroup').val(deptGroup); // This should set the department group

            // Show the modal
            $('#updateDepartmentModal').modal('show');
}
    </script>