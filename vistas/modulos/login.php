<div id="back"></div>

<div class="login-box">

  <div class="login-logo">

    <img src="vistas/img/plantilla/logo-extend.png" class="img-responsive" style="padding:0px 0px 0px 0px">

  </div>

  <div class="login-box-body">

    <b><p class="login-box-msg">Ingresar al sistema</p></b>

    <form method="post">

      <div class="form-group has-feedback">

        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" autofocus required>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>

      </div>

      <div class="form-group has-feedback">

        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>

      </div>
      <!-- <div class="row">
        <div class="form-check" style="padding-left:16px">
            <input class="form-check-input" type="checkbox" value="1" name="mantener_sesion_iniciada" >
            <label class="form-check-label" for="flexCheckDefault">
              Mantener sesión activa
            </label>
        </div>
      </div> -->

      <div class="row">
        <div class="col-xs-4"></div>

        <div class="col-xs-4">

          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>

        </div>

      </div>

      <?php
      
      $login = new ControladorUsuarios();
      $login -> ctrIngresoUsuario();
      
      ?>
    
    </form>

  </div>

</div>
