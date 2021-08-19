<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar paras
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar paras</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarPara">
          
          Agregar Para

        </button>
        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteParas" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Paras  </button>
        </div>
      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Paras</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $paras = ControladorParas::ctrMostrarParas($item, $valor);

          foreach ($paras as $key => $value) {
           
            echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.$value["nombre"].'</td>

                      <td>

                        <div class="btn-group">
                            
                        <button class="btn btn-warning btnEditarPara" idPara="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarPara"><i class="fa fa-pencil"></i></button>
                         
                        <button class="btn btn-danger btnEliminarPara" idPara="'.$value["id"].'"><i class="fa fa-times"></i></button>

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
MODAL AGREGAR PARA
======================================-->

<div id="modalAgregarPara" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Para</h4>

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

                <input type="text" class="form-control input-lg" name="nuevaPara" placeholder="Ingresar para" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar para</button>

        </div>

        <?php

          $crearPara = new ControladorParas();
          $crearPara -> ctrCrearPara();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PARA
======================================-->

<div id="modalEditarPara" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Para</h4>

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

                <input type="text" class="form-control input-lg" name="editarPara" id="editarPara" required>

                 <input type="hidden"  name="idPara" id="idPara" required>

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

        <?php

          $editarPara = new ControladorParas();
          $editarPara -> ctrEditarPara();

        ?>

      </form>

    </div>

  </div>

</div>


<?php

  $borrarPara = new ControladorParas();
  $borrarPara -> ctrBorrarPara();

?>

<script>
window.document.title = "Paras"
</script>