<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/23/19
 * Time: 8:17 PM
 */
?>



<h3 class="title is-3">Almacenes</h3>
<div class="column">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($warehouse as $p): ?>
            <tr>

                <td><?= $p->name ?></td>
                <td><a href="<?php echo site_url('product?warehouse='.$p->id)?>">Ver existencias</a></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <?php echo form_open('warehouse') ?>
                <td><input class="form-control" type="text" name="name"></td>
                <td><input class="btn btn-primary" type="submit" value="Agregar"></td>
            <?php echo form_close() ?>
        </tr>
        </tbody>
    </table>
</div>

