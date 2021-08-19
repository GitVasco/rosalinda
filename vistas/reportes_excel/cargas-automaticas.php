<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar cargas automaticas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cargas automaticas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">
        <form role="form" method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-10">
            <label for=""><strong>LEER ARTICULO POR STOCK</strong></label>
            <input type="file" name="archivoxls" id="archivoxls" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <br>
            <button type="submit"  class="btn btn-success" name="import" ><i class="fa fa-refresh"></i> Cargar articulo</a>
          </div>
        </form>

        <?php

        $actualizarStock = new ControladorArticulos();
        $actualizarStock->ctrCambiarStock();

        ?>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2"></div>
        <form role="form" method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-10">
            <label for=""><strong>LEER MOVIMIENTOS ACTUALES</strong></label>
            <input type="file" name="archivoxlsmovimiento" id="archivoxlsmovimiento" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <br>
            <button type="submit"  class="btn btn-success" name="importmovimiento" ><i class="fa fa-refresh"></i> Cargar movimientos</a>
          </div>
        </form>

        <?php

        $actualizarMovimiento = new ControladorArticulos();
        $actualizarMovimiento->ctrCambiarMovimientos();

        ?>

        <form role="form"  method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-10">
            <label for=""><strong>LEER VENTAS ACTUALES</strong></label>
            <input type="file" name="archivoxlsventa" id="archivoxlsventa" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <br>
            <button type="submit"  class="btn btn-success" name="importventa" ><i class="fa fa-refresh"></i> Cargar ventas</a>
          </div>
        </form>

        <?php

        $actualizarVenta = new ControladorArticulos();
        $actualizarVenta->ctrCargarVentas();

        ?>
        <div class="col-lg-1 col-md-1 col-sm-1 col-xs-2"></div>
        <form role="form"  method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-10">
            <label for=""><strong>LEER PEDIDOS ACTUALES</strong></label>
            <input type="file" name="archivoxlspedido" id="archivoxlspedido" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <br>
            <button type="submit"  class="btn btn-success" name="importpedido" ><i class="fa fa-refresh"></i> Cargar pedidos</a>
          </div>
        </form>

        <?php

        $actualizarPedido = new ControladorArticulos();
        $actualizarPedido->ctrCargarPedidos();

        ?>

        <form role="form"  method="POST" enctype="multipart/form-data">
          <div class="form-group col-lg-4 col-md-4 col-sm-4 col-xs-10">
            <label for=""><strong>CARGAR ARTICULOS X PEDIDOS</strong></label>
            <input type="file" name="archivoxlsarticulopedido" id="archivoxlsarticulopedido" class="form-control" accept="application/vnd.ms-excel">
          </div>
          <div class="form-group col-lg-1 col-md-1 col-sm-1 col-xs-2">
            <br>
            <button type="submit"  class="btn btn-success" name="importarticulopedido" ><i class="fa fa-refresh"></i> Cargar pedidos</a>
          </div>
        </form>

        <?php

        $actualizarArticuloPedido = new ControladorArticulos();
        $actualizarArticuloPedido->ctrCargarArticuloPedido();

        ?>

      </div>

    </div>

  </section>

</div>
<script>
window.document.title = "Cargas Automaticas"
</script>
