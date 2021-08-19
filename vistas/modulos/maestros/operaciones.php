<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar operaciones
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar operaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

    <?php 
      $item=null;
      $valor=null;
      $ultimovalor="";
      $operaciones=ControladorOperaciones::ctrMostrarOperaciones($item,$valor);
      foreach($operaciones as $key => $value) {
        $ultimovalor=$value["codigo"];
      }
    ?>
      <div class="box-header with-border">
  
        <button class="btn btn-primary btnOperacion" data-toggle="modal" data-target="#modalAgregarOperacion">
          <i class="fa fa-plus-square"></i>
           Agregar operaciones

        </button>
        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteOPE" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Operaciones  </button>
        </div>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaOperaciones" width="100%">
         
        <thead>
         
         <tr>
           
           <th>Codigo</th>
           <th>Nombre</th>
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

<div id="modalAgregarOperacion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>
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

                <input type="text" min="0" class="form-control input-lg" name="nuevoCodigo" id="codigoOpe" value="<?php echo $ultimovalor+1 ?>" readonly>

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

                <input type="text" min="0" class="form-control input-lg" name="editarCodigo" id="editarCodigoOpe" required>

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

        $editarOperacion = new ControladorOperaciones();
        $editarOperacion -> ctrEditarOperacion();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarOperacion = new ControladorOperaciones();
  $eliminarOperacion -> ctrEliminarOperacion();

?>
<script>
window.document.title = "Operaciones"
</script>