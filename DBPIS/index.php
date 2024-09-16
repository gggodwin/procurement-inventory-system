
<?php include ("misc/header.php"); ?>
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
<div id="loginContainer">
        <!-- The PHP content will be loaded here -->
</div>