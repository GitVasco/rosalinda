<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar operaciones modelos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar operaciones modelos</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
        <div class="col-md-3">
          <a class="btn btn-primary" href="creardetalleoperaciones">
            <i class="fa fa-plus-square"></i> Agregar operación modelo
          </a>  
        </div>
        <div class=" pull-right ">
          <button class="btn btn-outline-success btnReporteTO" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Detalle Operaciones
          </button>
          <button class="btn btn-outline-success btnReporteOG" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Operaciones - General
          </button>
        </div>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaDetalleOperaciones" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">N°</th>
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Responsable</th>
           <th>Total x Decena</th>
           <th>Tiempo standar total</th>
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
MODAL AGREGAR OPERACION
======================================-->

<div id="modalAgregarDetalleOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</butOperacion>
          <h4 class="modal-title">Agregar Operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaOperacion" placeholder="Ingresar nombre" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar operación</button>

        </div>

      </form>


      <?php

        $crearOperacion = new ControladorOperaciones();
        $crearOperacion -> ctrCrearOperacion();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR OPERACION
======================================-->

<div id="modalEditarOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarOperacion" id="editarOperacion" required>
                <input type="hidden" id="idOperacion" name="idOperacion">
              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar cambios</button>

        </div>

      </form>

      <?php

        $editarCabeceraOperacion = new ControladorOperaciones();
        $editarCabeceraOperacion -> ctrEditarCabeceraOperacion();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarCabeceraOperacion = new ControladorOperaciones();
  $eliminarCabeceraOperacion -> ctrEliminarCabeceraOperacion();

?>

<!--=====================================
MODAL DETALLE OPERACION
======================================-->

<div id="modalDetalleOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle operación</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL MODELO -->
            
            <div class="form-group col-lg-2">
              <label for=""><strong>Modelo</strong></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="verModelo" id="verModelo" readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL VENDEDOR -->
            
            <div class="form-group col-lg-4">
              <label for=""><strong>Responsable</strong></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="verVendedor" id="verVendedor" readonly>
              </div>

            </div>

            <!-- ENTRADA PARA EL TOTAL DE DECENA -->
            <div class="form-group col-lg-3">
              <label for=""><strong>Total Decena</strong></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="verTotalDocena" id="verTotalDocena" readonly>
              </div>

            </div>

            <!-- ENTRADA PARA EL TOTAL DE TIEMPO -->
            <div class="form-group col-lg-3">
              <label for=""><strong>Tiempo Total</strong></label> 
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-caret-up"></i></span> 

                <input type="text" class="form-control input-lg" name="verTiempoTotal" id="verTiempoTotal" readonly>
              </div>

            </div>

            <div class="form-group col-lg-3">
              <label for=""><strong>Detalle</strong></label> 
            </div>
            <div class="box-body" > 
              <div id="scroll3">
                <table class="table table-bordered table-striped dt-responsive tablaOperacionModelo" width="100%">
                  <thead>
                    <tr>
                      <th style="width:100px">CodOpe</th>
                      <th>Operacion</th>
                      <th>Precio x Docena</th>
                      <th>Tiempo Standard</th>
                    </tr>

                  </thead>

                  <tbody>



                  </tbody>

                </table>
              </div>
            </div>
          </div>
        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

        </div>

    </div>

  </div>

</div>

<script>
window.document.title = "Operaciones Modelo"
</script>