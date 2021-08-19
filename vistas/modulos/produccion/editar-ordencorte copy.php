<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Editar Orden de Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Editar orden de corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-5 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border"></div>

          <form role="form" method="post" class="formularioOrdenCorte">

            <div class="box-body">

              <div class="box">

              <?php
              
              $item = "codigo";
              $valor = $_GET["codigo"];

              $ordencorte = ControladorOrdenCorte::ctrMostrarOrdenCorte($item, $valor);
              #var_dump("ordencorte", $ordencorte);

              date_default_timezone_set('America/Lima');
              $ahora=date('Y/m/d h:i:s');
              
              ?>

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <b><input type="text" class="form-control" id="usuario" name="usuario"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly></b>

                    <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                    
                    <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">

                    <input type="hidden" name="codigoE" value="<?php echo $ordencorte["codigo"]; ?>">


                  </div>

                </div>

                <!--=====================================
                ENTRADA DEL CODIGO INTERNO
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-key"></i></span>

                    <b><input type="text" class="form-control" id="editarCodigo" name="editarCodigo" value="<?php echo $ordencorte["codigo"]; ?>" readonly></b>


                  </div>

                </div>

                <!--=====================================
                ENTRADA DE LA CONFIGURACION
                ======================================-->

                <div class="form-group">

                    <div class="input-group">

                        <span class="input-group-addon"><i class="fa fa-percent"></i></span>

                        <b><input type="text" class="form-control" id="configuracion" name="configuracion" value="<?php echo $ordencorte["configuracion"]; ?>" readonly></b>

                    </div>

                </div>

                <!--=====================================
                ENTRADA PARA AGREGAR ARTICULOS
                ======================================-->

                <div class="form-group row nuevoArticuloOC">

                <?php

                  $listaArticuloOC = ControladorOrdenCorte::ctrMostrarDetallesOrdenCorte("ordencorte",$ordencorte["codigo"]);
                  #var_dump("ordencorte", $ordencorte["codigo"]);
                  #var_dump("listaArticuloOC", $listaArticuloOC);
                  
                  foreach($listaArticuloOC as $key=>$value){

                    $infoArticulo = controladorArticulos::ctrMostrarArticulos($value["articulo"]);
                    #var_dump("infoArticulo", $infoArticulo);

                    $ocAntiguo = $infoArticulo["ord_corte"] - $value["cantidad"];
                    #var_dump("ocAntiguo", $ocAntiguo);
                                        
                    echo '<div class="row" style="padding:5px 15px">

                            <div class="col-xs-9" style="padding-right:0px">
                        
                              <div class="input-group">
                        
                                <span class="input-group-addon"><button type="button" class="btn btn-danger btn-xs quitarOC" articuloOC="'.$infoArticulo["articulo"].'"><i class="fa fa-times"></i></button></span>
                        
                                <input type="text" class="form-control nuevaDescripcionProducto" articuloOC="'.$infoArticulo["articulo"].'" name="agregarOC" value="'.$infoArticulo["packing"].'" codigoAC="'.$infoArticulo["articulo"].'" readonly required>
                        
                              </div>
                        
                            </div>
                        
                            <div class="col-xs-3">
                        
                              <input type="number" class="form-control nuevaCantidadArticuloOC" name="nuevaCantidadArticuloOC" min="1" value="'.$value["cantidad"].'" ord_corte="'.$ocAntiguo.'" nuevoOrdCorte="'.$infoArticulo["ord_corte"].'" required>
                        
                            </div>
                
                      </div>';                  

                  }


                ?>                

                </div>

                <input type="hidden" id="listaArticulosOC" name="listaArticulosOC">                

                <div class="row">

                  <!--=====================================
                  ENTRADA TOTAL
                  ======================================-->

                  <div class="col-xs-6 pull-right">

                    <table class="table">

                      <thead>

                        <tr>
                          <th>Total</th>
                        </tr>

                      </thead>

                      <tbody>

                      <tr>

                        <td style="width: 50%">

                          <div class="input-group">

                            <span class="input-group-addon"><i class="fa fa-scissors"></i></span>

                            <input type="text" min="1" class="form-control input-lg" id="nuevoTotalOrdenCorte"
                              name="nuevoTotalOrdenCorte" total="<?php echo $ordencorte["total"]; ?>" value="<?php echo $ordencorte["total"]; ?>" readonly required>

                            <input type="hidden" name="totalOrdenCorte" id="totalOrdenCorte" value="<?php echo $ordencorte["total"]; ?>">


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

              <button type="submit" class="btn btn-primary pull-right"><i class="fa fa-floppy-o"></i>  Guardar Orden Corte</button>
              
              <a href="ordencorte" id="cancel" name="cancel" class="btn btn-danger"><i class="fa fa-times-circle"></i> Cancelar</a>
            </div>

          </form>

          <?php

            $editarOrdenCorte = new ControladorOrdenCorte();
            $editarOrdenCorte -> ctrEditarOrdenCorte();

          ?>            
          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE ARTICULOS
      ======================================-->

      <div class="col-lg-7 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border"></div>

          <div class="box-body">

            <table class="table table-bordered table-striped table-condensed tablaArticulosOrdenCorte" width="100%">

              <thead>

                <tr>
                  <th>Modelo</th>
                  <th>Color</th>
                  <th>Talla</th>
                  <th>Proy</th>
                  <th>Prod</th>
                  <th>Avance</th>
                  <th>Stock</th>
                  <th>Ped.</th>
                  <th>En Taller</th>
                  <th>Alm. Corte</th>
                  <th>Ord. Corte</th>
                  <th>Vtas 30d</th>
                  <th>Xprog</th>
                  <th style="width:10px">Acciones</th>
                </tr>

              </thead>



            </table>

          </div>

        </div>


      </div>

    </div>

  </section>

</div>

