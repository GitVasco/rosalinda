<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Consultar cuentas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Consultar cuentas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <div class="col-lg-2">
          <select name="tipoCliente" id="tipoCliente" class="form-control input-lg selectpicker" data-live-search="true">
          <option value="">Seleccionar cargar cliente</option></select>
        </div>

        <div class="col-lg-1">
          <button class="btn btn-primary" id="cargaClienteCuenta">Cargar Clientes</button>
        </div>


        <div class="col-lg-3 text-center">
          <label for=""  >Cliente</label>
          <input type="text" name="consultaCliente" id="consultaCliente" class="form-control input-lg"  readonly>
        </div>

        <div class="col-lg-2 text-center">
          <label for="">Total crédito</label>
          <input type="text" name="consultaCredito" id="consultaCredito" class="form-control input-lg"  readonly>
        </div>

        <div class="col-lg-2 text-center">
          <label for="" >Deuda Total</label>
          <input type="text" name="consultaDeudaTot" id="consultaDeudaTot" class="form-control input-lg"  readonly>
        </div>

        <div class="col-lg-2 text-center">
          <label for="" >Deuda Vencida</label>
          <input type="text" name="consultaDeudaVen" id="consultaDeudaVen" class="form-control input-lg"  readonly>
        </div>
      </div>
      
      
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCuentasConsultar" width="100%">
         
        <thead>
         
         <tr>
           <th>Tipo Doc.</th>
           <th>Nro Doc.</th>
           <th>Tipo</th>
           <th>Doc. origen</th>
           <th>Emisión</th>
           <th>Vencimiento</th>
           <th>Monto S/.</th>
           <th>Saldo S/.</th>
           <th>Fec. Pago</th>
           <th>Dif</th>
           <th>Protes.</th>
           <th>Renov.</th>
           <th>Bco.</th>
           <th>Nro. unico</th>
           <th>Vendedor</th>
           <th>Estado</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Consultar cuentas"
</script>