<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 6:12 PM
 */
?>

<h3 class="title is-3">Información General</h3>
<div class="column">
    <table class="table table-responsive is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>Email</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Número de autorización</th>
            <th>Ciudad</th>
            <th>Dirección</th>
            <th>Colonia</th>
            <th>Código postal</th>

            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $sent;
        $transaction_id;
        foreach ($transaction as $transaction): $transaction_id = $transaction->id;?>
            <tr>

                <td><?= $transaction->username ?></td>
                <td><?= $transaction->transaction_date ?></td>
                <td><?= $transaction->total_amount ?></td>
                <td><?= $transaction->auth?></td>
                <td><?= $transaction->city?></td>
                <td><?= $transaction->shippingAddress1?></td>
                <td><?= $transaction->shippingAddress2?></td>
                <td><?= $transaction->zip?></td>
                <td><?php if($transaction->sent){
                        $sent = $transaction->sent;
                        echo 'Enviado';
                    }else{
                        echo 'Pendiente de envío';
                    } $sent = $transaction->sent; ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <table class="table table-responsive is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>Producto</th>
            <th>Variante</th>
            <th>Cantidad</th>

        </tr>
        </thead>
        <tbody>
        <?php

        foreach ($transaction_detail as $transaction): ?>
            <tr>

                <td><?= $transaction->name ?></td>
                <td><?= $transaction->variant ?></td>
                <td><?= $transaction->quantity ?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <?php
        if($auth_level == 9){
            if(!$sent){
                echo form_open('dashboard/sendTransaction');

                ?>
                <div class="row">
                    <div class="col-lg-3">
                        <select name="warehouse" class="form-control">
                            <?php foreach($warehouse as $w){ ?>
                            <option value="<?= $w->id ?>"><?= $w->name ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="col-lg-3">
                        <input type="hidden" name="transaction_id" value="<?= $transaction_id ?>">
                        <input type="submit" class="btn btn-primary">
                    </div>
                </div>


                <?php
                echo form_close() ;
            }
        }
    ?>

</div>

