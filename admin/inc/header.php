<?php
  include "controllers/Database.php";
  ob_start();
  session_start();

  $db = new Database();

  // To check the User if Session Data found
  if ( empty( $_SESSION['email'] ) || empty( $_SESSION['password'] ) ){
    header("Location: ../index.php");
  }
  $data_web = array(
    'where' =>array(
      'web_id' => 1
    ),
    'return_type' => 'single'
  );
  $webinfo = $db->select('web_info',$data_web);
  
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- <meta http-equiv="refresh" content="30;url=logout.php?time=30&action=Logout" /> -->
  <!-- <link rel="shortcut icon" href="img/settings/<?=$web_Fav;?>" type="image/x-icon"> -->
  <title>SMSW | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
  <!-- DATA TABLE -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-select/ss/select.bootstrap4.min.css">

  <!-- TIME PCIKER PLUGIN -->
  <link rel="stylesheet" href="plugins/MDTimePicker/mdtimepicker.min.css">

  <!-- MicroToolTip -->
  <link rel="stylesheet" href="plugins/microtip/microtip.min.css">

  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/style.css"> -->
  <!-- SWEET ALERT 2 -->
  <!-- <script src="../assets/js/toastr.min.js"></script> -->
  <!-- <link rel="stylesheet" href="../assets/css/toastr.min.css">   -->

  <link rel="stylesheet" href="plugins/sweetalert2/sweetalert2.min.css">  

  <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">

  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">

  <!-- CUSTOM STYLE -->
  <link rel="stylesheet" href="assets/css/style.css">

  <style>
    .table-img{
      height: 50px;
      width: 50px;
      border-radius: 50%;
    }
    .sidebar-navy{
      background-color: #001429!important;
    }
  </style>

</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">