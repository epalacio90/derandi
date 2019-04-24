<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 1:05 PM
 */
?>
<?php
    if(isset($_GET['message']) && $_GET['message'] == 'passChanged'){ ?>
    <div class="alert alert-dismissible alert-success">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Su contraseña se ha cambiado satisfactoriamente';
        ?>
    </div>
<?php } ?>

<h3 class="title is-3">Transacciones</h3>
<div class="column">
    <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>Acciones</th>
            <th>Email</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Número de autorización</th>
            <th>Ciudad de envío</th>
            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($transactions as $transaction): ?>
            <tr>
                <td><a href="<?php echo site_url('dashboard/transaction?transaction='.$transaction->id)?>">Ver detalle</a></td>
                <td><?= $transaction->username ?></td>
                <td><?= $transaction->transaction_date ?></td>
                <td><?= $transaction->total_amount ?></td>
                <td><?= $transaction->auth?></td>
                <td><?= $transaction->city?></td>
                <td><?php if($transaction->sent){
                    echo 'Enviado';
                    }else{
                    echo 'Pendiente de envío';
                    }?></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p><?php echo $links; ?></p>
</div>
