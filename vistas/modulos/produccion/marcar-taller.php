<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Registro de Tareas a Talleres

        </h1>

        <ol class="breadcrumb">

            <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Registro Talleres</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <!--=====================================
            LA TABLA DE EN PROCESO
            ======================================-->

            <div class="col-lg-8 hidden-md hidden-sm hidden-xs">

                <div class="box box-primary">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">En Proceso</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerPB" width="100%">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Inicio</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>

                <div class="box box-success">

                    <div class="box-header with-border"></div>

                    <div class="box-body">

                    <h3 class="box-title">Terminado</h3>

                        <table class="table table-bordered table-striped dt-responsive tablaTallerTB" width="100%">

                            <thead>

                                <tr>
                                    <th style="width: 50px">Cod. Barra</th>
                                    <th>Trabajador</th>
                                    <th>Operación</th>
                                    <th>Artículo</th>
                                    <th>Cantidad</th>
                                    <th>Estado</th>
                                    <th>Hora Fin</th>
                                </tr>

                            </thead>

                        </table>

                    </div>

                </div>                


            </div>
         

            <!--=====================================
            EL FORMULARIO
            ======================================-->

            <div class="col-lg-4 col-xs-12">

                <div class="box box-info">

                    <div class="box-header with-border"></div>

                    <form role="form" method="post">

                        <div class="box-body">

                            <div class="box">

                                <div class="form-group" align="center">

                                    <img src="vistas/img/plantilla/jackyform_paloma.png" width="400px" height="400px">

                                </div>
                                
                                <br>

                                <?php

                                $usuario = $_SESSION["id"];
                                $trabajador = ControladorTrabajador::ctrMostrarTrabajadorConfigurado($usuario);
                                //var_dump($trabajador);


                                ?>

                                    <!--=====================================
                                    ENTRADA DEL TRABAJADOR
                                    ======================================-->

                                    <div class="box-header with-border">

                                        <button type="button" class="btn btn-info" id="asddadad" name="asddadad" data-toggle="modal" data-target="#fsdfsfsd">Seleccionar Trabajador
                                        </button>

                                    </div>

                                    <div class="form-group">

                                        <div class="input-group">

                                            <span class="input-group-addon"><i class="fa fa-users"></i></span>

                                            <input type="hidden" id="cod_tra" name="cod_tra" value="<?php echo $trabajador["cod_tra"]; ?>">

                                            </div>

                                    </div>                                

                                    <div class="box box-success">

                                        <div class="box-header">

                                            <h2 align="center"> Hola "<?php echo $trabajador["trabajador"];?>"</h2>

                                        </div>

                                    </div>

                                <br>

                                <!--=====================================
                                ENTRADA DEL CODIGO
                                ======================================-->

                                <div class="form-group">

                                    <div class="input-group">

                                        <span class="input-group-addon"><i class="fa fa-barcode"></i></span>

                                        <input type="text" class="form-control" id="codigoBarra" name="codigoBarra" placeholder="Ingresar Código" autofocus>

                                    </div>

                                </div>

                            </div>

                        </div>

                        <div class="box-footer">

                            <button type="submit" class="btn btn-primary pull-right">Registrar</button>

                        </div>

                    </form>

                    <?php

                    $registrarProceso = new ControladorTalleres();
                    $registrarProceso -> ctrProceso();

                    ?> 

                </div>

            </div>

        </div>

    </section>

</div>

<!--=====================================
MODAL CONFIGURAR Trabajador
======================================-->

<div id="fsdfsfsd" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Configurar Trabajador</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">


            <!-- ENTRADA PARA PORCENTAJE -->

            <div class="form-group">
              
              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-user-o"></i></span>

                <input type="hidden" id="usuario" name="usuario" value = "<?php echo $_SESSION["id"]?>">

                  <select class="form-control input-sm selectpicker" id="trabajadorSelect" name="trabajadorSelect" data-live-search="true" required>

                    <option value="">Seleccionar Trabajador</option>

                    <?php

                    $trabajador = ControladorTrabajador::ctrMostrarTrabajadorActivo();
                    #var_dump("trabajador", $trabajador);

                    foreach ($trabajador as $key => $value) {

                      echo '<option value="' . $value["cod_tra"] . '">' . $value["cod_tra"] . ' - ' . $value["nom_tra"] . ', ' . $value["ape_pat_tra"] . ' ' . $value["ape_mat_tra"] . '</option>';
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

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Configurar Trabajador</button>

        </div>

      </form>

        <?php

          $configurarTrabajador = new ControladorTrabajador();
          $configurarTrabajador -> ctrConfigurarTrabajador();

        ?>  


    </div>

  </div>

</div>
<script>
window.document.title = "Registrar tareas"
</script>