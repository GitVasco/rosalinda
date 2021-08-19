<div class="content-wrapper">

  <section class="content-header">

    <h1>

      Ordenes de Corte

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Ordenes de corte</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">


          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarDetalleCorte">Agregar Orden de Corte</button>


      </div>

      


      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        
       <table class="table table-bordered table-striped dt-responsive tablas" width="100%">
         
        <thead>
         
         <tr>
           <th>N°</th>
           <th class="text-center" >Articulo</th>
           <th class="text-center" >Nombre</th>
           <th class="text-center" >Color</th>
           <th class="text-center" >Talla</th>
           <th class="text-center" >Marca</th>
           <th><center>Cantidad Total</center></th>
           <th class="text-center">Saldo</th> 
           <th style="width:150px">Acciones</th>

         </tr> 

        </thead>
        <tbody> 
        <?php
            $item = "ordencorte";
            $valor = $_GET["codigo"];
    
            $respuestaDetalle = ControladorOrdenCorte::ctrMostrarDetallesOrdenCorte($item, $valor);
            foreach ($respuestaDetalle as $key => $value) {
                echo '<tr>

                    <td>'.($key+1).'</td>

                    <td class="text-center">'.$value["articulo"].'</td>
                    <td class="text-center">'.$value["nombre"].'</td>
                    <td class="text-center">'.$value["color"].'</td>
                    <td class="text-center">'.$value["talla"].'</td>
                    <td class="text-center">'.$value["marca"].'</td>

                    <td class="text-center">'.$value["cantidad"].'</td>

                    <td class="text-center">'.$value["saldo"].'</td>';

                    if( $_SESSION["perfil"] == "Supervisores" ||
                        $_SESSION["perfil"] == "Sistemas"){

                          echo '<td>

                                <div class="btn-group">
                                    
                                  <button type="button" class="btn btn-warning btnEditarDetalleCorte" data-toggle="modal" data-target="#modalEditarDetalleCorte" idDetalle="'.$value["id"].'"><i class="fa fa-pencil"></i></button>
          
                                  <button  type="button" class="btn btn-danger btnEliminarDetalleCorte" codigo= "'.$_GET["codigo"].'" idDetalle="'.$value["articulo"].'" cantidad="'.$value["cantidad"].'"><i class="fa fa-times"></i></button>
          
                                </div>  
          
                              </td>';

                    }else{

                      echo '<td>

                              <div class="btn-group">
                                  
                                <button  type="button" class="btn btn-warning btnEditarDetalleCorte" data-toggle="modal" data-target="#modalEditarDetalleCorte" idDetalle="'.$value["id"].'"><i class="fa fa-pencil"></i></button>

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
MODAL AGREGAR PARA
======================================-->

<div id="modalAgregarDetalleCorte" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Agregar Detalle Orden Corte</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL NOMBRE -->
            
            <div class="form-group">
              
              <div class="input-group">
              <?php
              
                date_default_timezone_set('America/Lima');
                $ahora=date('Y/m/d h:i:s');
              
              ?>

                <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">
                <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <select  class="form-control selectpicker input-lg" name="articulo"  data-live-search="true" required>
                    <option value="">Seleccionar Articulo</option>
                    <?php
                        $orden = $_GET["codigo"];
                        $articulo=ControladorArticulos::ctrMostrarArticulosSimple($orden);
                        foreach ($articulo as $key => $value) {
                            echo '<option value="'.$value["articulo"].'">' . $value["packing"] .'</option>';
                        }
                    ?>
                </select>
                <input type="hidden" name="nuevoCodigo" id="nuevoCodigo" value="<?php echo $_GET["codigo"]?>">
              </div>

            </div>

            <!-- ENTRADA PARA EL CANTIDAD -->
                        
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control input-lg" name="cantidad" id="cantidad" placeholder="Ingresar cantidad" required>


              </div>

            </div>
  
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar detalle</button>

        </div>

        <?php

          $crearDetalle = new ControladorOrdenCorte();
          $crearDetalle -> ctrCrearDetalleOrdenCorte();


        ?>

      </form>

    </div>

  </div>

</div>


<!--=====================================
MODAL EDITAR PARA
======================================-->

<div id="modalEditarDetalleCorte" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Detalle Orden Corte</h4>

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

                <input type="text" class="form-control  input-lg" name="editarArticulo" id="editarArticulo" readonly>

                <?php
                date_default_timezone_set('America/Lima');
                $ahora=date('Y/m/d h:i:s');
              
                ?>
                 <input type="hidden" name="fechaActual" value="<?php echo $ahora; ?>">
                 <input type="hidden" name="idUsuario" value="<?php echo $_SESSION["id"]; ?>">
                 <input type="hidden"  name="idDetalle" id="idDetalle" required>
                 <input type="hidden" name="editarCodigo" id="editarCodigo" value="<?php echo $_GET["codigo"]?>">
                 <?php
                 
                  $item = "codigo";
                  $valor = $_GET["codigo"];

                  $ordencorte = ControladorOrdenCorte::ctrMostrarOrdenCorte($item, $valor);
                  //var_dump($ordencorte);

                  echo '<input type="hidden" name="totalOc" id="totalOc" value="'.$ordencorte["total"].'">';

                 
                 ?>

              </div>

            </div>
  
            <!-- ENTRADA PARA EL NOMBRE -->
                        
            <div class="form-group">
              
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-th"></i></span> 

                <input type="number" class="form-control  input-lg" name="editarCantidad" id="editarCantidad" required>

                <input type="hidden" class="form-control  input-lg" name="cantOri" id="cantOri" required>

                <input type="hidden" class="form-control  input-lg" name="cambio" id="cambio" required>


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

          $editarDetalle = new ControladorOrdenCorte();
          $editarDetalle -> ctrEditarDetalleOrdenCorte();

        ?>

      </form>

    </div>

  </div>

</div>

<?php
    $eliminarDetalle = new ControladorOrdenCorte();
    $eliminarDetalle -> ctrEliminarDetalleOrdenCorte();
?>

<script>
window.document.title = "Editar orden de corte"
</script>