<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 9:51 PM
 */
?>

<center>
<div class="card col-lg-5 defaultTopMargin">
    <header class="card-header">
        <a href="<?php echo site_url('dashboard/login') ?>" class="float-right btn btn-outline-primary mt-1">Iniciar sesión</a>
        <h4 class="card-title mt-2">Crear cuenta</h4>
    </header>
    <article class="card-body">
        <?php
        if(validation_errors() != ''){
        ?>
        <div class="alert alert-dismissible alert-danger">
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <strong>Oups!</strong>  <?php echo 'Form Error : ' . validation_errors();
            ?>
        </div>
        <?php

            } ?>
        <?php echo form_open('dashboard/create_public_user') ?>
            <div class="form-row">
                <div class="col form-group">
                    <label>Nombre</label>
                    <input type="text" name="name" class="form-control" placeholder="">
                </div> <!-- form-group end.// -->
                <div class="col form-group">
                    <label>Apellido(s)</label>
                    <input type="text" name="last_name" class="form-control" placeholder="">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->
            <div class="form-group">
                <label>Email address</label>
                <input type="email" name="email" id="email" class="form-control" oninput="validateConfirmation()"  placeholder="">
                <small class="form-text text-muted">Nunca compartiremos tu email con nadie.</small>
            </div> <!-- form-group end.// -->


            <div class="form-group" id="passContainer">
                    <label>Crear Contraseña</label>
                    <input type="password" class="form-control" name="pass1" id="pass" oninput="validateStrength()" placeholder="Password">
            </div>



            <div class="form-group " id="pass1Container">
                <label>Confirmar Contraseña</label>
                <input type="password" name="pass1" class="form-control" id="pass1" oninput="validateConfirmation()" placeholder="Password">

            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Aceptar" id="submit_button" class="btn disabled" />
            </div> <!-- form-group// -->
            <small class="text-muted">Al hacer click en Aceptar declaras que aceptas nuestros <br> Términos y Condiciones y Política de privacidad.</small>
        <?php echo form_close() ?>
    </article> <!-- card-body end .// -->
    <div class="border-top card-body text-center">Ya tienes cuenta? <a href="<?php echo site_url('dashboard/login') ?>">Inicia Sesión</a></div>
</div> <!-- card.// -->

</center>

<script>
    function validateStrength(){
        val = document.getElementById("pass").value;
        if(val.length >= 8 ){
            document.getElementById("pass").setAttribute('class', 'form-control has-success ');
        }else{
            document.getElementById("pass").setAttribute('class', 'form-control has-error');
        }
    }

    function validateConfirmation(){
        val = document.getElementById("pass").value;
        val1 = document.getElementById("pass1").value;
        email = document.getElementById("email").value;
        if(val.length >= 8 && val1 == val ){
            document.getElementById("pass1").setAttribute('class', 'form-control has-success ');
            if(validateEmail(email)){
                document.getElementById("email").setAttribute('class', 'form-control has-success ');
                document.getElementById("submit_button").setAttribute('class', 'btn btn-primary');
            }else{
                document.getElementById("email").setAttribute('class', 'form-control has-error');
                document.getElementById("submit_button").setAttribute('class', 'btn disabled');
            }

        }else{
            document.getElementById("pass1").setAttribute('class', 'form-control has-error');
            document.getElementById("submit_button").setAttribute('class', 'btn disabled');
        }

    }

    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }
</script>