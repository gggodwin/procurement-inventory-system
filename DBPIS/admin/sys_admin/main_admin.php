
<?php 
include ("../../misc/page_loader.php"); 
include ("../../misc/header_main.php");
include ("../../misc/sidebar.php");
include ("../../misc/navbar.php");
include ("../../misc/footer_main.php");
?>


    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../css/page_loader.css" />
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".loader-wrapper").fadeOut("slow");
            }, 800); // 2000 milliseconds = 2 seconds
        });
    </script>


