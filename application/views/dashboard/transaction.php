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

            <th>Status</th>
        </tr>
        </thead>
        <tbody>
        <?php
        //TODO: Terminar esta vista
        foreach ($transactions as $transaction): ?>
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

