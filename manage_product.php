<?php
require_once("DBConnection.php");
if(isset($_GET['id'])){
$qry = $conn->query("SELECT * FROM `product_list` where product_id = '{$_GET['id']}'");
    foreach($qry->fetchArray() as $k => $v){
        $$k = $v;
    }
}
?>
<div class="container-fluid">
    <form action="" id="product-form">
        <input type="hidden" name="id" value="<?php echo isset($product_id) ? $product_id : '' ?>">
        <div class="col-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name" class="control-label">Nombre <span class="text-danger">*</span></label>
                        <input type="text" name="name"  id="name" autofocus required class="form-control form-control-sm" aria-label="Nombre" value="<?php echo isset($name) ? $name : '' ?>">
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="presentation" class="control-label">Presentación</label>
                                <div class="input-group input-group-sm">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm Presentacion" name="presentation" aria-describedby="presentation" required>
                                        <option selected>Open this select menu</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                    <button class="btn btn-outline-secondary form-control-sm" type="button" id="button-presentation"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="laboratory" class="control-label">Laboratorio</label>
                                <div class="input-group input-group-sm">
                                    <!-- <input type="text" class="form-control form-control-sm" placeholder="Presentación" aria-label="Presentación" aria-describedby="button-presentation" name="laboratory" value="" required> -->
                                    <input class="form-control" list="dt-lab-producto" id="ipt-lab-producto" placeholder="Escribe para buscar...">
                                    <datalist id="dt-lab-producto">
                                        <option value="San Francisco">
                                        <option value="New York">
                                        <option value="Seattle">
                                        <option value="Los Angeles">
                                        <option value="Chicago">
                                    </datalist>
                                    <button class="btn btn-outline-secondary form-control-sm" type="button" id="button-presentation"><i class="bi bi-plus-lg"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="control-label">Principio Activo</label>
                        <input type="text" name=""  id="" required class="form-control form-control-sm" aria-label="" value="">
                    </div>
                    <div class="form-group">
                        <label for="indications" class="control-label">Indicaciones</label>
                        <input type="text" name="indications"  id="" required class="form-control form-control-sm" aria-label="" value="">
                    </div>
                    <!-- <div class="form-group">
                        <label for="price" class="control-label">Precio</label>
                        <div class="input-group">
                            <input type="number" step="any" name="price"  id="price" required class="form-control form-control-sm text-end" aria-label="Dollar amount (with dot and two decimal places)" value="<?php echo isset($price) ? $price : '' ?>">
                            <span class="input-group-text">$</span>
                            <span class="input-group-text">0.00</span>
                        </div>
                    </div> -->
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="product_code" class="control-label">Código</label>
                        <input type="text" name="product_code" id="product_code" required class="form-control form-control-sm" value="<?php echo isset($product_code) ? $product_code : '' ?>">
                    </div>
                    <div class="form-group">
                        <label for="category_id" class="control-label">Grupo</label>
                        <select name="category_id" id="category_id" class="form-select form-select-sm" required>
                            <option <?php echo (!isset($category_id)) ? 'selected' : '' ?> disabled>Seleccione aquí</option>
                            <?php
                            $cat_qry = $conn->query("SELECT * FROM category_list where `status` = 1  order by `name` asc");
                            while($row= $cat_qry->fetchArray()):
                            ?>
                                <option value="<?php echo $row['category_id'] ?>" <?php echo (isset($category_id) && $category_id == $row['category_id'] ) ? 'selected' : '' ?>><?php echo $row['name'] ?></option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="control-label">Lote</label>
                                <input type="text" name=""  id="" required class="form-control form-control-sm" aria-label="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="control-label">Fech. Vencimiento</label>
                                <input type="text" name=""  id="" required class="form-control form-control-sm" aria-label="" value="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="control-label">Concentración</label>
                                <input type="text" name=""  id="" required class="form-control form-control-sm" aria-label="" value="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="" class="control-label">Registro Sanitario</label>
                                <input type="text" name=""  id="" required class="form-control form-control-sm" aria-label="" value="">
                            </div>
                        </div>
                    </div>
                    <!-- <div class="form-group">
                        <label for="description" class="control-label">Descripción</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="form-control" required><?php echo isset($description) ? $description : '' ?></textarea>
                    </div> -->
                    <div class="form-group">
                        <label for="status" class="control-label">Estado</label>
                        <select name="status" id="status" class="form-select form-select-sm" required>
                            <option value="1" <?php echo isset($status) && $status == 1 ? 'selected' : '' ?>>Activa</option>
                            <option value="0" <?php echo isset($status) && $status == 0 ? 'selected' : '' ?>>Inactivo</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    $(function(){
        // In your Javascript (external .js resource or <script> tag)
        $('#product-form').submit(function(e){
            e.preventDefault();
            $('.pop_msg').remove()
            var _this = $(this)
            var _el = $('<div>')
                _el.addClass('pop_msg')
            $('#uni_modal button').attr('disabled',true)
            $('#uni_modal button[type="submit"]').text('submitting form...')
            $.ajax({
                url:'./Actions.php?a=save_product',
                data: new FormData($(this)[0]),
                cache: false,
                contentType: false,
                processData: false,
                method: 'POST',
                type: 'POST',
                dataType: 'json',
                error:err=>{
                    console.log(err)
                    _el.addClass('alert alert-danger')
                    _el.text("An error occurred.")
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                },
                success:function(resp){
                    if(resp.status == 'success'){
                        _el.addClass('alert alert-success')
                        $('#uni_modal').on('hide.bs.modal',function(){
                            location.reload()
                        })
                        if("<?php echo isset($product_id) ?>" != 1)
                        _this.get(0).reset();
                    }else{
                        _el.addClass('alert alert-danger')
                    }
                    _el.text(resp.msg)

                    _el.hide()
                    _this.prepend(_el)
                    _el.show('slow')
                     $('#uni_modal button').attr('disabled',false)
                     $('#uni_modal button[type="submit"]').text('Save')
                }
            })
        })
    })
</script>