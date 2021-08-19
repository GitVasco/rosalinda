<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar usuarios

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar usuarios</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

        <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">

          Agregar usuario

        </button>

      </div>

      <div class="box-body">

        <table class="table table-bordered table-striped dt-responsive tablaUsuarios" width="100%">

          <thead>

            <tr>

              <th style="width:10px">#</th>
              <th>Nombre</th>
              <th>Usuario</th>
              <th>Foto</th>
              <th>Perfil</th>
              <th>Estado</th>
              <th>Último login</th>
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
MODAL AGREGAR USUARIO
======================================-->

<div id="modalAgregarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar nombre" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group col-lg-6 col-md-6 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoUsuario" placeholder="Ingresar usuario" id="nuevoUsuario" required>

              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group col-lg-6 col-md-6 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required>

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group col-lg-6 col-md-6 col-sm-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="nuevoPerfil">
                  
                  <option value="">Selecionar perfil</option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                  <option value="Sistemas">Sistemas</option>

                  <option value="Supervisores">Supervisores</option>

                  <option value="Produccion">Producción</option>

                  <option value="Logistica">Logística</option>

                  <option value="Udp">UDP</option>

                  <option value="Costos">Costos</option>

                </select>

              </div>

            </div>

          <!-- ENTRADA PARA PERMISOS -->
            <div class="form-group">
              <label ><strong>PERMISOS</strong></label>
              <ul id="permisos" style="list-style:none;columns:2">
                <?php
                $item=null;
                $valor=null;
                $permisos=ControladorUsuarios::ctrMostrarPermisos($item,$valor);
                foreach ($permisos as $key => $value) {
                  echo("<li><input type='checkbox' name='permiso[]' value='".$value["idpermiso"]."'> ".$value["nombre"]."</li>");
                }
                ?>
              </ul>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

            <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="nuevaFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

            </div>
            

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar usuario</button>

        </div>

        <?php

          $crearUsuario = new ControladorUsuarios();
          $crearUsuario -> ctrCrearUsuario();

        ?>

      </form>

    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR USUARIO
======================================-->

<div id="modalEditarUsuario" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-lg">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar usuario</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuario" name="editarUsuario" value="" readonly>
                <input type="hidden" name="idUsuario" id="idUsuario">
              </div>

            </div>

            <!-- ENTRADA PARA LA CONTRASEÑA -->

             <div class="form-group col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-lock"></i></span> 

                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba la nueva contraseña">

                <input type="hidden" id="passwordActual" name="passwordActual">

              </div>

            </div>

            <!-- ENTRADA PARA SELECCIONAR SU PERFIL -->

            <div class="form-group col-lg-6">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-users"></i></span> 

                <select class="form-control input-lg" name="editarPerfil">
                  
                  <option value="" id="editarPerfil"></option>

                  <option value="Administrador">Administrador</option>

                  <option value="Especial">Especial</option>

                  <option value="Vendedor">Vendedor</option>

                  <option value="Sistemas">Sistemas</option>

                  <option value="Supervisores">Supervisores</option>

                  <option value="Produccion">Producción</option>

                  <option value="Logistica">Logística</option>

                  <option value="Udp">UDP</option>

                  <option value="Costos">Costos</option>

                </select>

              </div>

            </div>

            <!-- ENTRADA PARA PERMISOS -->
            <div class="form-group">
              <label ><strong>PERMISOS</strong></label>
              <ul id="permisos" style="list-style:none;columns:2">
                <?php
                $item=null;
                $valor=null;
                $permisos=ControladorUsuarios::ctrMostrarPermisos($item,$valor);
                foreach ($permisos as $key => $value) {
                  echo("<li><input type='checkbox' name='permisos[]' id='permisos[]' value='".$value["idpermiso"]."'> ".$value["nombre"]."</li>");
                }
                ?>
              </ul>
            </div>

            <!-- ENTRADA PARA SUBIR FOTO -->

             <div class="form-group">
              
              <div class="panel">SUBIR FOTO</div>

              <input type="file" class="nuevaFoto" name="editarFoto">

              <p class="help-block">Peso máximo de la foto 2MB</p>

              <img src="vistas/img/usuarios/default/anonymous.png" class="img-thumbnail previsualizar" width="100px">

              <input type="hidden" name="fotoActual" id="fotoActual">

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar usuario</button>

        </div>
        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrEditarUsuario();

        ?> 

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR CORREO
======================================-->

<div id="modalEditarCorreo" class="modal fade" role="dialog">
  
  <div class="modal-dialog modal-md">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar permisos de correo</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            <div class="form-group col-lg-6">
              <label for=""><strong>Nombre</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarNombreCorreo" name="editarNombreCorreo" value="" readonly>

              </div>

            </div>

            <div class="form-group col-lg-6">
            <label for=""><strong>Usuario</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-user"></i></span> 

                <input type="text" class="form-control input-lg" id="editarUsuarioCorreo" name="editarUsuarioCorreo" value="" readonly>

              </div>

            </div>
            <div class="form-group col-lg-6">
              <label for="">Enviar correos</label>
              <div class="input-group">
              
                <label class="switch">
                  <input type="checkbox"  id="nuevoCorreo" name="nuevoCorreo" value="1" >
                  <span class="slider round"></span>
                </label>

              </div>

            </div>

            <!-- ENTRADA PARA EL USUARIO -->

             <div class="form-group  col-lg-6">
              <label for=""><strong>Guardar bd</strong></label>
              <div class="input-group">
                <label class="switch">
                  <input type="checkbox"  id="nuevoDatos" name="nuevoDatos" value="1" >
                  <span class="slider round"></span>
                </label>
                <input type="hidden" name="idUsuarioCorreo" id="idUsuarioCorreo">
              </div>

            </div>
        </div>
      </div>         
        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Modificar correos</button>

        </div>
        <?php

          $editarUsuario = new ControladorUsuarios();
          $editarUsuario -> ctrActualizarCorreo();

        ?> 

      </form>

    </div>

  </div>

</div>
<?php

  $borrarUsuario = new ControladorUsuarios();
  $borrarUsuario -> ctrBorrarUsuario();

?> 

<script>
window.document.title = "Usuarios"
</script>
