<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
    <?php

                $cuentas=ControladorCuentas::ctrMostrarCuentas("num_cta",$_GET["numCta"]);
                $cliente=ControladorClientes::ctrMostrarClientes("codigo",$cuentas["cliente"]);

     ?>
      Administrar cancelaciones de N° de cuenta <?php echo $cuentas["num_cta"]?>
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar cancelaciones</li>
    
    </ol>

  </section>

  <section class="content ">
    <div class="  col-lg-5">
      <div class="box box-success">
        <div class="box-body">
          <div class="col-md-3" style="margin-bottom:10px">
            <a href="consultar-cuentas" class="btn btn-danger"><i class ="fa fa-arrow-left"> Atrás </i></a>
          </div>
          <div class="col-md-12"></div>

          <div class="col-md-3 ">
            <label for="">Tipo Documento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["tipo_doc"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Nro Documento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["num_cta"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Fecha</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["fecha"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Fecha Vencimiento</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["fecha_ven"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Clientes</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["cliente"]; ?>" readonly>
          </div>

          <div class="col-md-6">
            <div style="margin-top:25px"></div>
            <input type="text" class="form-control" value="<?php echo $cliente["nombre"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Vendedor</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["vendedor"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Estado</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["estado"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Saldo</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["saldo"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Nro unico</label>
            <input type="text" class="form-control" value="<?php echo $cuentas["num_unico"]; ?>" readonly>
          </div>

          <div class="col-md-3">
            <label for="">Total</label>
            <input type="text" class="form-control" value="<?php echo "S/.".$cuentas["monto"]; ?>" readonly>
          </div>
          
        </div>
      </div>
    </div>
        
    <div class=" col-lg-7">
      <div class="box box-warning">
        <div class="box-body">
         <table class="table table-bordered table-striped dt-responsive tablaVerCuentasConsultar" width="100%">
         
          <thead>
         
          <tr>
           <th>Tipo</th>
           <th>Nro Doc.</th>
           <th>Fecha</th>
           <th>Notas</th>
           <th>Monto</th>

          </tr> 

          </thead>

          <tbody>
          </tbody>

          </table>

        </div>
      </div>
    </div>

  </section>

</div>


<script>
window.document.title = "Cancelaciones de cuenta"
</script>