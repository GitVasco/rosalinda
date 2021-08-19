<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar tipo trabajador
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar operaciones</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoTrabajador">
          
          Agregar tipo trabajador

        </button>
        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteTipoTra" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Tipo trabajador  </button>
        </div>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablaTipoTrabajador" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tipo de trabajador</th>
           <th>Sector</th>
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
MODAL AGREGAR TIPO TRABAJADOR
======================================-->

<div id="modalAgregarTipoTrabajador" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</butOperacion
          <h4 class="modal-title">Agregar tipo trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" min="0" class="form-control input-lg" name="nuevoTipoTrabajador" id="nuevoTipoTrabajador" placeholder="Ingresar tipo de trabajador" required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL SECTOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select class="form-control input-lg" name="nuevoSectorTrabajador" id="nuevoSectorTrabajador"  placeholder="Ingresar sector" required>
                  <option value="">Seleccionar sector</option>
                  <?php
                  $item = null;
                  $valor=null;

                  $sectores=ControladorSectores::ctrMostrarSectores($item,$valor);
                  foreach ($sectores as $key => $value) {
                    echo"<option value='".$value['nom_sector']."'>".$value["nom_sector"]."</option>";
                  }
                  ?>
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

          <button type="submit" class="btn btn-primary">Guardar tipo de trabajador</button>

        </div>

      </form>

      <?php

        $crearTipoTrabajador= new ControladorTipoTrabajador();
        $crearTipoTrabajador -> ctrCrearTipoTrabajador();

      ?>
      

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR TIPO DE TRABAJADOR
======================================-->

<div id="modalEditarTipoTrabajador" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar tipo de trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text"  class="form-control input-lg" name="editarTipoTrabajador" id="editarTipoTrabajador" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL SECTOR -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <select type="text" class="form-control input-lg" name="editarSectorTrabajador" id="editarSectorTrabajador" required>
                  <?php
                  $item = null;
                  $valor=null;
                  $sectores=ControladorSectores::ctrMostrarSectores($item,$valor);
                  foreach ($sectores as $key => $value) {
                    echo"<option value='".$value['nom_sector']."'>".$value["nom_sector"]."</option>";
                  }
                  ?>
                </select>
                <input type="hidden" id="idTipoTrabajador" name="idTipoTrabajador">
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

        $editarTipoTrabajador = new ControladorTipoTrabajador();
        $editarTipoTrabajador -> ctrEditarTipoTrabajador();

      ?>   


    </div>

  </div>

</div>

<?php
  $eliminarTipoTrabajador = new ControladorTipoTrabajador();
  $eliminarTipoTrabajador -> ctrEliminarTipoTrabajador();
?>

<script>
window.document.title = "Tipo de trabajador"
</script>