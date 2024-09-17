
<?php 
include ("misc/header.php"); 
include ("core/dbsys.ini");
include_once ("query/system.qry");

session_start();

$system = new SYSTEM();

if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    if ($system->get_validateuser($db, $_POST["username"], $_POST["password"])) {
        header("Location: admin/sys_admin/main_admin.php");
        exit(); // Ensure no further code execution after redirect
    }
    echo "Invalid username or password."; // Optional: Handle invalid credentials
}
?>

<script>
$(document).ready(function() {
    $.ajax({
        url: 'admin/login.php', // URL to your PHP file
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // This header identifies the request as AJAX
        },
        success: function(response) {
            // Insert the response into a specific HTML element
            $('#loginContainer').html(response);
        },
        error: function(xhr, status, error) {
            console.error('AJAX Error:', status, error);
        }
    });
});
</script>
<div id="loginContainer" class ="bg-black">
        <!-- The PHP content will be loaded here -->
</div>