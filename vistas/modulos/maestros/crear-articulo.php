<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Crear Articulos x Modelos

    </h1>

    <ol class="breadcrumb">

      <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Crear Articulos x Modelos</li>

    </ol>

  </section>

  <section class="content">

    <div class="row">

      <!--=====================================
      EL FORMULARIO
      ======================================-->

      <div class="col-lg-7 col-xs-12">

        <div class="box box-success">

          <div class="box-header with-border">
            
          </div>

          <form role="form" method="post" class="formularioArticulo">

            <div class="box-body">

              <div class="box">

                <!--=====================================
                ENTRADA DEL VENDEDOR
                ======================================-->

                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-user"></i></span>

                    <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor"
                      value="<?php echo $_SESSION["nombre"]; ?>" readonly>

                    <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"]; ?>">

                  </div>

                </div>


                <!--=====================================
                ENTRADA DEL MODELO
                ======================================-->
                <?php 
                 $item="modelo";
                 $valor=$_GET["modelo"];
                 $_SESSION["modelos"]=$_GET["modelo"];
                $modelo= ControladorModelos::ctrMostrarModelos($item,$valor);
                 ?>
                <div class="form-group">

                  <div class="input-group">

                    <span class="input-group-addon"><i class="fa fa-tag"></i></span>

                    <input type="text" class="form-control" id="nuevoModelos" name="nuevoModelos" value='<?php echo $modelo["modelo"].' - '. $modelo["nombre"]?>' readonly>
                  </div>
                  <input type="hidden" name="nuevaDescripcion" value='<?php echo $modelo["nombre"] ?>'>
                  <input type="hidden" name="nuevoModelo" value='<?php echo $modelo["modelo"] ?>'>
                </div>

                 <!--=====================================
                ENTRADA DE MRCA
                ======================================-->
                <div class="form-group">

                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-th"></i></span>

                  <input type="text" name="nuevaDescripcionMarca" class="form-control"  value='<?php echo $modelo["marca"]?>' readonly>
                  <input type="hidden" id="nuevaMarca" name="nuevaMarca" value='<?php echo $modelo["id_marca"]?>'>
                  </div>
                  
                </div>


                 <!--=====================================
                ENTRADA DE DESCUENTOS
                ======================================-->
                <div class="form-group col-md-7">
                  <label for="">Se aplican descuentos según la cantidad de unidades</label>
                  <label class="switch"> <input type="checkbox" name='descuentos' value="1"> <span class="slider round"></span></label>
                  
                </div>


                <!--=====================================
                ENTRADA DE PRECIOS
                ======================================-->
                <div class="form-group col-md-5">

                  <label for="precios">Permitir precios digitados</label>  
                  <label class="switch"> <input type="checkbox" name='precios'value="1"> <span class="slider round"></span></label>
                  
                </div>

                <!--=====================================
                ENTRADA DE EFECTOS A DESCUENTOS
                ======================================-->
                <div class="form-group col-md-7">

                  <label for="efectos">Articulo afecto a descuentos</label>
                  <label class="switch"> <input type="checkbox" name='efectosDesc' value="1"> <span class="slider round"></span></label>
                  
                </div>

                <!--=====================================
                ENTRADA DE EFECTOS A IGV
                ======================================-->
                <div class="form-group col-md-5">

                  <label for="efectos">Articulo afecto a IGV</label>
                  <label class="switch"> <input type="checkbox" name='efectosIGV' value="1"> <span class="slider round"></span></label>
                  
                </div>

                 <!--=====================================
                ENTRADA DE GRUPOS DE TALLAS
                ======================================-->
                <div class="form-group ">

                  <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-users"></i></span>
                  <select name="nuevoGrupoTalla" id="nuevoGrupoTalla" class="form-control">
                    <option value="">SELECCIONAR UN GRUPO</option>
                    <option value="TRUSA">TRUSA</option>
                    <option value="NIÑOS">NIÑOS</option>
                    <option value="BRASIER">BRASIER</option>
                  </select>
                  </div>
                </div>
                <div class="form-group  nuevaTalla " align="center"  >



                </div>
                <!--=====================================
                ENTRADA PARA AGREGAR TALLAS X COLORES
                ======================================-->
                <table>
                  <thead>
                  <tr>
                      <th style="width:150px;text-align:center;">COLOR</th>
                  </tr>
                  </thead>

                </table>
                
                <div class="form-group row nuevoColor">



                </div>

                <input type="hidden" id="listaColores" name="listaColores">

                <!--=====================================
                BOTÓN PARA AGREGAR ARTICULO RESPONSIVE
                ======================================-->

                <button type="button" class="btn btn-default hidden-lg btnAgregarArticulo">Agregar Articulo</button>

                <hr>


              </div>

            </div>

            <div class="box-footer">

              <button type="submit" class="btn btn-primary pull-right">Guardar Articulos</button>

            </div>

          </form>

          <?php

            $guardarArticulo = new ControladorArticulos();
            $guardarArticulo -> ctrCrearArticuloModelo();

          ?>          

        </div>

      </div>

      <!--=====================================
      LA TABLA DE COLORES
      ======================================-->

      <div class="col-lg-5 hidden-md hidden-sm hidden-xs">

        <div class="box box-warning">

          <div class="box-header with-border">
           
          </div>

          <div class="box-body">

            <table class="table table-bordered table-striped dt-responsive tablaArticuloColores" width="100%">

              <thead>

                <tr>
                  <th class="text-center">Código</th>
                  <th class="text-center">Nombre</th>
                  <th class="text-center">Acciones</th>
                </tr>

              </thead>
              <tbody>
              <?php

                $item = null;
                $valor = null;

                $colores = ControladorColores::ctrMostrarColores($item, $valor);

                foreach ($colores as $key => $value) {
                

                echo '<tr>

                <td class="text-center">'.$value["cod_color"].'</td>

                <td class="text-center">'.$value["nom_color"].'</td>';

                if( $_SESSION["perfil"] == "Supervisores" ||
                    $_SESSION["perfil"] == "Sistemas"){

                        echo '<td class="text-center">

                                 <div class="btn-group"><button class="btn btn-primary btn-xs recuperarBoton  agregarColor" idColor="'.$value["cod_color"].'"><i class="fa fa-plus-circle"></i> Agregar</button></div>
                            </td>';

                }else{

                    echo '<td class="text-center">

                            <div class="btn-group"><button class="btn btn-primary btn-xs recuperarBoton  agregarColor" idColor="'.$value["cod_color"].'"><i class="fa fa-plus-circle"></i> Agregar</button></div>

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


      </div>

    </div>

  </section>

</div>


<script>
window.document.title = "Crear articulos"
</script>