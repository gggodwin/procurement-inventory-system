<?php
session_start(); 
$current_page = 'department';
$page_number = 5;
include ("../../misc/header_main.php");
include ("../../misc/sidebar.php");
include ("../../misc/navbar.php");
include ("department/dept.php");
include ("../../misc/footer_main.php");
?>