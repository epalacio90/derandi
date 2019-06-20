<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/23/19
 * Time: 10:24 PM
 */


    if(isset($_GET['message']) && $_GET['message'] == 'prodEditSuccess'){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'El producto ha sido editado satisfactoriamente';
        ?>
    </div>
<?php } ?>

<h3 class="title is-3">Productos <?php if(isset($warehouse)) echo ' - ' . $warehouse ?></h3>
<div class="column">
    <table class="table table-responsive is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <?php echo form_open('product') ?>
            <th>SKU<br><input style="max-width: 120px;" class="form-control" type="text" name="sku" placeholder="Buscar sku"> </th>
            <th>Nombre<br><input  class="form-control" type="text" name="name" placeholder="Buscar nombre"></th>
            <th>Descripción<br><input class="form-control" type="text" name="description" placeholder="Buscar descripción"></th>
            <?php if($auth_level == 9){ ?>
                <th style="vertical-align: top;">Precio público</th>
                <th style="vertical-align: top;">Precio mínimo</th>
                <th style="vertical-align: top;">Descuento</th>
                <th style="vertical-align: top;">Público</th>
            <?php }else{  ?>
                <th style="vertical-align: top;">Precio</th>
            <?php } ?>
            <th style="vertical-align: top;">Stock</th>
            <th style="vertical-align: top;">Acciones<br><input type="submit" value="Buscar"  class="btn btn-primary"></th>
            <?php echo form_close() ?>

        </tr>
        </thead>
        <tbody>
        <?php foreach ($product as $p): ?>
        <tr>
            <td><?= $p->sku ?></td>
            <td><?= $p->name ?></td>
            <td><?= $p->description ?></td>
            <?php if($auth_level == 9){ ?>
                <td><?= $p->public_price ?></td>
                <td><?= $p->min_price ?></td>
                <td><?= $p->discount ?></td>
                <td><?php if($p->selling){
                        echo 'Público';
                    }else{
                        echo 'Privado';
                    }?></td>
            <?php }else{  ?>
               <td> <?php if((100-$user[0]->discount)*$p->public_price/100 < $p->min_price) echo $p->min_price; else echo (100-$user[0]->discount)*$p->public_price/100  ?></td>
            <?php } ?>
            <td><?= $p->quantity ?></td>

            <td><a href="<?php echo site_url('product/detail?product='.$p->id) ?>" class="btn btn-primary">Ver detalle</a></td>
        </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <p class="links"><?php echo $links; ?></p>
</div>
<?php if($auth_level == 9){ ?>
    <a class="btn btn-primary" href="<?php echo site_url('product/addProduct') ?>">Agregar producto</a>
<?php }   ?>

