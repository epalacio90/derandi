<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/17/19
 * Time: 4:07 PM
 */

?>
<!DOCTYPE HTML>
<html lang="es">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="Derandi" content="La mejor marca de ropa al mejor precio">

<title>D'erandí</title>

<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url('assets/public/images/favicon.ico') ?>">

<!-- jQuery -->
<script src="<?php echo base_url('assets/public/js/jquery-2.0.0.min.js') ?>" type="text/javascript"></script>

<!-- Bootscss
gulpfile.js
js
scss
vendortrap4 files-->
<script src="<?php echo base_url('assets/public/js/bootstrap.bundle.min.js') ?>" type="text/javascript"></script>
<link href="<?php echo base_url('assets/public/css/bootstrap.css')?>" rel="stylesheet" type="text/css"/>

<!-- Font awesome 5 -->
<link href="<?php echo base_url('assets/public/fonts/fontawesome/css/fontawesome-all.min.css')?>" type="text/css" rel="stylesheet">

<!-- plugin: fancybox  -->
<script src="<?php echo base_url('assets/public/plugins/fancybox/fancybox.min.js')?>" type="text/javascript"></script>
    <link href="<?php echo base_url('assets/public/plugins/fancybox/fancybox.min.css')?>" type="text/css" rel="stylesheet">

    <!-- plugin: owl carousel  -->
    <link href="<?php echo base_url('assets/public/plugins/owlcarousel/assets/owl.carousel.min.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/public/plugins/owlcarousel/assets/owl.theme.default.css')?>" rel="stylesheet">
    <script src="<?php echo base_url('assets/public/plugins/owlcarousel/owl.carousel.min.js')?>"></script>

    <!-- plugin: slickslider -->
    <link href="<?php echo base_url('assets/public/plugins/slickslider/slick.css')?>" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url('assets/public/plugins/slickslider/slick-theme.css')?>" rel="stylesheet" type="text/css" />
    <script src="<?php echo base_url('assets/public/plugins/slickslider/slick.min.js')?>"></script>

<!-- custom style -->
<link href="<?php echo base_url('assets/public/css/ui.css')?>" rel="stylesheet" type="text/css"/>
<link href="<?php echo base_url('assets/public/css/responsive.css')?>" rel="stylesheet" media="only screen and (max-width: 1200px)" />
    <link href="<?php echo base_url('assets/public/css/style.css?v=2')?>" rel="stylesheet" type="text/css"/>

<!-- custom javascript -->
<script src="<?php echo base_url('assets/public/js/script.js')?>" type="text/javascript"></script>

<script type="text/javascript">
/// some script

// jquery ready start
$(document).ready(function() {
	// jQuery code

});
// jquery end
</script>

</head>

<?php
    echo '<body>';
?>

<!-------- NAV BAR START --------->
<nav class="navbar navbar-expand-lg navbar-dark bg-navBar">
    <a class="navbar-brand" href="#"> <img class="logo" src="<?php echo base_url('assets/public/images/derandi/derandi_logo.png') ?>"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbar1">
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Inicio<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item"><a class="nav-link" href="#"> Tienda </a></li>
            <li class="nav-item"><a class="nav-link" href="#"> Acerca de </a></li>
            <li class="nav-item">
                <a class="btn ml-2 btn-primary" href="<?php echo site_url('dashboard/login') ?>">Inicio de sesión</a></li>
        </ul>
    </div>
</nav>

<!-- NAV BAR END ------------>

<?php
  //This will open a general component only if it is not set to the opposite
  if(isset($container) && $container == false){

  }else{
      echo '<div class="container generalCont">';
  }
?>
