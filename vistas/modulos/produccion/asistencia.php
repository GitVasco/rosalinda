<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Administrar asistencias
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Administrar asistencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <div class="pull-left" >
        <?php
        date_default_timezone_set('America/Lima');
        $hoy= date("Y-m-d");
        $marcoAsistencia=ControladorAsistencias::ctrMostrarPresente();
        if($marcoAsistencia["fecha"] != $hoy){
          
          echo '
            <form role="form" method="post">
              <button type="submit" class="btn btn-primary  " name="btnRegistrarAsistencia">
                <i class="fa fa-plus-square"></i>
                Registrar asistencias

              </button>
            </form>';
        
            if(isset($_POST["btnRegistrarAsistencia"])){
              $crearAsistencia= new ControladorAsistencias();
              $crearAsistencia-> ctrCrearAsistencia();
            }
        
          
        }
          ?>
          <br>
        <button type="button" class="btn btn-info " data-toggle='modal' data-target='#modalAsistenciaFecha'><i class="fa fa-calendar"></i> Asistencia x fecha</button>
        <button type="button" class="btn btn-success btnAumentarMin" data-toggle='modal' data-target='#modalAgregarTiempo'><i class="fa fa-plus-circle"></i> Aumentar tiempo</button>
        <button type="button" class="btn btn-danger btnRestarMin" data-toggle='modal' data-target='#modalQuitarTiempo'><i class="fa fa-minus-circle"></i> Restar tiempo</button>
      </div>
      <button class="btn btn-outline-success pull-right btnReporteAsistencia"  style="border:green 1px solid">
                      <img src="vistas/img/plantilla/excel.png" width="20px"> Reporte Asistencias  </button>
      <br><br><br>
      <button type="button" class="btn btn-default pull-right" id="daterange-btnes">

          <span>
            <i class="fa fa-calendar"></i>

            <?php

              if(isset($_GET["fechaInicial"])){

                echo $_GET["fechaInicial"]." - ".$_GET["fechaFinal"];

              }else{
              
                echo 'Rango de fecha';

              }

            ?>

          </span>

          <i class="fa fa-caret-down"></i>

        </button>
      </div>

      <div class="box-body">
        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto">
        <input type="hidden" value="<?= $_GET["ruta"]; ?>" id="rutaAcceso">
        <table class="table table-bordered table-striped dt-responsive tablaAsistencias" width="100%">
          
        <thead>
         <tr>
           
           <th>Codigo trabajador</th>
           <th>Trabajador</th>
           <th>Estado</th>
           <th>Fecha</th>
           <th>Minutos</th>
           <th>Horas extras</th>
           <th style="width:120px;">Acciones</th>

         </tr> 

        </thead>

        <tbody>
         <?php
            // if(isset($_GET["fechaInicial"])){

            //   $fechaInicial = $_GET["fechaInicial"];
            //   $fechaFinal = $_GET["fechaFinal"];

            // }else{

            //   $fechaInicial = null;
            //   $fechaFinal = null;

            // }
            // $respuesta = ControladorAsistencias::ctrRangoFechasAsistencias($fechaInicial, $fechaFinal);
            // foreach ($respuesta as $key => $value) {

            //   if($value["estado"] == "ASISTIO"){

            //     $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$value["id"]."' estadoAsistencia='FALTA'><img id='estadoImagen' src='vistas/img/plantilla/asistio.png'  width='40px'></button>";
                
    
            // }else{
    
            //     $imagen = "<button class='btnAprobarAsistencia' idAsistencia='".$value["id"]."' estadoAsistencia='ASISTIO'><img id='estadoImagen' src='vistas/img/plantilla/falto.png'  width='40px'></button>";
                
            // }

            //   $botones =  "<div class='btn-group'><button class='btn btn-danger btnEditarAsistencia' idAsistencia='".$value["id"]."' data-toggle='modal' data-target='#modalEditarAsistencia' title='Editar para'><i class='fa fa-exclamation-triangle'></i></button><button class='btn btn-success btnEditarExtras' idAsistencia='".$value["id"]."' data-toggle='modal' data-target='#modalEditarExtras' title='Editar horas extras'><i class='fa fa-clock-o'></i></button></div>"; 

            // echo '<tr>
            //         <td>'.$value["id_trabajador"].'</td>
            //         <td>'.$value["nom_tra"].$value["ape_pat_tra"].$value["ape_mat_tra"].'</td>
            //         <td>'.$imagen.'</td>
            //         <td>'.date("Y-m-d",strtotime($value["fecha"])).'</td>
            //         <td>'.$value["minutos"].'</td>
            //         <td>'.$value["nombre"].'</td>
            //         <td>'.$value["tiempo_para"].'</td>
            //         <td>'.$value["horas_extras"].'</td>
            //         <td>'.$botones.'</td></tr>';
            // }
         ?> 
        </tbody>

       </table>

      </div>

    </div>

  </section>

