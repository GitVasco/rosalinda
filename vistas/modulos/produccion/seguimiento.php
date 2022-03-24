<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Seguimiento
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Urgencias</li>
    
    </ol>

  </section>

  <section class="content">

    <div class="box">

      <div class="box-header with-border">

      <div class="col-lg-2">
                <select name="selectArticuloUrgenciaSeg" id="selectArticuloUrgenciaSeg" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
                <option value="">--------Seleccionar articulo-------</option>
                <?php
                    $modelos =controladorModelos::ctrMostrarModelosActivos();
                    // var_dump($modelos);
                    foreach ($modelos as $key => $value) {
                            echo '<option value="'.$value["modelo"].'">'.$value["nombre"].'</option>';

                    }

                ?>
                </select>
            </div>

            <div class="col-lg-1">
                <button class="btn btn-primary btnLimpiarArticuloUrgenciaSeg"  name="btnLimpiarArticuloUrgenciaSeg"><i class="fa fa-refresh"></i> Limpiar</button>
            </div>


      </div>

      <div class="box-body">

        <input type="hidden" value="<?=$_SESSION["perfil"];?>" id="perfilOculto"> 

       <table class="table table-bordered table-striped dt-responsive tablaSeguimiento" width="100%">
         
        <thead>

          <tr>
           
           <th>Modelo</th>
           <th>Nombre</th>
           <th>Color</th>
           <th>Talla</th>
           <th>Estado</th>
           <th>Proyección</th>
           <th>% Avance</th>
           <th>Stock</th>
           <th>Pedidos</th>
           <th>En Taller</th>
           <th>En Servicio</th>
           <th>Alm. Corte</th>
           <th>Ord. Corte</th>
           <th>Ult 30d</th>           
           <th>Duración Mes</th>
           <th>Und. Faltantes</th>
           <th>MP Faltante</th>
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


<script>
window.document.title = "Seguimiento"
</script>