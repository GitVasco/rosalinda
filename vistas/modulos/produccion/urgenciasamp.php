<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Urgencias Materia Prima
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Urgencias AMP</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto"> 

       <table class="table table-bordered table-striped dt-responsive tablaUrgenciasAMP" width="100%">
         
        <thead>

          <tr>
           
           <th>CodPro</th>
           <th>Línea</th>
           <th>CodFab</th>
           <th>Descripción</th>
           <th>Color</th>
           <th>Unidad</th>
           <th>Items</th>
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

<!--=====================================
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVisualizarUrgenciasAMP" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 80% !important;">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DE LA MATERIA PRIMA-->
            
            <div class="form-group col-lg-3">
              
              <label>CodPro</label>

              <div class="input-group">

              <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codpro" id="codpro" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL CODIGO DE LA LINEA-->
            
            <div class="form-group col-lg-3">

              <label>Código Línea</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codLinea" id="codLinea" required readonly>

              </div>

            </div>            

            <!-- ENTRADA PARA LA LINEA-->
            
            <div class="form-group col-lg-6">

              <label>Línea</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="linea" id="linea" required readonly>

              </div>

            </div>      
            
            <!-- ENTRADA PARA EL CODIGO DE FABRICA-->
            
            <div class="form-group col-lg-3">

              <label>CodFab</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="codfab" id="codfab" required readonly>

              </div>

            </div>
            
            <!-- ENTRADA PARA LA DESCRIPCION-->
            
            <div class="form-group col-lg-6">

              <label>Descripcion</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="descripcion" id="descripcion" required readonly>

              </div>

            </div>     

            <!-- ENTRADA PARA LA UNIDAD-->
            
            <div class="form-group col-lg-3">

              <label>Unidad</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="unidad" id="unidad" required readonly>

              </div>

            </div>              

            <!-- ENTRADA PARA EL COLOR-->
            
            <div class="form-group col-lg-3">

              <label>Color</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="color" id="color" required readonly>

              </div>

            </div>     

            <!-- ENTRADA PARA EL STOCK-->
            
            <div class="form-group col-lg-3">

              <label>Stock</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="stock" id="stock" required readonly>

              </div>

            </div> 
            
            <!-- ENTRADA PARA EL PROVEEDOR-->
            
            <div class="form-group col-lg-6">

              <label>Proveedor Principal</label>
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span> 

                <input type="text" class="form-control input-sm" name="proveedor" id="proveedor" required readonly>

              </div>

            </div>             

            <!-- TABLA DE DETALLES -->
            
            <label>DETALLE DE ORDEN DE COMPRA</label>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalleOC" width="100%">

                <thead>

                  <tr>

                    <th>OC</th>
                    <th>Emisión</th>
                    <th>Llegada</th>
                    <th>Proveedor</th>
                    <th>Cant. Ped</th>
                    <th>Saldo</th>
                    <th>Estado OC</th>

                  </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

            </div>

            í<label>DETALLE DE ARTÍCULOS EN URGENCIA</label>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalleART" width="100%">

                <thead>

                  <tr>

                    <th>Artículo</th>
                    <th>Modelo</th>
                    <th>Nombre</th>
                    <th>Color</th>
                    <th>Talla</th>
                    <th>Stock</th>
                    <th>Pedidos</th>

                  </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

            </div>            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>



      </form>

    </div>

  </div>

</div>

<script>
window.document.title = "Urgencias AMP"
</script>