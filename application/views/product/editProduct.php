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
if(isset($_GET['message']) && $_GET['message'] == 'editProdFail'){ ?>
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

            <h4 class="card-title mt-2">Editar producto</h4>
        </header>
        <article class="card-body">
            <?php echo form_open('product/editProduct?product='.$_GET['product'], 'id=myForm') ?>
                <div class="form-row">
                    <div class="col form-group">
                        <label>SKU</label>
                        <input type="text" name="sku" class="form-control" value="<?= $product[0]->sku ?>" placeholder="SKU del producto">
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" value="<?= $product[0]->name ?>"  placeholder="Nombre del producto">
                    </div> <!-- form-group end.// -->
                </div> <!-- form-row end.// -->

            <div class="form-row">
                <div class="col-lg-5 form-group">
                    <label>Precio</label>
                    <input type="text" name="public_price" class="form-control" value="<?= $product[0]->public_price ?>"  onkeypress="validate(event)" placeholder="Precio">
                </div> <!-- form-group end.// -->
                <div class="col-lg-5 form-group">
                    <label>Precio mínimo</label>
                    <input type="text" name="min_price" class="form-control" onkeypress="validate(event)" value="<?= $product[0]->min_price ?>" placeholder="Precio mínimo">
                </div> <!-- form-group end.// -->
                <div class="col-lg-2 form-group">
                    <label>Producto público</label>
                    <select name="selling" class="form-control">
                        <option value="0">No</option>
                        <option value="1">Sí</option>
                    </select>
                </div> <!-- form-group end.// -->
            </div> <!-- form-row end.// -->

                <div class="form-row">
                    <div class="form-group col">
                        <label>Marca</label>
                        <select name="brand" class="form-control">
                            <option value="<?= $product[0]->brand ?>" ><?= $brandSelected[0]->name ?> </option>
                            <?php foreach($brand as $b){ ?>
                                <option value="<?= $b->id ?>"><?= $b->name ?></option>
                            <?php } ?>

                        </select>
                    </div> <!-- form-group end.// -->
                    <div class="col form-group">
                        <label>Descuento</label>
                        <input type="number" name="discount" class="form-control" value="<?= $product[0]->discount ?>"  onkeypress="validate(event)" id="discount" placeholder="0">
                    </div> <!-- form-group end.// -->
                </div>



                <div class="form-group">
                    <label>Descripción</label>
                    <div id="editor" style="min-height: 250px">
                        <?= $product[0]->description ?>
                    </div>
                </div>

            <input type="hidden" name="description" id="description">

           </form>


            <a onclick="submitForm()" class="btn btn-primary btn-block">Actualizar producto </a>

        </article> <!-- card-body end .// -->

    </div> <!-- card.// -->
</div>

</div>
</div>
<div clas="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <header class="card-header">

                    <h4 class="card-title mt-2">Variantes</h4>
                </header>
                <article class="card-body">


                    <div class="column">
                        <table class="table is-bordered is-striped is-narrow is-hoverable is-fullwidth">
                            <thead>
                            <tr>
                                <th>Nombre</th>


                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($product as $p): ?>
                                <tr>

                                    <td><?= $p->variation ?></td>
                                    <td><?php if($auth_level==9){ ?><a href="<?php echo site_url('product/productVariation?productVariation='.$p->variation_id) ?>" class="btn btn-primary">Administrar variante</a><?php } ?></td>
                                </tr>
                            <?php endforeach; ?>
                            <tr>
                                <?php echo form_open('product/addProductVariation?product='.$_GET['product']) ?>
                                <td><input type="text" name="name" class="form-control" placeholder="Nombre de variante"></td>
                                <td><input type="Submit" value="Agregar" class="btn btn-primary" placeholder="Nombre de variante"></td>
                                <?php echo form_close() ?>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </article>
            </div>
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