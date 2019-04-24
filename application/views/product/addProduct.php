<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 12:05 AM
 */
?>



<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<?php
if(isset($_GET['message']) && $_GET['message'] == 'addProdFail'){ ?>
    <div class="alert alert-dismissible alert-danger">
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <strong>Done!</strong>  <?php echo ' ' . 'Algo falló, asegurate de llenar bien toda la información y vuelve a intentarlo.';
        ?>
    </div>
<?php } ?>

<div clas="container">
<div class="row">

<div class="col-lg-12">
    <div class="card">
        <header class="card-header">

            <h4 class="card-title mt-2">Nuevo producto</h4>
        </header>
        <article class="card-body">
            <?php echo form_open('product/addProduct', 'id=myForm') ?>
                <div class="form-row">
                    <div class="col form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" placeholder="SKU del producto">
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" placeholder="Nombre del producto">
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->

                <div class="form-row">
                    <div class="form-group col">
                        <label>Marca</label>
                        <select name="brand" class="form-control">
                            <option value="0">Selecciona una:</option>
                            <?php foreach($brand as $b){ ?>
                                <option value="<?= $b->id ?>"><?= $b->name ?></option>
                            <?php } ?>

                        </select>
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                        <label>Descuento</label>
                        <input type="number" name="discount" class="form-control" onkeypress="validate(event)" id="discount" placeholder="0">
                    </div> <!-- form-group end.// -->
                </div>

                <div class="form-row">
                    <div class="col-lg-5 form-group">
                        <label>Precio</label>
                        <input type="text" name="public_price" class="form-control" onkeypress="validate(event)" placeholder="Precio">
                    </div> <!-- form-group end.// -->
                    <div class="col-lg-5 form-group">
                        <label>Precio mínimo</label>
                        <input type="text" name="min_price" class="form-control" onkeypress="validate(event)" placeholder="Precio mínimo">
                    </div> <!-- form-group end.// -->
                    <div class="col-lg-2 form-group">
                        <label>Producto público</label>
                        <select name="selling" class="form-control">
                            <option value="0">No</option>
                            <option value="1">Sí</option>
                        </select>
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->

                <div class="form-group">
                    <label>Descripción</label>
                    <div id="editor" style="min-height: 250px"></div>
                </div>

            <input type="hidden" name="description" id="description">

            <?php echo form_close() ?>
            <div class="form-group">
                <button onclick="submitForm()" class="btn btn-primary btn-block">Agregar producto </button>
            </div> <!-- form-group// -->
        </article> <!-- card-body end .// -->

    </div> <!-- card.// -->
</div>

</div>
</div>




<!-- Initialize Quill editor -->
<script>

    var quill = new Quill('#editor', {
        theme: 'snow'
    });






    function submitForm(){
        var mysave = quill.container.firstChild.innerHTML;
        console.log(mysave);
        document.getElementById("description").value= mysave;
        document.getElementById("myForm").submit();
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