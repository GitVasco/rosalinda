<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Administrar envios de letras

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Administrar envios de letras</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">
            <div class="box-header width-border">
                <a class="btn btn-primary" href="envio-letras"><i class="fa fa-paper-plane-o"></i>  Enviar letras</a>
                <button type="button" class="btn btn-default pull-right" id="daterange-btnEnvioCta">
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
                <table class="table table-bordered table-striped dt-responsive tablaEnvioCuentas" width="100%">

                    <thead>

                        <tr>

                            <th>Codigo</th>
                            <th>Fecha</th>
                            <th>Usuario</th>
                            <th>Cantidad</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>

            </div>

        </div>

    </section>

</div>

<script>
window.document.title = "Envio de Letras"
</script>