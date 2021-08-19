<div class="content-wrapper">
    <!-- Header del Contenido -->
    <section class="content-header">

        <h1>Movimientos Ventas</h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-home"></i> Inicio</a></li>
            <li class="active">Movimientos Ventas</li>

        </ol>

    </section>

    <!-- Sección de Contenido -->
    <section class="content">

        <div class="box">

            <div class="box-header with-border">
                <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">

                    <select class="form-control selectpicker input-lg" id="modeloV" name="modeloV" data-live-search="true" data-size="10">

                    <option value="">Seleccione Modelo</option>

                        <?php

                        $item = null;
                        $valor = null;

                        $modelo = ControladorModelos::ctrMostrarModelos($item, $valor);

                        foreach ($modelo as $key => $value) {
                        
                        echo '<option value="'.$value["modelo"].'">'.$value["modelo"].' - '.$value["nombre"].'</option>';
                        }

                        ?>

                    </select>

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                
                    <button class="btn btn-primary btnLimpiarModV"><i class="fa fa-refresh"></i> LIMPIAR</button>

                </div>
                <div class=" pull-right ">
                  <button class="btn btn-outline-success btnReporteVentas" modelo="" style="border:green 1px solid">
                    <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Ventas  </button>
                </div>
            </div>

            <div class="box-body">

                <table class="table table-bordered table-condensed  dt-responsive tablaMVta" width="100%">

                    <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">

                    <thead>

                        <tr >
                            <th>Modelo</th>
                            <th>Artículo</th>
                            <th>Nombre</th>
                            <th>Color</th>
                            <th>Talla</th>
                            <th>Estado</th>
                            <th>Ene</th>
                            <th>Feb</th>
                            <th>Mar</th>
                            <th>Abr</th>
                            <th>May</th>
                            <th>Jun</th>
                            <th>Jul</th>
                            <th>Ago</th>
                            <th>Sep</th>
                            <th>Oct</th>
                            <th>Nov</th>
                            <th>Dic</th>
                            <th>Total</th>
                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>