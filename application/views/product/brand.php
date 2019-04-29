<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/24/19
 * Time: 1:14 AM
 */
?>

<!-- Include stylesheet -->
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">


<!-- Include the Quill library -->
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>

<h3 class="title is-3">Marcas</h3>
<div class="column">
    <table class="table table-responsive is-bordered is-striped is-narrow is-hoverable is-fullwidth">
        <thead>
        <tr>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Imagen</th>
            <th>Acciones</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($brand as $p): ?>
            <tr>

                <td><?= $p->name ?></td>
                <td><?= $p->description ?></td>
                <td><img src="<?php echo base_url('assets/images/brand/'). $p->path ?>" style="max-width: 200px"></td>
                <td><button onclick="changeLink(<?= $p->id ?>)" class="btn btn-danger">Borrar</button></td>
            </tr>
        <?php endforeach; ?>
        <tr>
            <?php echo form_open_multipart('product/brand', 'id=myForm') ?>
            <td><input class="form-control" type="text" name="name" placeholder="Nombre de la marca"></td>
            <td><div id="editor" style="min-width: 450px"></div></td>
            <td><input class="form-control" type="file" name="userfile"></td>
            <input type="hidden" id="description" name="description">

            <?php echo form_close() ?>
            <td><button class="btn btn-primary" onclick="submitForm()">Agregar</button></td>
        </tr>
        </tbody>
    </table>
</div>


<!-- Delete Brand Modal-->
<div class="modal fade" id="deleteBrandModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Borrar marca</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Seguro que deseas borrar esta marca? (Sólo será posible si no tienes ningún producto en ella)</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" id="deleteLink" >Borrar</a>
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

    function changeLink(id){
        document.getElementById("deleteLink").href= "<?php echo site_url('product/deleteBrand?brand=') ?>" + id;
        $('#deleteBrandModal').modal('show');

    }
</script>

