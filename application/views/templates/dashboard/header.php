<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 4:29 PM
 */
?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>D'erandi - Dashboard</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo base_url('assets/private/vendor/fontawesome-free/css/all.min.css') ?>" rel="stylesheet" type="text/css">

  <!-- Page level plugin CSS-->
  <link href="<?php echo base_url('assets/private/vendor/datatables/dataTables.bootstrap4.css')?>" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="<?php echo base_url('assets/private/css/sb-admin.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/public/css/style.css?v=2')?>" rel="stylesheet" type="text/css"/>

</head>
<body id="page-top">

<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

    <a class="navbar-brand mr-1" href="index.html">D'erandí Panel</a>

    <button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Navbar Search -->
    <div class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">

    </div>

    <!-- Navbar -->
    <ul class="navbar-nav ml-auto ml-md-0">
        <li class="nav-item dropdown no-arrow">
            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-circle fa-fw"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="<?php echo site_url('dashboard/changePass') ?>">Cambiar contraseña</a>

                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Salir</a>
            </div>
        </li>
    </ul>

</nav>

<div id="wrapper">

    <ul class="sidebar navbar-nav">
        <li class="nav-item active">
            <a class="nav-link" href="<?php echo site_url('dashboard') ?>">
                <i class="fas fa-fw fa-tachometer-alt"></i>
                <span>Panel</span>
            </a>
        </li>
        <?php if($auth_level > 3){ ?>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="pagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-fw fa-table"></i>
                <span>Productos</span>
            </a>
            <div class="dropdown-menu" aria-labelledby="pagesDropdown">
                <h6 class="dropdown-header">General:</h6>
                <a class="dropdown-item" href="<?php echo site_url('product') ?>">Productos</a>
                <a class="dropdown-item" href="<?php echo site_url('warehouse') ?>">Almacenes</a>
                <div class="dropdown-divider"></div>
                <?php if($auth_level == 9){ ?>
                <h6 class="dropdown-header">Administración:</h6>
                <a class="dropdown-item" href="<?php echo site_url('product/brand') ?>">Marcas</a>
                <a class="dropdown-item" href="<?php echo site_url('product/addProduct') ?>">Agregar producto</a>
                <?php } ?>
            </div>
        </li>

        <?php } ?>


        <li class="nav-item">
            <a class="nav-link" href="<?php echo site_url() ?>">
                <i class="fas fa-fw fa-arrow-left"></i>
                <span>Ir a página</span></a>

        </li>
    </ul>
    <div id="content-wrapper">
        <div class="container-fluid">