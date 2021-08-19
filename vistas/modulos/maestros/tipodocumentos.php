<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar tipo de documento
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar tipo de documento</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarTipoDocumento">
          
          Agregar tipo de documento

        </button>

        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteDoc" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Documentos  </button>
        </div>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Tipo de documento</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $tipodocumentos =  ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

          foreach ($tipodocumentos as $key => $value) {
           
            echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.$value["tipo_doc"].'</td>

                      <td>

                        <div class="btn-group">
                            
                        <button class="btn btn-warning btnEditarTipoDocumento" idTipoDocumento="'.$value["cod_doc"].'" data-toggle="modal" data-target="#modalEditarTipoDocumento"><i class="fa fa-pencil"></i></button>
                         
                        <button class="btn btn-danger btnEliminarTipoDocumento" idTipoDocumento="'.$value["cod_doc"].'"><i class="fa fa-times"></i></button>

                        </div>  

                      </td>


                  </tr>';
          }

        ?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>
<!--=====================================
MODAL AGREGAR TIPO DOCUMENTO
======================================-->

<div id="modalAgregarTipoDocumento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar tipo de documento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoTipoDocumento" placeholder="Ingresar tipo de documento" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar tipo de documento</button>

        </div>

        <?php

          $crearTipoDocumento = new ControladorTipoDocumento();
          $crearTipoDocumento -> ctrCrearTipoDocumento();

        ?>

      </form>

    </div>

  </div>

</div>
<!--=====================================
MODAL EDITAR TIPO DE DOCUMENTO
======================================-->

<div id="modalEditarTipoDocumento" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar tipo de documento</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTipoDocumento" id="editarTipoDocumento" required>

                 <input type="hidden"  name="idTipoDocumento" id="idTipoDocumento" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar tipo de documento</button>

        </div>

        <?php

          $editarTipoDocumento = new ControladorTipoDocumento();
          $editarTipoDocumento -> ctrEditarTipoDocumento();

        ?>

      </form>

    </div>

  </div>

</div>
<?php

  $borrarTipoDocumento = new ControladorTipoDocumento();
  $borrarTipoDocumento -> ctrBorrarTipoDocumento();

?>



<script>
window.document.title = "Documentos"
</script>
