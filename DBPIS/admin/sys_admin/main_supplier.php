<?php
session_start(); 
$current_page = 'supplier';
$page_number = 6;
include ("../../misc/header_main.php");
include ("../../misc/sidebar.php");
include ("../../misc/navbar.php");
include ("supplier/supp.php");
include ("../../misc/footer_main.php");
?>