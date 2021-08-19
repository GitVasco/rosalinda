<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar Abonos

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar Abonos</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header width-border">
                <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarAbono">Agregar Abono</button>
                <button class="btn btn-success" data-toggle="modal" data-target="#modalImportarAbono"><i class="fa fa-upload"></i> Importar Abono</button>
                
            </div>
            <div class="box-body">

                <table class="table table-bordered table-striped dt-responsive tablaAbonos" width = "100%">

                    <thead>

                        <tr>

                            <th>Fecha</th>
                            <th>Descripción</th>
                            <th>Monto</th>
                            <th>Agencia</th>
                            <th>Operación</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>


<!--=====================================
MODAL AGREGAR ABONO
======================================-->

<div id="modalAgregarAbono" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar abono</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA FECHA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="date"  class="form-control input-lg" name="nuevaFecha"  required>

              </div>

            </div>          

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaDescripcion" placeholder="Ingresar descripción" required>

              </div>

            </div>

            <!-- ENTRADA PARA MONTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="nuevoMonto" placeholder="Ingresar monto" required>

              </div>

            </div>  

            <!-- ENTRADA PARA AGENCIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-university"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevaAgencia" placeholder="Ingresar agencia" required>

              </div>

            </div>  

            <!-- ENTRADA PARA OPERACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bolt"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoOpe" placeholder="Ingresar codigo operación" required>

              </div>

            </div>  

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar abono</button>

        </div>

      </form>


      <?php

        $crearAbono = new ControladorAbonos();
        $crearAbono -> ctrCrearAbono();

      ?>


    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR ABONO
======================================-->

<div id="modalEditarAbono" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar abono</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          
            <!-- ENTRADA PARA FECHA  -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span> 

                <input type="date"  class="form-control input-lg" name="editarFecha" id="editarFecha" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-text-width"></i></span> 

                <input type="text" class="form-control input-lg" name="editarDescripcion" id="editarDescripcion" required>
                <input type="hidden" id="idAbono" name="idAbono">
              </div>

            </div>
  
            <!-- ENTRADA PARA MONTO -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-usd"></i></span> 

                <input type="number" min="0" step="any" class="form-control input-lg" name="editarMonto" id="editarMonto" required>
              </div>

            </div>

            <!-- ENTRADA PARA AGENCIA -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-university"></i></span> 

                <input type="text" class="form-control input-lg" name="editarAgencia" id="editarAgencia" required>
              </div>

            </div>

            <!-- ENTRADA PARA OPERACION -->
            
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-bolt"></i></span> 

                <input type="text" class="form-control input-lg" name="editarOpe" id="editarOpe" required>
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

        $editarAbono = new ControladorAbonos();
        $editarAbono -> ctrEditarAbono();

      ?>   


    </div>

  </div>

</div>


<!--=====================================
MODAL IMPORTAR CUENTAS DE BANCO
======================================-->

<div id="modalImportarAbono" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Importar abonos</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL CODIGO -->
            
            <div class="form-group">
            <label for=""><h3>Archivo de banco para abonos</h3></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-key"></i></span> 

                <input type="file"  class="form-control input-lg" name="nuevoAbono" id="nuevoAbono"  required>

              </div>

            </div>        

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary" name="importAbono">Importar abonos</button>

        </div>

      </form>


      <?php

        $importarAbono = new ControladorAbonos();
        $importarAbono -> ctrImportarAbono();

      ?>


    </div>

  </div>

</div>

<?php

  $eliminarAbono = new ControladorAbonos();
  $eliminarAbono -> ctrEliminarAbono();

?>


<script>
    window.document.title = "Abonos"
</script>