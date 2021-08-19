<div class="content-wrapper">

  <section class="content-header">

    <h1>

        Editar operación para Modelo

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar Operación Modelo</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-7 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioOperacion">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->
              <?php
                $item="id";
                $valor=$_GET["idOperacion"];
                $cabecera=ControladorOperaciones::ctrMostrarCabeceraOperaciones($item,$valor);
                
                $itemUsuario="id";
                $valorUsuario=$cabecera["vendedor_fk"];

                $usuarios=ControladorUsuarios::ctrMostrarUsuarios($itemUsuario,$valorUsuario);

                $item = "modelo";
                $valor = $cabecera["articulo"];

                $articulos = ControladorOperaciones::ctrMostrarModelos($item, $valor);

               
                
              ?>
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                      value="<?php echo $usuarios["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">
                    <input type="hidden" name="editarDetalleOperacion" id="editarDetalleOperacion" value="<?php echo $_GET["idOperacion"]?>">

                  </div>

                </div>


                <!--=====================================
                ENTRADA DEL CLIENTE
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-users"></i></span>

                    <select class="form-control " id="seleccionarArticulo" name="seleccionarArticulo"  readonly required>

                      <option value="<?php echo $articulos["modelo"];?>"><?php echo $articulos["modelo"]." - ".$articulos["nombre"]; ?></option>

                    </select>

                  </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR OPERACION
                ======================================-->
                <table>
                  <thead>
                  <tr>
                      <th style="width:550px;margin-right:150px;">Codigo-Operaciones</th>
                      <th style="width:250px">Precio x Docena</th>
                      <th style="width:200px">Tiempo Standart</th>
                  </tr>
                  </thead>

                </table>
                <div class="form-group row nuevaOperacion">
                  <?php
                     $itemDetalle= "modelo";
                     $valorDetalle=$cabecera["articulo"];
                     
                     $detalle=ControladorOperaciones::ctrMostrarDetalleOperaciones($itemDetalle,$valorDetalle);
                     foreach ($detalle as $key => $value) {
                       $itemOperacion = "codigo";
                       $valorOperacion = $value["cod_operacion"];
                      
                       $infoOperacion=ControladorOperaciones::ctrMostrarOperaciones($itemOperacion,$valorOperacion);
                       echo '<div class="row" style="padding:5px 15px">
                   
                       <div class="col-xs-6" style="padding-right:0px">
                   
                         <div class="input-group">
                   
                         <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOperacion" idOperacion="'.$infoOperacion["id"].'"><i class="fa fa-times"></i></button></span>
                   
                         <input type="text" class="form-control nuevaDescripcionOperacion2" idOperacion="'.$infoOperacion["id"].'" name="agregarOperacion" value="'.$infoOperacion["codigo"]." - ".$infoOperacion["nombre"].'" codigoOP="'.$infoOperacion["codigo"].'" readonly required>
                         <input type="hidden" class="form-control nuevaDescripcionOperacion" value="'.$infoOperacion["nombre"].'" idOperacion="'.$infoOperacion["id"].'" codigoOP= "'.$infoOperacion["codigo"].'">
                         </div>
                   
                       </div>
                   
                       <div class="col-xs-3 ingresoDocena">
                   
                       <input type="number" class="form-control nuevoPrecioDocena" name="nuevoPrecioDocena" min="0" value="'.$value["precio_doc"].'" step ="any" required readonly>
                   
                       </div>
                   
                       <div class="col-xs-3 ingresoPrecio" style="padding-left:0px">
                   
                         <div class="input-group">
                   
                         <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>
                   
                         <input type="number" class="form-control nuevoTiempoStandar" name="nuevoTiempoStandar" min="0" value="'.$value["tiempo_stand"].'" step="any" required>
                   
                         </div>
                   
                       </div>
                   
                       </div>';
                     }
                  ?>


                </div>

                <input type="hidden" id="listaOperaciones" name="listaOperaciones">

                <!--=====================================
                BOTÓN PARA AGREGAR OPERACION
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarOperacion">Agregar operacion</button>

                <hr>

                <div class="row">

                  <!--=====================================
                  ENTRADA TOTAL y TIEMPO STANDAR
                  ======================================-->

                  <div class="col-xs-8 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th style="width:50%">Total x Docena</th>
                          <th style="width:50%">Total T. Standar</th>
                        </tr>

                      </thead>

                      <tbody>

                        <tr>


                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-money"></i></span>

                              <input type="number" min="1" class="form-control input-lg" id="nuevoTotalDocena" name="nuevoTotalDocena" totalDecena="" value="<?php echo $cabecera["total_pd"]?>" step="any" readonly required>



                            </div>

                          </td>

                          <td style="width: 50%">

                            <div class="input-group">

                              <span class="input-group-addon"><i class="fa fa-clock-o"></i></span>

                              <input type="number" min="1" class="form-control input-lg" id="nuevoTotalStandar" name="nuevoTotalStandar" totalStand="" value="<?php echo $cabecera["total_ts"]?>" step="any" readonly required>

                            </div>

                          </td>

                        </tr>

                      </tbody>

                    </table>

                  </div>

                </div>

                <hr>

                <br>

              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar cambios</button>
              <a href="detalleoperaciones"  class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $editarOperacion = new ControladorOperaciones();
            $editarOperacion -> ctrEditarCabeceraOperacion();

          ?>          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE OPERACIONES
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaArticuloOperaciones" width="100%">

              <thead>

                <tr>
                  <th>Código</th>
                  <th>Nombre</th>
                  <th>Acciones</th>
                </tr>

              </thead>


            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

<script>
window.document.title = "Editar operaciones modelo"
</script>