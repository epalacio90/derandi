<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 5/21/19
 * Time: 12:29 PM
 */
?>

<?php
if(isset($_GET['message']) && $_GET['message'] == 'success'){ ?>
    <div class="alert alert-dismissible alert-info">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Se han enviado tus datos, te contactaremos a la brevedad';
        ?>
    </div>
<?php } ?>

<center>
    <div class="card col-lg-5 defaultTopMargin">
        <header class="card-header">
            <h4 class="card-title mt-2">Información de mayoristas y distribuidores</h4>
        </header>
        <article class="card-body">
            <?php
            if(validation_errors() != ''){
                ?>
                <div class="alert alert-dismissible alert-danger">
                    <button type="button" class="close" data-dismiss="alert">&times;</button>
                    <strong>Oups!</strong>  <?php echo 'Error! : ' . validation_errors();
                    ?>
                </div>
                <?php

            } ?>
            <?php echo form_open('home/contact') ?>
            <div class="form-row">
                <div class="col form-group">
                    <label>Nombre *</label>
                    <input type="text" name="name" class="form-control" placeholder="">
                </div> <!-- form-group end.// -->
                <div class="col form-group">
                    <label>Apellido(s) *</label>
                    <input type="text" name="last_name" class="form-control" placeholder="">
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->
            <div class="form-group">
                <label>Email *</label>
                <input type="email" name="email" id="email" class="form-control" oninput="validateConfirmation()"  placeholder="">
                <small class="form-text text-muted">Nunca compartiremos tu email con nadie.</small>
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Teléfono *</label>
                <input type="number" name="phone" id="phone" class="form-control" onkeypress="validate(event)" placeholder="">
                <small class="form-text text-muted">Nunca compartiremos tu teléfono con nadie.</small>
            </div> <!-- form-group end.// -->
            <div class="form-group">
                <label>Dirección</label>
                <input type="text" name="address" id="address" class="form-control" placeholder="">
                <small class="form-text text-muted">Nunca compartiremos tu dirección con nadie.</small>
            </div> <!-- form-group end.// -->




            <div class="form-group">
                <input type="submit" name="submit" value="Aceptar" id="submit_button" class="btn disabled" />
            </div> <!-- form-group// -->
            <?php echo form_close() ?>
        </article> <!-- card-body end .// -->

    </div> <!-- card.// -->

</center>

<script>
    function validateConfirmation(){
        var email;
        email = document.getElementById("email").value;

            if(validateEmail(email)){
                document.getElementById("email").setAttribute('class', 'form-control has-success ');
                document.getElementById("submit_button").setAttribute('class', 'btn btn-primary');
            }else{
                document.getElementById("email").setAttribute('class', 'form-control has-error');
                document.getElementById("submit_button").setAttribute('class', 'btn disabled');
            }


    }
    function validateEmail(email) {
        var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        return re.test(String(email).toLowerCase());
    }

    function validate(evt) {
        var theEvent = evt || window.event;

        // Handle paste
        if (theEvent.type === 'paste') {
            key = event.clipboardData.getData('text/plain');
        } else {
            // Handle key press
            var key = theEvent.keyCode || theEvent.which;
            key = String.fromCharCode(key);
        }
        var regex = /[0-9]|\./;
        if( !regex.test(key) ) {
            theEvent.returnValue = false;
            if(theEvent.preventDefault) theEvent.preventDefault();
        }
    }
</script>
