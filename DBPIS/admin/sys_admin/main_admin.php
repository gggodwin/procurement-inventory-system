<?php
session_start();
$current_page = 'dashboard';
$page_number = 1;
include ("../../misc/header_main.php");
include ("../../misc/sidebar.php");
include ("../../misc/navbar.php");
include ("dashboard/data.php");
include ("../../misc/footer_main.php");
?>
