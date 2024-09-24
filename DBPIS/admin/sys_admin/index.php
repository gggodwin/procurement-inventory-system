
<?php 
include ("../../misc/page_loader.php"); 
?>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" type="text/css" href="../../../css/page_loader.css" />
<script>
    $(document).ready(function() {
        setTimeout(function() {
            $(".loader-wrapper").fadeOut("slow", function() {
                window.location.href = 'main_admin.php';
            });
        }, 2000); // 800 milliseconds
    });
</script>



