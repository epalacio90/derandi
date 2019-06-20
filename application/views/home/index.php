<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/17/19
 * Time: 4:56 PM
 */
?>

<!-- ========================= SECTION INTRO ========================= -->
<section id="principalCarrousel" class="section-intro bg-secondary text-white text-center bgImage0">
    <div class="container d-flex flex-column "  style="min-height:80vh;">



    </div>
</section>
<!-- ========================= SECTION INTRO END// ========================= -->
<section class="section-content padding-y">
    <div class="row">
        <div class="col-lg-8 col-sm-12 text-center mx-auto">


        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-md-8 col-sm-12 mx-auto text-center">

            <ul class="list-inline my-5">

                <li class="list-inline-item">
                    <a class="h4 text-light p-2" href="https://www.facebook.com/derandi.elegancia/">
                        <img src="<?php echo base_url('assets/public/images/logos/facebook.png') ?>" style="max-width: 30px">
                    </a>
                </li>

                <li class="list-inline-item">
                    <a class="h4 text-light p-2" href="https://www.instagram.com/derandi.elegancia/">
                        <img src="<?php echo base_url('assets/public/images/logos/instagram.jpg') ?>" style="max-width: 30px">
                    </a>
                </li>
            </ul>
        </div> <!-- col.// -->
    </div> <!-- row.// -->
    <div class="container europa">
        <center>
            <h1>Nosotros</h1>

            <p>Somos una empresa 100% mexicana con más de 25 años de experiencia, dedicada al diseño,
                fabricación y comercialización de blusas y blusones en tres diferentes tallas.
                Durante esta  trayectoria, nos hemos enfocado en ofrecer a nuestros clientes un
                extenso y diverso catálogo semanal de la más alta calidad a precios competitivos.</p>
        </center>
    </div>
</section>



<section class="section-content padding-y">

    <div class="container">
      <!--
        <header class="section-heading">
            <h2>Promociones</h2>
        </header><!-- sect-heading -->
        <!-- ========================= Promotions// ========================= -->
        <div class="row" style="display:none">
            <aside class="col-md-6">
                <!-- ================== 1-carousel bootstrap  ==================  -->
                <div id="carousel1_indicator" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carousel1_indicator" data-slide-to="0" class=""></li>
                        <li data-target="#carousel1_indicator" data-slide-to="1" class="active"></li>
                        <li data-target="#carousel1_indicator" data-slide-to="2" class=""></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php // echo base_url('assets/images/banners/slide1.jpg')?>" alt="First slide">
                        </div>
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?php // echo base_url('assets/images/banners/slide2.jpg')?>" alt="Second slide">
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php //echo base_url('assets/images/banners/slide3.jpg')?>" alt="Third slide">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel1_indicator" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel1_indicator" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- ==================  1-carousel bootstrap ==================  .// -->
            </aside> <!-- col.// -->
            <aside class="col-md-6">
                <!-- 2-carousel bootstrap -->
                <div id="carousel2_indicator" class="carousel slide carousel-fade" data-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php //echo base_url('assets/images/banners/slide1.jpg')?>" alt="First slide">
                            <article class="carousel-caption d-none d-md-block">
                                <h5>First slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt.</p>
                            </article> <!-- carousel-caption .// -->
                        </div>
                        <div class="carousel-item">
                            <img class="d-block w-100" src="<?php //echo base_url('assets/images/banners/slide2.jpg')?>" alt="Second slide">
                            <article class="carousel-caption d-none d-md-block">
                                <h5>Second slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt.</p>
                            </article> <!-- carousel-caption .// -->
                        </div>
                        <div class="carousel-item active">
                            <img class="d-block w-100" src="<?php //echo base_url('assets/images/banners/slide3.jpg')?>" alt="Third slide">
                            <article class="carousel-caption d-none d-md-block">
                                <h5>Third slide label</h5>
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                                    tempor incididunt</p>
                            </article> <!-- carousel-caption .// -->
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carousel2_indicator" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carousel2_indicator" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <!-- ==================  2-carousel bootstrap.// ==================  -->
            </aside>
        </div>
        <!-- ========================= PROMOTIONS END// ========================= -->
        <!-- ========================= Product Carrousel start// ========================= -->
        <header class="section-heading">
            <h2>Productos </h2>
        </header><!-- sect-heading -->
        <div class="row">
            <div id="myProducts" class="owl-carousel owl-init owl-loaded " data-items="5" data-margin="0" data-dots="false" data-nav="true">
                <div class="owl-stage-outer"><div class="owl-stage" style="transform: translate3d(-1270px, 0px, 0px); transition: 0s; width: 4064px;">
                        <?php foreach ($product as $p){ ?>
                        <div class="owl-item cloned" style="width: 234px; margin-right: 20px;">
                            <div class="item-slide">
                                <a href="<?php echo site_url('shop/product?product='.$p->id.'&productVariation='.$p->var_id) ?>">
                                <figure class="card card-product border-white">
                                    <div class="img-wrap"> <img src="<?php echo base_url('assets/images/product/'.$p->path)?>"> </div>
                                   <!-- <figcaption class="info-wrap text-center">
                                        <h6 class="title text-truncate"><a href="<?php echo site_url('shop/product?product='.$p->id.'&productVariation='.$p->var_id) ?>"><?= $p->name ?></a></h6>
                                    </figcaption> -->
                                </figure> <!-- card // -->
                                </a>
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- ========================= Product Carrousel End// ========================= -->


    </div> <!-- container .//  -->
</section>
<!-- ========================= SECTION CONTENT END// ========================= -->

<script>
    var i = 1;
    var remove, add;
    $( document ).ready(function() {
       moveCarrousel(i);

    });

    function moveCarrousel(id){

        setTimeout(function(){

            add=id % 5;
            console.log(add);
            if (add == 0){
                remove=4;
            }else{
                remove = add - 1;
            }
            document.getElementById('principalCarrousel').classList.remove('bgImage'+remove);
            document.getElementById('principalCarrousel').classList.add('bgImage'+add);
            id++;
            moveCarrousel(id);

        }, 3000);
    }




</script>