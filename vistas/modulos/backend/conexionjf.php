<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar conexion
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar conexion</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

<!--       <div class="box-header with-border">
  
        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarConexion">
          
          Agregar conexion

        </button>

      </div> -->
        
      <div class="box-body">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           
           <th style="width:10px">#</th>
           <th>IP</th>
           <th>Base de datos</th>
           <th>Usuario</th>
           <th>Acciones</th>

         </tr> 

        </thead>

        <tbody>

        <?php

          $item = null;
          $valor = null;
          $colores = ControladorUsuarios::ctrMostrarConexiones($item, $valor);

          foreach ($colores as $key => $value) {
            

            echo '<tr>

                    <td>'.($key+1).'</td>

                    <td>'.$value["ip"].'</td>

                    <td>'.$value["db"].'</td>
                    
                    <td>'.$value["user"].'</td>'
                    
                    ;
                    

                    if( $_SESSION["perfil"] == "Supervisores" ||
                        $_SESSION["perfil"] == "Sistemas"){

                          echo '<td>

                                <div class="btn-group">
                                    
                                  <button class="btn btn-warning btnEditarConexion" data-toggle="modal" data-target="#modalEditarConexion" idConexion="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
          
                                 
          
                                </div>  
          
                              </td>';

                    }else{

                      echo '<td>

                              <div class="btn-group">
                                  
                                <button class="btn btn-warning btnEditarConexion" data-toggle="modal" data-target="#modalEditarConexion" idConexion="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

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
MODAL AGREGAR CONEXION
======================================-->

<div id="modalAgregarConexion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar conexion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL IP -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaIP" placeholder="Ingresar IP" required>

              </div>

            </div>          

            <!-- ENTRADA PARA BASE DE DATOS -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-database"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaBD" placeholder="Ingresar base de datos" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaUser" placeholder="Ingresar usuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaPwd" placeholder="Ingresar contraseña" required>

              </div>

            </div>
 
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar conexion</button>

        </div>

      </form>


      <?php

        $crearConexion = new ControladorUsuarios();
        $crearConexion -> ctrCrearConexion();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CONEXION
======================================-->

<div id="modalEditarConexion" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar conexion</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span> 

                <input type="text" class="form-control input-lg" name="editarIP" id="editarIP" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-database"></i></span> 

                <input type="text" class="form-control input-lg" name="editarBD" id="editarBD" required>
                <input type="hidden" id="idConexion" name="idConexion">
              </div>

            </div>
            
            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="editarUser" id="editarUser" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL DOCUMENTO ID -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="editarPwd" id="editarPwd" required>

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

        $editarConexion = new ControladorUsuarios();
        $editarConexion -> ctrEditarConexion();

      ?>   


    </div>

  </div>

</div>


<?php

  $eliminarConexion = new ControladorUsuarios();
  $eliminarConexion -> ctrEliminarConexion();

?>

<script>
window.document.title = "Conexiones"
</script>