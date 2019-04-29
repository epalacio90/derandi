<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 12:05 AM
 */
?>





<?php
if(isset($_GET['message']) && $_GET['message'] == 'moveStockSuccess'){ ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Se afectó correctamente el stock.';
        ?>
    </div>
<?php }
    if(isset($_GET['message']) && $_GET['message'] == 'moveSuccess'){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Se ha agregado correctamente el movimiento';
        ?>
    </div>
<?php }  if(isset($_GET['message']) && $_GET['message'] == 'moveFail'){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Se ha agregado correctamente el movimiento';
        ?>
    </div>
<?php } ?>

<div clas="container">
    <div class="row">

        <div class="col-lg-12">
            <div class="card">
                <header class="card-header">

                    <h4 class="card-title mt-2">Detalle de producto</h4>
                </header>
                <article class="card-body">

                    <div class="form-row">
                        <div class="col form-group">
                            <label>SKU</label><br>
                            <b><?= $product[0]->sku ?></b>
                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Nombre</label><br>
                            <b><?= $product[0]->name ?></b>
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->

                    <div class="form-row">
                        <div class="col-lg-5 form-group">
                            <label>Precio</label><br>
                            <b>$<?= $product[0]->public_price ?></b>
                        </div> <!-- form-group end.// -->
                        <div class="col-lg-5 form-group">
                            <label>Precio mínimo</label><br>
                            <b>$<?= $product[0]->min_price ?></b>
                        </div> <!-- form-group end.// -->
                        <div class="col-lg-2 form-group">
                            <label>Producto público</label><br>
                            <b><?php  if($product[0]->selling) echo 'Sí'; else echo 'No' ?></b>
                        </div> <!-- form-group end.// -->
                    </div> <!-- form-row end.// -->

                    <div class="form-row">
                        <div class="form-group col">
                            <label>Marca</label><br>
                            <b><?= $brandSelected[0]->name ?> </b>


                        </div> <!-- form-group end.// -->
                        <div class="col form-group">
                            <label>Descuento</label><br>
                            <b>$<?= $product[0]->discount ?></b>
                        </div> <!-- form-group end.// -->
                    </div>



                    <div class="form-group">
                        <label>Descripción</label>
                        <div id="editor" >
                            <?= $product[0]->description ?>
                        </div>
                    </div>

                    <input type="hidden" name="description" id="description">






                </article> <!-- card-body end .// -->

            </div> <!-- card.// -->
        </div>

    </div>
</div>



<div clas="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <header class="card-header">

                    <h4 class="card-title mt-2">Variantes</h4>
                </header>
                <article class="card-body">


                    <div class="column">
                        <table class="table table-responsive is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Almacén</th>
                                <th>Stock</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($product as $p): ?>
                                <tr>

                                    <td><?= $p->variation ?></td>
                                    <td><?= $p->warehouse ?></td>
                                    <td><?= $p->quantity ?></td>
                                    <td><?php if($auth_level==9){ ?><a href="<?php echo site_url('product/manageStock?productVariation='.$p->variation_id.'&warehouse='.$p->warehouse_id.'&product='.$_GET['product']) ?>" class="btn btn-primary">Manejar Stock</a><?php } ?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
        </div>
    </div>
</div>

<?php if($auth_level == 9){ ?>
    <br><a href="<?php echo site_url('product/editProduct?product='.$_GET['product']) ?>" class="btn btn-primary">Editar producto y variantes</a>
<?php } ?>

