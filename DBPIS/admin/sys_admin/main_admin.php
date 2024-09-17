<?php include ("../../misc/page_loader.php"); ?>
<!DOCTYPE html>
<html>
  <head>
    <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../../../css/page_loader.css" />
  </head>
  <body>
    <div class="content">
      <img src="https://picsum.photos/300/300/?random" />
    </div>
    <script>
        $(document).ready(function() {
            setTimeout(function() {
                $(".loader-wrapper").fadeOut("slow");
            }, 800); // 2000 milliseconds = 2 seconds
        });
    </script>
  </body>
</html>
