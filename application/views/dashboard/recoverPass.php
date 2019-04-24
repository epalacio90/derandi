<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 11:38 PM
 */
?>
<center>

    <div class="card defaultTopMargin col-lg-6">
        <article class="card-body">
            <h4 class="card-title text-center mb-4 mt-1">Recuperar contraseña</h4>
            <hr>
            <?php echo form_open('dashboard/recoverPass') ?>
                <div class="form-group">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                        </div>
                        <input name="email" class="form-control" placeholder="Email or login" type="email">
                    </div> <!-- input-group.// -->
                </div> <!-- form-group// -->

                <div class="form-group">
                    <input type="submit" class="btn btn-primary btn-block" value="Enviar">
                </div> <!-- form-group// -->
                <p class="text-center">Un mail con su nueva contraseña será enviada a su correo electrónico</p>
            <?php echo form_close() ?>
        </article>
    </div> <!-- card.// -->


</center>
