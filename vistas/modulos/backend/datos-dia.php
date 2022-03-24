<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Datos Diarios

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Datos Diarios</li>

        </ol>

    </section>

    <section class="content">

        <div class="box">

            <div class="box-body">

                <input type="hidden" value="<?php echo $_SESSION['perfil']; ?>" id="perfilOculto">
                
                <table class="table table-bordered table-striped dt-responsive tablaDatosDia" width="100%" >

                    <thead >

                        <tr>
                            <th>Fecha</th>
                            <th>Año</th>
                            <th>Mes</th>
                            <th>Nombre del Mes</th>
                            <th>Dia</th>
                            <th>Total Ventas Unidades</th>
                            <th>Total Producción unidades</th>
                            <th>Total Ventas Soles</th>
                            <th>Total Pagos Soles</th>
                            <th>TC Compra</th>
                            <th>TC Venta</th>
                            <th>Acciones</th>

                        </tr>

                    </thead>

                </table>



            </div>

        </div>

    </section>

</div>
<script>
window.document.title = "Datos Diarios"
</script>
