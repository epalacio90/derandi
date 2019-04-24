<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/23/19
 * Time: 10:24 PM
 */


    if(isset($_GET['message']) && $_GET['message'] == 'moveSuccess'){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Se ha agregado correctamente el movimiento';
        ?>
    </div>
<?php } ?>

<h3 class="title is-3">Stock -  <?= $movement[0]->warehouse ?> -  <?= $movement[0]->product ?> -  <?= $movement[0]->variant ?></h3>
<div class="column">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>

            <th>Producto<br> </th>
            <th>Variante<br></th>
            <th>Almacén<br></th>
            <th>Descripción<br></th>
            <th>Fecha<br></th>
            <th>Cantidad<br></th>
            <th>Acciones<br></th>


        </tr>
        </thead>
        <tbody>
        <?php foreach ($movement as $p): ?>
        <tr>
            <td><?= $p->product ?></td>
            <td><?= $p->variant ?></td>
            <td><?= $p->warehouse ?></td>
            <td><?= $p->description ?></td>
            <td><?= $p->movement_date ?></td>
            <td><?= $p->quantity ?></td>
            <td></td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <?php echo form_open('product/manageStock?productVariation='.$_GET['productVariation'].'&warehouse='.$_GET['warehouse'].'&product='.$_GET['product']) ?>
            <td><?= $movement[0]->product ?></td>
            <td><?= $movement[0]->variant ?></td>
            <td><?= $movement[0]->warehouse ?></td>
            <td><input type="text" name="description" class="form-control"></td>
            <td><?= $movement[0]->movement_date ?></td>
            <td><input type="text" name="quantity" class="form-control"></td>
            <td><input type="submit" value="Agregar"  class="btn btn-primary"></td>
            <?php echo form_close() ?>
        </tr>
        </tbody>
    </table>
    <p><?php echo $links; ?></p>
</div>


