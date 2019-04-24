<?php
/**
 * Created by PhpStorm.
 * User: epalacio
 * Date: 4/21/19
 * Time: 4:29 PM
 */
?>
</div>
</div>
</div>
<!-- /#wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Estás listo para salir?</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Selecciona salir si ya estás listo para cerrar tu sesión.</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                <a class="btn btn-primary" href="<?php echo site_url('dashboard/logout') ?>">Salir</a>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="<?php echo base_url('assets/private/vendor/jquery/jquery.min.js')?>"></script>
<script src="<?php echo base_url('assets/private/vendor/bootstrap/js/bootstrap.bundle.min.js')?>"></script>

<!-- Core plugin JavaScript-->
<script src="<?php echo base_url('assets/private/vendor/jquery-easing/jquery.easing.min.js')?>"></script>

<!-- Page level plugin JavaScript-->
<script src="<?php echo base_url('assets/private/vendor/chart.js/Chart.min.js')?>"></script>
<script src="<?php echo base_url('assets/private/vendor/datatables/jquery.dataTables.js')?>"></script>
<script src="<?php echo base_url('assets/private/vendor/datatables/dataTables.bootstrap4.js')?>"></script>

<!-- Custom scripts for all pages-->
<script src="<?php echo base_url('assets/private/js/sb-admin.min.js')?>"></script>

<!-- Demo scripts for this page-->
<script src="<?php echo base_url('assets/private/js/demo/datatables-demo.js')?>"></script>
<script src="<?php echo base_url('assets/private/js/demo/chart-area-demo.js')?>"></script>

</body>

</html>

