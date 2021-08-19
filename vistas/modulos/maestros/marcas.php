<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar marcas
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar marcas</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarMarca">
          
          Agregar marca

        </button>

        <div class="pull-right">
          <button class="btn btn-outline-success btnReporteMarca" style="border:green 1px solid">
          <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Marcas  </button>
        </div>

      </div>

      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>Marca</th>
           <th>Venta</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;

          $marcas = ControladorMarcas::ctrMostrarMarcas($item, $valor);

          foreach ($marcas as $key => $value) {
           
            echo ' <tr>

                      <td>'.($key+1).'</td>

                      <td class="text-uppercase">'.$value["marca"].'</td>';

                      if($value["venta"] == "1"){

                        echo "<td><button class='btn btn-success btn-xs btnActivarMarca' idMarca='".$value["id"]."' estadoMarca='0'>Activo</button></td>";

                      }
              
                      else{
              
                          echo "<td><button class='btn btn-danger btn-xs btnActivarMarca' idMarca='".$value["id"]."' estadoMarca='1'>Inactivo</button></td>";

                      }

                      if( $_SESSION["perfil"] == "Supervisores" ||
                          $_SESSION["perfil"] == "Sistemas"){

                            echo '<td>

                                    <div class="btn-group">
                                        
                                    <button class="btn btn-warning btnEditarMarca" idMarca="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-pencil"></i></button>
                                    
                                    <button class="btn btn-danger btnEliminarMarca" idMarca="'.$value["id"].'"><i class="fa fa-times"></i></button>
            
                                    </div>  
            
                                  </td>';

                      }else{

                            echo '<td>

                            <div class="btn-group">
                                
                            <button class="btn btn-warning btnEditarMarca" idMarca="'.$value["id"].'" data-toggle="modal" data-target="#modalEditarMarca"><i class="fa fa-pencil"></i></button>
                            
                            </div>  

                          </td>';

                      }
                      
             echo '</tr>';        

          }

        ?>


        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarMarca" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Marca</h4>

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

                <input type="text" class="form-control input-lg" name="nuevaMarca" placeholder="Ingresar marca" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar marca</button>

        </div>

        <?php

          $crearMarca = new ControladorMarcas();
          $crearMarca -> ctrCrearMarca();

        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR MARCA
======================================-->

<div id="modalEditarMarca" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar marca</h4>

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

                <input type="text" class="form-control input-lg" name="editarMarca" id="editarMarca" required>

                 <input type="hidden"  name="idMarca" id="idMarca" required>

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

          $editarMarca = new ControladorMarcas();
          $editarMarca -> ctrEditarMarca();

        ?>

      </form>

    </div>

  </div>

</div>

<?php

  $borrarMarca = new ControladorMarcas();
  $borrarMarca -> ctrBorrarMarca();

?>
<script>
window.document.title = "Marcas"
</script>