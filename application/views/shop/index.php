<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 11:20 PM
 */
?>

<!-- ========================= SECTION CONTENT ========================= -->
<section class="section-content bg padding-y-sm">
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="row py-3">
                    <div class="col-lg-3">
                        <strong>Buscar:</strong>
                    </div>
                    <div class="col-lg-6 ">
                        <input type="text" class="form-control" id="search" placeholder="Buscar SKU/Nombre/descripción" onkeypress="">
                    </div>
                </div>
                <strong >Filtrar por marca:</strong>
                <div class="row py-2">
                    <?php foreach ($brand as $p){ ?>
                        <a href="<?= site_url('shop?brand='. $p->id) ?>" class="btn <?php if ( isset($_GET['brand']) && $_GET['brand'] == $p->id ){ echo 'btn-success'; }else{ echo 'btn-primary'; } ?> " ><?= $p->name ?></a> &nbsp;
                    <?php } ?>
                </div>

            </div> <!-- card-body .// -->
        </div> <!-- card.// -->


        <div class="padding-y-sm">
            <div class="row">
                <div class="col-lg-7"><span><?= $total ?> resultados</span></div>
                <div class="col-lg-5"><div class="pagination"><?php echo $links; ?></div></div>
            </div>

        </div>

        <div class="row-sm">
            <?php foreach ($product as $p){ ?>
            <div class="col-md-3 col-sm-6">
                <a href="<?php echo site_url('shop/product?product='.$p->id.'&productVariation='.$p->var_id) ?>" class="title">
                    <figure class="card card-product">
                        <div class="img-wrap"> <img src="<?php echo base_url('assets/images/product/'.$p->path) ?>"></div>
                        <figcaption class="info-wrap">
                            <?= $p->name ?>
                            <div class="price-wrap">
                                <?php if ($p->discount >0 && ((100 - $p->discount) * $p->public_price /100 >= $p->min_price) ){ ?>
                                    <span class="price-new"><?php echo '$'.number_format((100 - $p->discount) * $p->public_price/100, 2) ?></span>
                                    <del class="price-old"><?= '$'. $p->public_price ?></del>
                                <?php }else{ ?>
                                    <span class="price-new"><?= '$'. $p->public_price ?></span>
                                <?php } ?>
                            </div> <!-- price-wrap.// -->
                        </figcaption>
                    </figure> <!-- card // -->
                </a>
            </div> <!-- col // -->
            <?php } ?>
        </div> <!-- row.// -->
        <div class="padding-y-sm">
            <div class="row">
                <div class="col-lg-7"><span><?= $total ?> resultados</span></div>
                <div class="col-lg-5"><div class="pagination"><?php echo $links; ?></div></div>
            </div>

        </div>


    </div><!-- container // -->
</section>
<!-- ========================= SECTION CONTENT .END// ========================= -->

<script >
    $("#search").on('keyup', function (e) {
        if (e.keyCode == 13) {
            url = "<?php echo site_url('shop?search=') ?>" + document.getElementById('search').value;
            urlEnconded= encodeURI(url);
            window.location.href = urlEnconded;

        }
    });

</script>