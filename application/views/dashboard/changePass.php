<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/22/19
 * Time: 12:55 PM
 */
?>

<center>
    <div class="card col-lg-5 defaultTopMargin">
        <header class="card-header">
            <h4 class="card-title mt-2">Cambiar contraseña</h4>
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
            <?php echo form_open('dashboard/changePass') ?>

            <div class="form-group" id="passContainer">
                <label>Nueva Contraseña</label>
                <input type="password" class="form-control" name="pass1" id="pass" oninput="validateStrength()" placeholder="Password">
            </div>



            <div class="form-group " id="pass1Container">
                <label>Confirmar Contraseña</label>
                <input type="password" name="pass1" class="form-control" id="pass1" oninput="validateConfirmation()" placeholder="Password">

            </div>

            <div class="form-group">
                <input type="submit" name="submit" value="Aceptar" id="submit_button" class="btn disabled" />
            </div> <!-- form-group// -->

            <?php echo form_close() ?>
        </article> <!-- card-body end .// -->

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

        if(val.length >= 8 && val1 == val ){
            document.getElementById("pass1").setAttribute('class', 'form-control has-success ');
            document.getElementById("submit_button").setAttribute('class', 'btn btn-primary');


        }else{
            document.getElementById("pass1").setAttribute('class', 'form-control has-error');
            document.getElementById("submit_button").setAttribute('class', 'btn disabled');
        }

    }


</script>
