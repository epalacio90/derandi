<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 7:18 PM
 */
?>

<center>
    <div class="card  col-lg-5 defaultTopMargin">
        <article class="card-body">

            <?php

            if(isset($_GET['message']) && $_GET['message'] == 'passRecovery'){ ?>
            <div class="alert alert-dismissible alert-success">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                <strong>Done!</strong>  <?php echo ' ' . 'Un correo será enviado a su email con su nueva constraseña';
                ?>
            </div>
            <?php } ?>
            <a href="<?php echo site_url('dashboard/create_public_user') ?>" class="float-right btn btn-outline-primary">Crear cuenta</a>
            <h4 class="card-title mb-4 mt-1">Iniciar sesión</h4>
            <?php echo form_open( $login_url ) ?>
                <div class="form-group">
                    <label>Email</label>
                    <input name="login_string" class="form-control" placeholder="Email" type="email">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <a class="float-right" href="<?php echo site_url('dashboard/recoverPass') ?>">Olvidaste tu contraseña?</a>
                    <label>Contraseña</label>
                    <input name="login_pass" class="form-control" placeholder="******" type="password">
                </div> <!-- form-group// -->
                <div class="form-group">
                    <div class="checkbox">
                        <label> <input type="checkbox" name="remember_me" value="yes"> Recordarme </label>
                    </div> <!-- checkbox .// -->

                </div> <!-- form-group// -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-block"> Iniciar Sesión  </button>
                </div> <!-- form-group// -->
            <? echo form_close(); ?>
        </article>
    </div> <!-- card.// -->
</center>



