<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Administrar Tarjetas

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Administrar Tarjetas</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <?php

      if (
        $_SESSION["perfil"] == "Sistemas" ||
        $_SESSION["perfil"] == "Supervisores" ||
        $_SESSION["perfil"] == "Produccion" ||
        $_SESSION["perfil"] == "Udp" ||
        $_SESSION["perfil"] == "Costos"
      ) {

        echo '<div class="box-header with-border">
  
                  <a href="crear-tarjeta">
          
                    <button class="btn btn-primary">
                      
                      Agregar Tarjetas
          
                    </button>
          
                  </a>
                  <div class=" pull-right ">
                  <button class="btn btn-outline-success btnReporteMateriaP" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Detalle Tarjetas - General
                  </button>
                  <button class="btn btn-outline-success btnReporteTarjeta" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Tarjetas - General
                  </button>
                </div>
                </div>
                ';
      }

      ?>

      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaTarjetas" width="100%">

          <thead>

            <tr>


              <th>Código Interno</th>
              <th>Estado Tarjeta</th>
              <th style="width:65px">Fecha</th>
              <th>Total</th>
              <th>Artículo</th>
              <th>Modelo</th>
              <th>Descripcion</th>
              <th>Color-Talla</th>
              <th>Estado Artículo</th>
              <th style="width:190px">Acciones</th>

            </tr>

          </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<!--=====================================
MODAL VISUALIZAR INFORMACION
======================================-->

<div id="modalVisualizarTarjeta" class="modal fade" role="dialog">

  <div class="modal-dialog" style="width: 70% !important;">

    <div class="modal-content">

      <form role="form" method="post" class="modalSimulacion">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Detalle de Tarjeta</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA CODIGO DEL ARTICULO-->

            <div class="form-group col-lg-4">

              <label>Articulo</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="articulo" id="articulo" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA DESCRIPCION-->

            <div class="form-group col-lg-8">

              <label>Descripción</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="descripcion" id="descripcion" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA FECHA-->

            <div class="form-group col-lg-4">

              <label>Creación</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="fecha" id="fecha" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL COSTO-->

            <div class="form-group col-lg-4">

              <label>Costo x Unidad S/</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="costo" id="costo" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL ESTADO-->

            <div class="form-group col-lg-4">

              <label>Estado</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="estado" id="estado" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA EL TEJIDO PRINCIPAL-->

            <div class="form-group col-lg-8">

              <label>Tejido Principal</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="text" class="form-control input-sm" name="simulacion" id="tejidoPrincipal" required readonly>

              </div>

            </div>

            <!-- ENTRADA PARA LA SIMULACION-->

            <div class="form-group col-lg-2">

              <label>Simulación</label>

              <div class="input-group">

                <span class="input-group-addon"><i class="fa fa-caret-square-o-right"></i></span>

                <input type="number" class="form-control input-sm simulacion" min="0" value="0" required>

              </div>

            </div>

            <!-- ENTRADA PARA EL BOTON -->

            <div class="form-group col-lg-2">

              <br>

              <span type="button" class="btn btn-success btnCalcular"><i class="fa fa-refresh"></i> Calcular</span>

            </div>

            <!-- TABLA DE DETALLES -->

            <div class="form-group col-lg-12">
              <label>TABLA DETALLES</label>
            </div>

            <div class="box-body">

              <table class="table table-bordered table-striped dt-responsive tablaDetalle" width="100%">

                <thead>

                  <tr>

                    <th style="width:100px">CodPro</th>
                    <th>Materia Prima</th>
                    <th style="width:80px">Unidad</th>
                    <th>Consumo</th>
                    <th style="width:60px">TP</th>
                    <th>Costo S/</th>
                    <th>Tota S/</th>

                  </tr>

                </thead>

                <tbody>



                </tbody>

              </table>

            </div>

          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Salir</button>

        </div>



      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL AGREGAR FICHA TECNICA
======================================-->

<div id="modalAgregarFichaTecnica" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post" enctype="multipart/form-data">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Ficha tecnica</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            <label for=""><strong>CODIGO DE TARJETA</strong></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="text" name="nuevaTarjeta" id="nuevaTarjeta" class="form-control input-lg" readonly>
                <input type="hidden" name="idTarjeta" id="idTarjeta">

              </div>

            </div>

            <!-- ENTRADA PARA EL MODELO -->
            
            <div class="form-group">
              <label for=""><strong>MODELO</strong></label>
              <div class="input-group">
                
                <span class="input-group-addon"><i class="fa fa-paper-plane"></i></span> 

                <input type="text" class="form-control input-lg" name="nuevoModelo" id="nuevoModelo"   readonly>

              </div>

            </div>
            
            
            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
            <label for=""><strong>FICHA TECNICA</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-file-pdf-o"></i></span> 

                <input type="file" class="form-control input-lg" name="nuevoArchivo"  accept="application/pdf" required>

              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar ficha tecnica</button>

        </div>

        <?php

          $crearFicha = new ControladorTarjetas();
          $crearFicha -> ctrCrearFichaTecnica();

        ?>

      </form>

    </div>

  </div>

</div>

<script>
window.document.title = "Tarjetas"
</script>