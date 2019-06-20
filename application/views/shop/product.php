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
        <div class="padding-y-ssm">
            <p>Tienda > Detalle de producto</p>
        </div>
        <div class="row">
            <div class="col-lg-12">


                <main class="card">
                    <div class="row no-gutters">
                        <aside class="col-sm-6 border-right">
                            <article class="gallery-wrap">
                                <div class="img-big-wrap">
                                    <div> <a href="<?php echo base_url('assets/images/product/') .$product[0]->path ?>" id="imgLink" data-fancybox=""><img id="imgCont" src="<?php echo base_url('assets/images/product/') .$product[0]->path ?>"></a></div>
                                </div> <!-- slider-product.// -->
                                <div class="img-small-wrap">
                                    <?php foreach($product as $p){ ?>
                                        <div class="item-gallery" onclick="swtichPic('<?php echo base_url('assets/images/product/') .$p->path ?>')" > <img src="<?php echo base_url('assets/images/product/') .$p->path ?>"> </div>
                                    <?php } ?>

                                </div> <!-- slider-nav.// -->
                            </article> <!-- gallery-wrap .end// -->
                        </aside>
                        <aside class="col-sm-6">
                            <article class="card-body">
                                <!-- short-info-wrap -->
                                <h3 class="title mb-3"><?= $product[0]->name ?></h3>

                                <div class="mb-3">
                                    <var class="price h3 text-warning">
                                        <span class="currency">MXN </span><?php if ($product[0]->discount >0 && ((100 - $product[0]->discount) * $product[0]->public_price /100 >= $product[0]->min_price) ){ ?>
                                            <span class="price-new"><?php echo '$'.number_format((100 - $product[0]->discount) * $product[0]->public_price/100, 2) ?></span>
                                            <del class="price-old"><?= '$'. $product[0]->public_price ?></del>
                                        <?php }else{ ?>
                                            <span class="price-new"><?= '$'. $product[0]->public_price ?></span>
                                        <?php } ?>
                                    </var>
                                    <span>/pieza</span>
                                </div> <!-- price-detail-wrap .// -->
                                <dl>
                                    <dt>Marca</dt>
                                    <dd><img src="<?= base_url('assets/images/brand/').$product[0]->brandPath ?>" style="max-width: 200px; max-height: 200px"></dd>
                                </dl>
                                <dl class="row">
                                    <dt class="col-sm-3">SKU#</dt>
                                    <dd class="col-sm-9"><?= $product[0]->sku ?></dd>
                                    <dt class="col-sm-3">Variante:</dt>
                                    <dd class="col-sm-7">
                                        <select id="variantSelector" class="form-control" onchange="switchVariant()">
                                            <option   ><?= $product[0]->var ?></option>
                                            <?php foreach($productVariation as $v){ ?>
                                                <option  value="<?= $v->var_id ?>" ><?= $v->var ?></option>
                                            <?php } ?>
                                        </select></dd>


                                </dl>
                                <div class="rating-wrap">

                                    <ul class="rating-stars">
                                        <li style="width:100%" class="stars-active">
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                        <li>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </li>
                                    </ul>

                                </div> <!-- rating-wrap.// -->
                                <hr>
                                <div class="row">
                                    <div class="col-sm-5">
                                        <dl class="dlist-inline">
                                            <dt>Cantidad: </dt>
                                            <dd>
                                                <select id="quantity" class="form-control form-control-sm" style="width:70px;">
                                                    <option> 1 </option>
                                                    <option> 2 </option>
                                                    <option> 3 </option>
                                                    <option> 4 </option>
                                                    <option> 5 </option>
                                                    <option> 6 </option>
                                                    <option> 7 </option>
                                                    <option> 8 </option>
                                                    <option> 9 </option>
                                                    <option> 10 </option>
                                                </select>
                                            </dd>
                                        </dl>  <!-- item-property .// -->
                                    </div> <!-- col.// -->

                                </div> <!-- row.// -->
                                <hr>
                                <a href="#" class="btn  btn-primary" onclick="addToCart(<?= $_GET['productVariation'] ?>, document.getElementById('quantity').value )">Agregar al carrito </a>
                                <!-- short-info-wrap .// -->
                            </article> <!-- card-body.// -->
                        </aside> <!-- col.// -->
                    </div> <!-- row.// -->
                </main> <!-- card.// -->

                <!-- PRODUCT DETAIL -->
                <article class="card mt-3">
                    <div class="card-body">
                        <h4>Descripcion</h4>
                         <?= $product[0]->description ?>
                    </div> <!-- card-body.// -->
                </article> <!-- card.// -->

                <!-- PRODUCT DETAIL .// -->
                <!-- BRAND DETAIL -->
                <article class="card mt-3">
                    <div class="card-body">
                        <h4>Marca</h4>
                        <img src="<?= base_url('assets/images/brand/').$product[0]->brandPath ?>" style="max-width: 200px; max-height: 200px">
                        <?= $product[0]->brandDescription ?>
                    </div> <!-- card-body.// -->
                </article> <!-- card.// -->

                <!-- BRAND DETAIL .// -->

            </div> <!-- col // -->

        </div> <!-- row.// -->



    </div><!-- container // -->
</section>
<!-- ========================= SECTION CONTENT .END// ========================= -->

<!-- Add cart Modal-->
<div class="modal fade" id="addCartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Producto agregado</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Se ha agegado el producto al carrito</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Seguir comprando</button>
                <a class="btn btn-primary" href="<?= site_url('shop/cart') ?>" >Pagar ahora</a>
            </div>
        </div>
    </div>
</div>

<script>
    function swtichPic(url){
        document.getElementById('imgLink').href=url;
        document.getElementById('imgCont').src=url;
    }

    function switchVariant(){
        var url = "<?php echo site_url('shop/product?product='.$_GET['product'].'&productVariation=') ?>" + document.getElementById('variantSelector').value;
        var urlEnconded = encodeURI(url);
        console.log('entra');
        window.location.href = urlEnconded;

    }

    function addToCart(id, quantity){
        var url = "<?php echo site_url('shop/addToCart?productVariant=') ?>" + id +
            "&quantity="+quantity+"&name=<?= $product[0]->name ?>&price=<?php
                if ($product[0]->discount >0 && ((100 - $product[0]->discount) * $product[0]->public_price /100 >= $product[0]->min_price) )
                    echo (100 - $product[0]->discount) * $product[0]->public_price/100;
                else
                    echo $product[0]->public_price?>&path=<?= $product[0]->path ?>";

        var urlEncoded= encodeURI(url);

        console.log(urlEncoded);

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onreadystatechange = function () {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200)
                result = callback(xmlHttp.responseText);
        }
        xmlHttp.open("GET", urlEncoded, true); // true for asynchronous
        xmlHttp.send(null);
        $('#addCartModal').modal('show');
    }
</script>