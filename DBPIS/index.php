<?php  
include ("misc/header.php"); 
include ("core/dbsys.ini");
include_once ("query/system.qry");

session_start();

$system = new SYSTEM();
$invalid_login = false; // Initialize the flag for invalid login
if ($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST['username']) && !empty($_POST['password'])) {
    // Assuming get_validateuser returns the user data if valid or false if not
    $user_data = $system->get_validateuser($db, $_POST["username"], $_POST["password"]);

    if ($user_data) {
        // Assuming $user_data is an array with 'name' and 'username'
        $_SESSION['name'] = $user_data['name'];      // Store the user's name in the session
        $_SESSION['username'] = $user_data['username']; // Store the username in the session

        // Redirect to the dashboard or wherever the user should go after logging in
        header("Location: admin/sys_admin/index.php");
        exit(); // Ensure no further code execution after redirect
    } else {
        $invalid_login = true; // Set the flag to true if login fails
    }
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

    // Display a toast if login is invalid
    <?php if ($invalid_login): ?>
        showToast("Invalid username or password. Please try again.");
    <?php endif; ?>
});

// Custom toast function
function showToast(message) {
    var toast = document.createElement('div');
    toast.className = 'custom-toast';
    toast.innerText = message;
    
    document.body.appendChild(toast);

    setTimeout(function() {
        toast.classList.add('visible');
    }, 100); // Slight delay to allow transition

    setTimeout(function() {
        toast.classList.remove('visible');
        setTimeout(function() {
            document.body.removeChild(toast);
        }, 300); // Delay to remove the element after the fade-out
    }, 3000); // Display for 3 seconds
}
</script>


<div id="loginContainer" class="bg-black">
    <!-- The PHP content will be loaded here -->
</div>
