<?php
require_once("DBConnection.php");
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM `supplier_list` where supplier_id = '{$_GET['id']}'");
    foreach($qry->fetchArray() as $k => $v){
        $$k = $v;
    }
}
?>
<style>
    #uni_modal .modal-footer{
        display:none !important;
    }
</style>
<div class="container-fluid">
    <div class="col-12">
        <div class="w-100 mb-1">
            <div class="fs-6"><b>Nombre del proveedor:</b></div>
            <div class="fs-5 ps-4"><?php echo isset($name) ? $name : '' ?></div>
        </div>
        <div class="w-100 mb-1">
            <div class="fs-6"><b>Estado:</b></div>
            <div class="fs-5 ps-4">
                <?php 
                    if(isset($status) && $status == 1){
                        echo "<small><span class='badge rounded-pill bg-success'>Activo</span></small>";
                    }else{
                        echo "<small><span class='badge rounded-pill bg-danger'>Inactivo</span></small>";
                    }
                ?>
            </div>
        </div>
        <div class="w-100 d-flex justify-content-end">
            <button class="btn btn-sm btn-dark rounded-0" type="button" data-bs-dismiss="modal">Cerrar</button>
        </div>
    </div>
</div>