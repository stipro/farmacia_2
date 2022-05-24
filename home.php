<h3>Punto de Venta para Farmacia</h3>
<hr>
<div class="col-12">
    <div class="row gx-3 row-cols-4">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-th-list fs-3 text-primary"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5 d-none d-sm-block"><b>Categorias</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $category = $conn->query("SELECT count(category_id) as `count` FROM `category_list` ")->fetchArray()['count'];
                                echo $category > 0 ? number_format($category) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-truck-loading fs-3 text-dark"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5 d-none d-sm-block"><b>Proveedores</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $supplier = $conn->query("SELECT count(supplier_id) as `count` FROM `supplier_list` ")->fetchArray()['count'];
                                echo $supplier > 0 ? number_format($supplier) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-pills fs-3 text-warning"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5 d-none d-sm-block"><b>Productos</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $product = $conn->query("SELECT count(product_id) as `count` FROM `product_list` ")->fetchArray()['count'];
                                echo $product > 0 ? number_format($product) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <div class="w-100 d-flex align-items-center">
                        <div class="col-auto pe-1">
                            <span class="fa fa-file-alt fs-3 text-info"></span>
                        </div>
                        <div class="col-auto flex-grow-1">
                            <div class="fs-5 d-none d-sm-block"><b>Inventario</b></div>
                            <div class="fs-6 text-end fw-bold">
                                <?php 
                                $stock = $conn->query("SELECT sum(quantity) as `total` FROM `stock_list` where strftime('%s',`expiry_date` || '23:59:59') >= strftime('%s',CURRENT_TIMESTAMP) ")->fetchArray()['total'];
                                echo $stock > 0 ? number_format($stock) : 0 ;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-12">
            <h3>Stock Disponible</h3>
            <hr>
            <table class="table table-striped table-hover" id="inventory">
                <colgroup>
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                    <col width="25%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="py-0 px-1">Categoria</th>
                        <th class="py-0 px-1">Producto Cod</th>
                        <th class="py-0 px-1">Producto Nombre</th>
                        <th class="py-0 px-1">ACantidad Disponible</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        $sql = "SELECT p.*,c.name as cname FROM `product_list` p inner join `category_list` c on p.category_id = c.category_id where p.status = 1 order by `name` asc";
                        $qry = $conn->query($sql);
                        while($row = $qry->fetchArray()):
                            $stock_in = $conn->query("SELECT sum(quantity) as `total` FROM `stock_list` where strftime('%s',`expiry_date` || '23:59:59') >= strftime('%s',CURRENT_TIMESTAMP) and product_id = '{$row['product_id']}' ")->fetchArray()['total'];
                            $stock_out = $conn->query("SELECT sum(quantity) as `total` FROM `transaction_items` where product_id = '{$row['product_id']}' ")->fetchArray()['total'];
                            $stock_in = $stock_in > 0 ? $stock_in : 0;
                            $stock_out = $stock_out > 0 ? $stock_out : 0;
                            $qty = $stock_in-$stock_out;
                            $qty = $qty > 0 ? $qty : 0;
                    ?>
                        <tr class="<?php echo $qty < 50? "bg-danger bg-opacity-25":'' ?>">
                            <td class="td py-0 px-1"><?php echo $row['cname'] ?></td>
                            <td class="td py-0 px-1"><?php echo $row['product_code'] ?></td>
                            <td class="td py-0 px-1"><?php echo $row['name'] ?></td>
                            <td class="td py-0 px-1 text-end">
                                <?php  if($_SESSION['type'] == 1): ?>
                                <?php echo $qty < 50? "<a href='javascript:void(0)' class='restock me-1' data-pid = '".$row['product_id']."' data-name = '".$row['product_code'].' - '.$row['name']."'> Restock</a>":'' ?>
                                <?php endif; ?>
                                <?php echo $qty ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
    $(function(){
        $('.restock').click(function(){
            uni_modal('Add New Stock for <span class="text-primary">'+$(this).attr('data-name')+"</span>","manage_stock.php?pid="+$(this).attr('data-pid'))
        })
        $('table#inventory').dataTable()
    })
</script>