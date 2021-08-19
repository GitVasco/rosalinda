<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar condiciones de venta
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar condiciones de venta</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCondicionVenta">
          
          Agregar condiciones de venta

        </button>

        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteColor" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte condiciones de venta  </button>
        </div>
      </div>
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaCondicionesVenta" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Codigo</th>
           <th>Descripcion</th>
           <th>Cta. cte</th>
           <th>Dias</th>
           <th>Letras</th>
           <th>Descuento</th>
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
MODAL AGREGAR CONDICIONES VENTA
======================================-->

<div id="modalAgregarCondicionVenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar condiciones de venta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar codigo" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar condicion de venta" required>

              </div>

            </div>

            <!-- ENTRADA PARA CUENTA CTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-credit-card"></i></span> 

                <select class="form-control input-lg" name="nuevaCtaCte"  required>
                  <option value="">SELECCIONAR LETRA</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>

            </div>

            <!-- ENTRADA PARA EL DIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" min="0" class="form-control input-lg" name="nuevoDia" placeholder="Ingresar días" >

              </div>

            </div>

            <!-- ENTRADA PARA LA LETRA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select class="form-control input-lg" name="nuevaLetra"  required>
                  <option value="">SELECCIONAR LETRA</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>

              </div>

            </div>

            <!-- ENTRADA PARA EL DESCUENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <select class="form-control input-lg" name="nuevoDscto"  required>
                  <option value="">SELECCIONAR DESCUENTO</option>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar condicion de venta</button>

        </div>

      </form>


      <?php

        $crearCondicionVenta = new ControladorCondicionVentas();
        $crearCondicionVenta -> ctrCrearCondicionVenta();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CONDICION VENTA
======================================-->

<div id="modalEditarCondicionVenta" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar condicion de venta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL DOCUMENTO RUC -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                <input type="hidden" id="idCondicionVenta" name="idCondicionVenta">
              </div>

            </div>

            <!-- ENTRADA PARA LA CTA CTE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg selectpicker" id="editarCtaCte" name="editarCtaCte"  required>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>

            </div>

            <!-- ENTRADA PARA EL DIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDia" id="editarDia" required>
              </div>

            </div>

            <!-- ENTRADA PARA LA LETRA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg selectpicker" id="editarLetra" name="editarLetra"  required>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
              </div>

            </div>

            <!-- ENTRADA PARA EL DESCUENTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg selectpicker" id="editarDscto" name="editarDscto"  required>
                  <option value="Si">Si</option>
                  <option value="No">No</option>
                </select>
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

        $editarCondicionVenta = new ControladorCondicionVentas();
        $editarCondicionVenta -> ctrEditarCondicionVenta();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarCondicionVenta = new ControladorCondicionVentas();
  $eliminarCondicionVenta -> ctrEliminarCondicionVenta();

?>

<script>
window.document.title = "Condiciones de venta"
</script>