<div class="content-wrapper">

  <section class="content-header">

    <h1>

    Articulos Enviados a Taller / Servicio

    </h1>

    <ol class="breadcrumb">

      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

      <li class="active">Articulos Enviados a Taller / Servicio</li>

    </ol>

  </section>

  <section class="content">

    <div class="box">
      <div class="box-header with-border">
        <div class="col-lg-2">
          <select name="selectModeloTaller" id="selectModeloTaller" class="form-control input-lg selectpicker" data-live-search="true" data-size="10">
          <option value="">--------Seleccionar modelo-------</option>
          <?php 
            $item=null;
            $valor=null;

            $modelo =ControladorModelos::ctrMostrarModelos($item,$valor);
            foreach ($modelo as $key => $value) {
              echo '<option value="'.$value["modelo"].'">'.$value["modelo"]." - ". $value["nombre"].'</option>';
            }
          ?>
          </select>
        </div>
        <div class="col-lg-2">
        <button class="btn btn-primary btnLimpiarModeloTaller"  name="btnLimpiarModeloTaller"><i class="fa fa-refresh"></i> Limpiar</button>
        </div>
          </div>  
      <div class="box-body">

        <input type="hidden" value="<?= $_SESSION["perfil"]; ?>" id="perfilOculto">

        <table class="table table-bordered table-striped dt-responsive tablaEnvTaller" width="100%">

        <thead>

            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center">S</th>
                <th style="text-align: center">M</th>
                <th style="text-align: center">L</th>
                <th style="text-align: center">XL</th>
                <th style="text-align: center">XXL</th>
                <th style="text-align: center">XS</th>
                <th style="text-align: center"></th>
                <th style="text-align: center"></th>
                <th></th>

            </tr>

            <tr>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th></th>
                <th style="text-align: center">28</th>
                <th style="text-align: center">30</th>
                <th style="text-align: center">32</th>
                <th style="text-align: center">34</th>
                <th style="text-align: center">36</th>
                <th style="text-align: center">38</th>
                <th style="text-align: center">40</th>
                <th style="text-align: center">42</th>
                <th></th>

            </tr>

            <tr>
                <th>Fecha</th>
                <th>Cod. Taller</th>
                <th>Taller</th>
                <th><center>Modelo</center></th>
                <th>Nombre</th>
                <th>Color</th>
                <th style="text-align: center">3</th>
                <th style="text-align: center">4</th>
                <th style="text-align: center">6</th>
                <th style="text-align: center">8</th>
                <th style="text-align: center">10</th>
                <th style="text-align: center">12</th>
                <th style="text-align: center">14</th>
                <th style="text-align: center">16</th>
                <th><center>Total</center></th>

            </tr>

        </thead>

        </table>

      </div>

    </div>

  </section>

</div>

<script>
window.document.title = "Enviados a taller"
</script>