</div>



<!--=====================================
MODAL EDITAR Asistencia
======================================-->

<div id="modalEditarAsistencia" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" id="formularioAsistencia" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar asistencia</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-3">
            <label ><strong>Codigo Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo" id="editarCodigo" readonly>
                
              </div>

            </div>

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-9" style="margin-top:20px">
            <label ><strong>Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTrabajador" id="editarTrabajador" readonly>
                
              </div>

            </div>
            <div class="box box-primary col-lg-12">
            <!-- ENTRADA PARA EL MINUTOS -->
            <div class="form-group col-lg-12 ingresoMinuto">
            <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg nuevoMinuto" name="editarMinutos" id="editarMinutos" step="any" min="0" original="" original2="" required readonly>
                <input type="hidden" id="idAsistencia" name="idAsistencia">
                <input type="hidden" id="cantidad" name="cantidad">
                <input type="hidden" id="sumaPara" name="sumaPara">
              </div>

            </div>
            </div>
            <!-- ENTRADA PARA PARAS -->
            <div class="box box-primary col-lg-12 paras">

              <!-- <div class="form-group col-lg-6">
                <label ><strong>Para</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span> 

                  <select name="editarPara" id="editarPara" class="form-control input-lg selectpicker" data-live-search="true">
                    <option value="">Seleccionar Para</option>

                    <?php 
                      // $item=null;
                      // $valor=null;
                      // $para=ControladorParas::ctrMostrarParas($item,$valor);
                      // foreach ($para as $key => $value) {
                      //   echo"<option value='".$value['id']."'>".$value["nombre"]."</option>";
                      // }
                    ?>
                  </select>
                </div>

              </div>

              
              <div class="form-group col-lg-6 ">
                <label><strong>Tiempo de para</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="number" class="form-control input-lg" name="editarTiempoPara" id="editarTiempoPara" step="any" min="0" max="585" required>
               
                </div>

              </div> -->
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
MODAL EDITAR PARA
======================================-->

<div id="modalEditarPara" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" id="formularioAsistencia" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">CREAR PARA</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-3">
            <label ><strong>Codigo Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo3" id="editarCodigo3" required>
                
              </div>

            </div>

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-9" style="margin-top:20px">
            <label ><strong>Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTrabajador3" id="editarTrabajador3" required>
                
              </div>

            </div>
            <div class="box box-primary col-lg-12">
            <!-- ENTRADA PARA EL MINUTOS -->
            <div class="form-group col-lg-12 ingresoMinuto">
            <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg nuevoMinuto" name="editarMinutos3" id="editarMinutos3" step="any" min="0" original="" original2="" required readonly>
                <input type="hidden" id="idAsistencia3" name="idAsistencia3">
                
                
              </div>

            </div>
            </div>
            
            <!-- ENTRADA PARA PARAS -->
            <div class="box box-primary col-lg-12 ">
                
              <div class="form-group col-lg-6">
                <label ><strong>Para</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-hand-o-right"></i></span> 

                  <select name="editarPara3" id="editarPara3" class="form-control input-lg selectpicker" data-live-search="true">
                    <option value="">Seleccionar Para</option>

                    <?php 
                      $item=null;
                      $valor=null;
                      $para=ControladorParas::ctrMostrarParas($item,$valor);
                      foreach ($para as $key => $value) {
                        echo"<option value='".$value['id']."'>".$value["nombre"]."</option>";
                      }
                    ?>
                  </select>
                </div>

              </div>

              <!-- ENTRADA PARA EL TIEMPO DE PARA -->
              
              <div class="form-group col-lg-6 ">
                <label><strong>Tiempo de para (minutos)</strong></label>
                <div class="input-group">
                
                  <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                  <input type="number" class="form-control input-lg" name="editarTiempoPara3" id="editarTiempoPara3" step="any" min="0" max="585" required>
               
                </div>

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

        $editarAsistenciaPara = new ControladorAsistencias();
        $editarAsistenciaPara -> ctrEditarPara();

      ?>   


    </div>

  </div>

</div>

<!--=====================================
MODAL EDITAR HORAS EXTRAS
======================================-->

<div id="modalEditarExtras" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form"  method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">Editar Extras</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-3">
            <label ><strong>Codigo Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarCodigo2" id="editarCodigo2" required>
                
              </div>

            </div>

            <!-- ENTRADA PARA EL MINUTOS -->
            
            <div class="form-group col-lg-9" style="margin-top:20px">
            <label ><strong>Trabajador</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="text" class="form-control input-lg" name="editarTrabajador2" id="editarTrabajador2" required>
                
              </div>

            </div>
            <div class="box box-primary col-lg-12">
            <!-- ENTRADA PARA EL MINUTOS -->
            <div class="form-group col-lg-12 ">
            <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg " name="editarMinutos2" id="editarMinutos2" step="any" min="0" originales="" originales2="" required readonly>
                <input type="hidden" id="idAsistencia2" name="idAsistencia2">
              </div>

            </div>
            </div>

              <!-- ENTRADA PARA EL TIEMPO DE PARA -->
              <div class="box box-primary col-lg-12">
                <div class="form-group col-lg-12">
                  <label><strong>Horas Extras</strong></label>
                  <div class="input-group">
                  
                    <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                    <input type="number" class="form-control input-lg" name="editarExtras" id="editarExtras" step="any" min="0" required>
                    
                  </div>

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

        $editarExtra = new ControladorAsistencias();
        $editarExtra -> ctrEditarExtra();

      ?>   


    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR TIEMPO
======================================-->

<div id="modalAgregarTiempo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">AGREGAR TIEMPO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group col-lg-12 ">
              <label ><strong>Fecha</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="date" class="form-control input-lg " name="aumentarFecha" id="aumentarFecha"   value = <?php $fecha =  new Datetime(); echo $fecha->format("Y-m-d"); ?>>
                
                
              </div>

            </div>
           
            <div class="form-group col-lg-12 ">
              <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg " name="agregarMinutos" id="agregarMinutos" step="any" min="0"  required>
                
                
              </div>

            </div>
                      
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Agregar tiempo</button>

        </div>

      </form>

      <?php

        $agregarAsistencia = new ControladorAsistencias();
        $agregarAsistencia -> ctrAgregarTiempo();

      ?>   


    </div>

  </div>

</div>


<!--=====================================
MODAL QUITAR TIEMPO
======================================-->

<div id="modalQuitarTiempo" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">RESTAR TIEMPO</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

          <div class="form-group col-lg-12 ">
              <label ><strong>Fecha</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="date" class="form-control input-lg " name="quitarFecha" id="quitarFecha"  value = <?php $fecha =  new Datetime(); echo $fecha->format("Y-m-d"); ?> >
                
                
              </div>

            </div>

            <div class="form-group col-lg-12 ">
              <label ><strong>Minutos</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="number" class="form-control input-lg " name="quitarMinutos" id="quitarMinutos" step="any" min="0"  required>
                
                
              </div>

            </div>
                      
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Restar tiempo</button>

        </div>

      </form>

      <?php

        $restarAsistencia = new ControladorAsistencias();
        $restarAsistencia -> ctrQuitarTiempo();

      ?>   


    </div>

  </div>

</div>

<!--=====================================
MODAL AGREGAR TIEMPO
======================================-->

<div id="modalAsistenciaFecha" class="modal fade" role="dialog">
  
  <div class="modal-dialog">

    <div class="modal-content">

      <form role="form" method="post">

        <!--=====================================
        CABEZA DEL MODAL
        ======================================-->

        <div class="modal-header" style="background:#3c8dbc; color:white">

          <button type="button" class="close" data-dismiss="modal">&times;</button>

          <h4 class="modal-title">ASISTENCIA X FECHA</h4>

        </div>

        <!--=====================================
        CUERPO DEL MODAL
        ======================================-->

        <div class="modal-body">

          <div class="box-body">

            <div class="form-group col-lg-12 ">
              <label ><strong>Fecha</strong></label>
              <div class="input-group">
              
                <span class="input-group-addon"><i class="fa fa-clock-o"></i></span> 

                <input type="date" class="form-control input-lg " name="fechaAsitencia" id="fechaAsitencia"   required>
                
                
              </div>

            </div>
                      
          </div>

        </div>

        <!--=====================================
        PIE DEL MODAL
        ======================================-->

        <div class="modal-footer">

          <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Salir</button>

          <button type="submit" class="btn btn-primary">Guardar Asistencia</button>

        </div>

      </form>

      <?php

        $registrarAsistenciaFecha = new ControladorAsistencias();
        $registrarAsistenciaFecha -> ctrCrearAsistenciaFecha();

      ?>   


    </div>

  </div>

</div>

<script>
window.document.title = "Asistencias"
</script>