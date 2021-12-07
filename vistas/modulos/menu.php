<aside class="main-sidebar">

    <section class="sidebar">

        <ul class="sidebar-menu">

            <?php
            $item="idusuario";
            $valor=$_SESSION["id"];
            $permisos=ControladorUsuarios::ctrMostrarUsuariosPermisos($item,$valor);
            $valores= array();
            foreach ($permisos as $key => $value) {
                array_push($valores,$value["idpermiso"]);
            }
            in_array(1,$valores)?$_SESSION['escritorio']=1:$_SESSION['escritorio']=0;
            in_array(2,$valores)?$_SESSION['analisis']=1:$_SESSION['analisis']=0;
            in_array(3,$valores)?$_SESSION['usuarios']=1:$_SESSION['usuarios']=0;
            in_array(4,$valores)?$_SESSION['backend']=1:$_SESSION['backend']=0;
            in_array(5,$valores)?$_SESSION['movimientos']=1:$_SESSION['movimientos']=0;
            in_array(6,$valores)?$_SESSION['maestros']=1:$_SESSION['maestros']=0;
            in_array(7,$valores)?$_SESSION['produccion']=1:$_SESSION['produccion']=0;
            in_array(8,$valores)?$_SESSION['tarjetas']=1:$_SESSION['tarjetas']=0;
            in_array(9,$valores)?$_SESSION['operaciones']=1:$_SESSION['operaciones']=0;
            in_array(10,$valores)?$_SESSION['materiaprima']=1:$_SESSION['materiaprima']=0;
            in_array(11,$valores)?$_SESSION['ventas']=1:$_SESSION['ventas']=0;
            in_array(12,$valores)?$_SESSION['facturacion']=1:$_SESSION['facturacion']=0;
            in_array(13,$valores)?$_SESSION['ticket']=1:$_SESSION['ticket']=0;
            in_array(14,$valores)?$_SESSION['cuenta']=1:$_SESSION['cuenta']=0;

            ?>

        <!-- search form -->
        <div class="input-group sidebar-form">
        <input type="text" name="q" class="form-control search-menu-box" placeholder="Buscar...">
        </div>

            <!-- Escritorio -->
            <?php
            if($_SESSION["escritorio"] == 1){
            ?>

            <li class="<?php if($_GET["ruta"] == "inicio") echo 'active';?>">

                <a href="inicio">

                    <i class="fa fa-home"></i>
                    <span>Inicio</span>

                </a>

            </li>

            <?php
            }
            ?>

            <!--  Analisis-->
            <?php
            if($_SESSION["analisis"] == 1){
            ?>

            <li class="<?php if($_GET["ruta"] == "inicio-gerencia") echo 'active';?>">

                <a href="inicio-gerencia">

                    <i class="fa fa-globe"></i>
                    <span>Analisis</span>

                </a>

            </li>

            <?php
            }
            ?>


            <!--  Usuarios-->
            <?php
            if($_SESSION["usuarios"] == 1){
            ?>

            <li class="<?php if($_GET["ruta"] == "usuarios") echo 'active';?>">

                <a href="usuarios">

                    <i class="fa fa-user"></i>
                    <span>Usuarios</span>

                </a>

            </li>

            <?php
            }
            ?>

            <!--  Backend-->
            <?php
            if($_SESSION["backend"] == 1){
            ?>

            <li class="treeview <?php if($_GET["ruta"] == "movimientos" || $_GET["ruta"] == "backupDB" || $_GET["ruta"] == "bkplista" || $_GET["ruta"] == "cargas-automaticas" || $_GET["ruta"] == "conexionjf") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-code "></i>

                    <span>Backend</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="<?php if($_GET["ruta"] == "movimientos") echo 'active';?>">

                        <a href="movimientos">

                            <i class="fa fa-circle-o"></i>
                            <span>Movimientos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "backupDB") echo 'active';?>">

                        <a href="backupDB">

                            <i class="fa fa-circle-o"></i>
                            <span>Backup</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "bkplista") echo 'active';?>">

                        <a href="bkplista">

                            <i class="fa fa-circle-o"></i>
                            <span>Backup - Listos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "cargas-automaticas") echo 'active';?>">

                        <a href="cargas-automaticas">

                            <i class="fa fa-circle-o"></i>
                            <span>Cargas automaticas</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "conexionjf") echo 'active';?>">

                        <a href="conexionjf">

                            <i class="fa fa-circle-o"></i>
                            <span>Conexiones</span>

                        </a>

                    </li>

                </ul>

            </li>

            <?php
            }
            ?>

            <!--  Movimientos-->
            <?php
            if($_SESSION["movimientos"] == 1){
            ?>

            <li class="treeview <?php if($_GET["ruta"] == "m-produccion" || $_GET["ruta"] == "m-ventas" || $_GET["ruta"] == "mp-ingresos" || $_GET["ruta"] == "mp-salidas" ) echo 'active';?>">

                <a href="#">

                    <i class="fa fa-line-chart"></i>

                    <span>Movimientos</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="<?php if($_GET["ruta"] == "m-produccion") echo 'active';?>">

                        <a href="m-produccion">

                            <i class="fa fa-circle-o"></i>
                            <span>Produccion</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "m-ventas") echo 'active';?>">

                        <a href="m-ventas">

                            <i class="fa fa-circle-o"></i>
                            <span>Ventas</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "mp-ingresos") echo 'active';?>">

                        <a href="mp-ingresos">

                            <i class="fa fa-circle-o"></i>
                            <span>Ingresos MP</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "mp-salidas") echo 'active';?>">

                        <a href="mp-salidas">

                            <i class="fa fa-circle-o"></i>
                            <span>Salidas MP</span>

                        </a>

                    </li>

                </ul>

            </li>

            <?php
            }
            ?>

            <?php
            if($_SESSION["maestros"] == 1){
            ?>

            <li class="treeview <?php if($_GET["ruta"] == "articulos" || $_GET["ruta"] == "agencias" || $_GET["ruta"] == "bancos" || $_GET["ruta"] == "colores" || $_GET["ruta"] == "condicionesventa" || $_GET["ruta"] == "tipodocumentos" || $_GET["ruta"] == "marcas" ||  $_GET["ruta"] == "modelosjf" || $_GET["ruta"] == "operaciones" || $_GET["ruta"] == "paras" || $_GET["ruta"] == "sectores" || $_GET["ruta"] == "marcas" || $_GET["ruta"] == "tipomovimientos" || $_GET["ruta"] == "tipopagos" || $_GET["ruta"] == "tipotrabajador" || $_GET["ruta"] == "trabajador" || $_GET["ruta"] == "trabajador2" || $_GET["ruta"] == "unidadesmedida" || $_GET["ruta"] == "crear-articulo" || $_GET["ruta"] == "vendedor" ) echo 'active';?>">

                <a href="#">

                    <i class="fa fa-database text-red"></i>

                    <span>Maestros</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="<?php if($_GET["ruta"] == "articulos") echo 'active';?>">

                        <a href="articulos">

                            <i class="fa fa-circle-o"></i>
                            <span>Artículos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "agencias") echo 'active';?>">
                        <a href="agencias">

                            <i class="fa fa-circle-o"></i>
                            <span>Agencias</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "bancos") echo 'active';?>">
                        <a href="bancos">

                            <i class="fa fa-circle-o"></i>
                            <span>Bancos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "colores") echo 'active';?>">

                        <a href="colores">

                            <i class="fa fa-circle-o"></i>
                            <span>Colores</span>

                        </a>

                    </li>

                    
                    <li class="<?php if($_GET["ruta"] == "condicionesventa") echo 'active';?>">
                        <a href="condicionesventa">

                            <i class="fa fa-circle-o"></i>
                            <span>Condiciones Venta</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "tipodocumentos") echo 'active';?>">
                        <a href="tipodocumentos">

                            <i class="fa fa-circle-o"></i>
                            <span>Documentos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "marcas") echo 'active';?>">

                        <a href="marcas">

                            <i class="fa fa-circle-o"></i>
                            <span>Marcas</span>

                        </a>

                    </li>

                    

                    <li class="<?php if($_GET["ruta"] == "modelosjf") echo 'active';?>">

                        <a href="modelosjf">

                            <i class="fa fa-circle-o"></i>
                            <span>Modelos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "operaciones") echo 'active';?>">

                        <a href="operaciones">

                            <i class="fa fa-circle-o"></i>
                            <span>Operaciones</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "paras") echo 'active';?>">
                        <a href="paras">

                            <i class="fa fa-circle-o"></i>
                            <span>Paras</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "sectores") echo 'active';?>">
                        <a href="sectores">

                            <i class="fa fa-circle-o"></i>
                            <span>Sector</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "tipomovimientos") echo 'active';?>">
                        <a href="tipomovimientos">

                            <i class="fa fa-circle-o"></i>
                            <span>Tipo Movimientos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "tipopagos") echo 'active';?>">
                        <a href="tipopagos">

                            <i class="fa fa-circle-o"></i>
                            <span>Tipo Pagos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "tipotrabajador") echo 'active';?>">
                        <a href="tipotrabajador">

                            <i class="fa fa-circle-o"></i>
                            <span>Tipo Trabajador</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "trabajador") echo 'active';?>">
                        <a href="trabajador">

                            <i class="fa fa-circle-o"></i>
                            <span>Trabajador</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "trabajador2") echo 'active';?>">
                        <a href="trabajador2">

                            <i class="fa fa-circle-o"></i>
                            <span>Trabajador 2</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "unidadesmedida") echo 'active';?>">
                        <a href="unidadesmedida">

                            <i class="fa fa-circle-o"></i>
                            <span>Unidades Medida</span>

                        </a>

                    </li>

                    

                    <li class="<?php if($_GET["ruta"] == "vendedor") echo 'active';?>">
                        <a href="vendedor">

                            <i class="fa fa-circle-o"></i>
                            <span>Vendedor</span>

                        </a>

                    </li>
                </ul>

            </li>

            <?php
            }
            ?>

            <!-- Produccion -->
            <?php
            if($_SESSION["produccion"] == 1){
            ?>

            <li class="treeview <?php if($_GET["ruta"] == "ordencorte" || $_GET["ruta"] == "crear-ordencorte" || $_GET["ruta"] == "almacencorte" || $_GET["ruta"] == "crear-almacencorte" || $_GET["ruta"] == "en-cortes" || $_GET["ruta"] == "en-taller" || $_GET["ruta"] == "marcar-taller" || $_GET["ruta"] == "en-tallert" || $_GET["ruta"] == "en-tallerp" || $_GET["ruta"] == "ingresos" || $_GET["ruta"] == "asistencia" || $_GET["ruta"] == "quincena" || $_GET["ruta"] == "produccion-trusas" || $_GET["ruta"] == "produccion-brasier" || $_GET["ruta"] == "produccion-vasco" || $_GET["ruta"] == "urgencias" || $_GET["ruta"] == "urgenciasamp" || $_GET["ruta"] == "proyeccion-mp" || $_GET["ruta"] == "servicios" || $_GET["ruta"] == "crear-servicio" || $_GET["ruta"] == "cierres" || $_GET["ruta"] == "crear-cierre" || $_GET["ruta"] == "precio-servicio" || $_GET["ruta"] == "pago-servicio" || $_GET["ruta"] == "salidas-varios" || $_GET["ruta"] == "operacion-taller" || $_GET["ruta"] == "listar-documento") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-cogs"></i> <span>Producción</span>
                    <span class="pull-right-container">
                    <i class="fa fa-angle-left pull-right"></i>
                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="treeview <?php if($_GET["ruta"] == "ordencorte" || $_GET["ruta"] == "crear-ordencorte") echo 'active';?>">

                        <a href="#"><i class="fa fa-scissors"></i> Ordenes de Corte

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "ordencorte") echo 'active';?>">

                                <a href="ordencorte">
                                <i class="fa fa-circle-o"></i> Ord. de Corte
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "crear-ordencorte") echo 'active';?>">

                                <a href="crear-ordencorte">
                                <i class="fa fa-circle-o"></i> Crear Ord. de Corte
                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "almacencorte" || $_GET["ruta"] == "crear-almacencorte") echo 'active';?>">

                        <a href="#"><i class="fa fa-scissors"></i> Corte

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "almacencorte") echo 'active';?>">

                                <a href="almacencorte">
                                <i class="fa fa-circle-o"></i> Corte
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "crear-almacencorte") echo 'active';?>">

                                <a href="crear-almacencorte">
                                <i class="fa fa-circle-o"></i> Crear Corte
                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "en-cortes") echo 'active';?>">

                        <a href="en-cortes">
                        <i class="fa fa-scissors"></i>
                        <span>Almacén de corte</span>
                        </a>

                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "en-taller" || $_GET["ruta"] == "marcar-taller" || $_GET["ruta"] == "en-tallert" || $_GET["ruta"] == "en-tallerp") echo 'active';?>">

                        <a href="#"><i class="fa fa-scissors"></i> En Talleres
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "en-taller") echo 'active';?>">

                                <a href="en-taller">
                                <i class="fa fa-circle-o"></i>Taller General
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "marcar-taller") echo 'active';?>">

                                <a href="marcar-taller">
                                <i class="fa fa-circle-o"></i>Registar Tareas
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "en-tallert") echo 'active';?>">

                                <a href="en-tallert">
                                <i class="fa fa-circle-o"></i>Taller Terminados
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "en-tallerp") echo 'active';?>">

                                <a href="en-tallerp">
                                <i class="fa fa-circle-o"></i>Taller Generados
                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "ingresos") echo 'active';?>">

                        <a href="ingresos">
                        <i class="fa fa-scissors"></i>
                        <span>Ingresos</span>
                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "asistencia") echo 'active';?>">

                        <a href="asistencia">
                        <i class="fa fa-calendar"></i>Asistencias
                        </a>

                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "quincena" || $_GET["ruta"] == "produccion-trusas" || $_GET["ruta"] == "produccion-brasier" || $_GET["ruta"] == "produccion-vasco") echo 'active';?>">

                        <a href="#"><i class="fa fa-scissors"></i> Producción
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "quincena") echo 'active';?>">

                                <a href="quincena">
                                <i class="fa fa-circle-o"></i>Quincenas
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "produccion-trusas") echo 'active';?>">

                                <a href="produccion-trusas">
                                <i class="fa fa-circle-o"></i> Producción Trusas
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "produccion-brasier") echo 'active';?>">

                                <a href="produccion-brasier">
                                <i class="fa fa-circle-o"></i> Producción Brasier
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "produccion-vasco") echo 'active';?>">

                                <a href="produccion-vasco">
                                <i class="fa fa-circle-o"></i> Producción Vasco
                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "urgencias" || $_GET["ruta"] == "urgenciasamp" || $_GET["ruta"] == "proyeccion-mp" ) echo 'active';?>">

                        <a href="#"><i class="fa fa-file-o"></i> Reportes
                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>
                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "urgencias") echo 'active';?>">

                                <a href="urgencias">
                                <i class="fa fa-circle-o"></i> Urgencias APT
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "urgenciasamp") echo 'active';?>">

                                <a href="urgenciasamp">
                                <i class="fa fa-circle-o"></i> Urgencias AMP
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "proyeccion-mp") echo 'active';?>">

                                <a href="proyeccion-mp">
                                <i class="fa fa-circle-o"></i> Proyección AMP
                                </a>

                            </li>

                        </ul>

                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "servicios" || $_GET["ruta"] == "crear-servicio") echo 'active';?>">

                        <a href="#"><i class="fa fa-list-ul"></i> Servicios

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "servicios") echo 'active';?>">

                                <a href="servicios">
                                <i class="fa fa-circle-o"></i> Servicios
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "crear-servicio") echo 'active';?>">

                                <a href="crear-servicio">
                                <i class="fa fa-circle-o"></i> Crear servicio
                                </a>

                            </li>

                        </ul>

                    </li>
                    <li class="treeview <?php if($_GET["ruta"] == "cierres" || $_GET["ruta"] == "crear-cierre") echo 'active';?>">

                        <a href="#"><i class="fa fa-list-ul"></i> Cierres

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">
                        
                            <li class="<?php if($_GET["ruta"] == "cierres") echo 'active';?>">

                                <a href="cierres">
                                <i class="fa fa-circle-o"></i> Cierres
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "crear-cierre") echo 'active';?>">

                                <a href="crear-cierre">
                                <i class="fa fa-circle-o"></i> Crear cierre
                                </a>

                            </li>
                        </ul>
                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "precio-servicio" || $_GET["ruta"] == "pago-servicio") echo 'active';?>">

                        <a href="#"><i class="fa fa-list-ul"></i> Pagos

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "precio-servicio") echo 'active';?>">

                                <a href="precio-servicio">
                                <i class="fa fa-circle-o"></i> Precio servicio
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "pago-servicio") echo 'active';?>">

                                <a href="pago-servicio">
                                <i class="fa fa-circle-o"></i> Pago servicio
                                </a>

                            </li>
                        </ul>
                    </li>

                    <li class="treeview <?php if($_GET["ruta"] == "salidas-varios" || $_GET["ruta"] == "listar-documento") echo 'active';?>">

                        <a href="#"><i class="fa fa-bolt"></i> Procedimientos

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>
                        <ul class="treeview-menu">
                            

                            <li class="<?php if($_GET["ruta"] == "salidas-varios") echo 'active';?>">

                                <a href="salidas-varios">
                                <i class="fa fa-circle-o"></i> Salidas Varios
                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "listar-documento") echo 'active';?>">

                                <a href="listar-documento">
                                <i class="fa fa-circle-o"></i> Listar Documentos
                                </a>

                            </li>
                        </ul>

                    </li>


                </ul>

            </li>

            <?php
            }
            ?>

            <!-- Tarjetas-->
            <?php
            if($_SESSION["tarjetas"] == 1){
            ?>

            <li class="treeview <?php if($_GET["ruta"] == "tarjetas" || $_GET["ruta"] == "ficha-tecnica" || $_GET["ruta"] == "crear-tarjeta") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-id-card-o"></i>

                    <span>Tarjetas</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="<?php if($_GET["ruta"] == "tarjetas") echo 'active';?>">

                        <a href="tarjetas">

                            <i class="fa fa-circle-o"></i>
                            <span>Administrar Tarjetas</span>

                        </a>

                    </li>
                    <li class="<?php if($_GET["ruta"] == "ficha-tecnica") echo 'active';?>">

                        <a href="ficha-tecnica">

                            <i class="fa fa-circle-o"></i>
                            <span>Fichas tecnicas</span>

                        </a>

                    </li>
                    <li class="<?php if($_GET["ruta"] == "crear-tarjeta") echo 'active';?>">

                        <a href="crear-tarjeta">

                            <i class="fa fa-circle-o"></i>
                            <span>Crear Tarjeta</span>

                        </a>

                    </li>

                </ul>

            </li>


            <?php
            }
            ?>

            <!-- Operaciones -->
            <?php
            if($_SESSION["operaciones"] == 1){
            ?>

            <li class="<?php if($_GET["ruta"] == "detalleoperaciones" || $_GET["ruta"] == "creardetalleoperaciones" || $_GET["ruta"] == "editardetalleoperaciones"  ) echo 'active';?>">

                <a href="detalleoperaciones">
                <i class="fa fa-bolt text-yellow"></i>
                <span>Operaciones Modelos</span>
                </a>

            </li>

            <?php
            }
            ?>

            <!-- Clientes-->
            <?php
            if($_SESSION["materiaprima"] == 1){
            ?>
            <li class="<?php if($_GET["ruta"] == "materiaprima") echo 'active';?>">

                <a href="materiaprima">

                    <i class="fa fa-cut text-orange"></i>
                    <span> Materia Prima</span>

                </a>

            </li>

            

            <?php
            }
            ?>

            <!--  Facturacion-->
            <?php
            if($_SESSION["facturacion"] == 1){
            ?>
            <li class="treeview <?php if($_GET["ruta"] == "pedidoscv" ||
                                        $_GET["ruta"] == "clientes" ||
                                        $_GET["ruta"] == "guias-remision" ||
                                        $_GET["ruta"] == "facturas" ||
                                        $_GET["ruta"] == "boletas" ||
                                        $_GET["ruta"] == "notas-credito" ||
                                        $_GET["ruta"] == "ver-nota-credito" ||
                                        $_GET["ruta"] == "editar-nota-credito" ||
                                        $_GET["ruta"] == "procesar-ce" ||
                                        $_GET["ruta"] == "proformas") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-cart-plus text-green"></i>

                    <span>Facturación</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">
                    <li class="<?php if($_GET["ruta"] == "clientes") echo 'active';?>">

                        <a href="clientes">

                            <i class="fa fa-users"></i>
                            <span>Clientes</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "pedidoscv" ||
                                        $_GET["ruta"] == "pedidos-generados" ||
                                        $_GET["ruta"] == "pedidos-aprobados" ||
                                        $_GET["ruta"] == "crear-pedidoscv"    ) echo 'active';?>">

                        <a href="pedidoscv">

                            <i class="fa fa-paper-plane"></i>
                            <span>Pedidos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "reportes-ventas") echo 'active';?>">

                        <a href="reportes-ventas">

                            <i class="fa fa-file-text"></i>
                            <span>Reportes Ventas</span>

                        </a>

                    </li>                    


                    <li class="<?php if($_GET["ruta"] == "procesar-ce") echo 'active';?>">

                        <a href="procesar-ce">

                            <i class="fa fa-plane"></i>
                            <span>Procesar CE</span>

                        </a>

                    </li>



                    <li class="treeview <?php   if($_GET["ruta"] == "guias-remision"    ||
                                                    $_GET["ruta"] == "facturas"          || 
                                                    $_GET["ruta"] == "boletas"           || 
                                                    $_GET["ruta"] == "notas-credito" ||
                                                    $_GET["ruta"] == "ver-nota-credito" ||
                                                    $_GET["ruta"] == "editar-nota-credito" ||
                                                    $_GET["ruta"] == "proformas") echo 'active';?>">

                        <a href="#"><i class="fa fa-clipboard"></i> Documentos

                            <span class="pull-right-container">
                            <i class="fa fa-angle-left pull-right"></i>
                            </span>

                        </a>

                        <ul class="treeview-menu">
                            <li class="<?php if($_GET["ruta"] == "boletas") echo 'active';?>">

                                <a href="boletas">

                                    <i class="fa fa-circle-o text-yellow"></i>
                                    <span>Boletas</span>

                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "facturas") echo 'active';?>">

                                <a href="facturas">

                                    <i class="fa fa-circle-o text-green"></i>
                                    <span>Facturas</span>

                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "guias-remision") echo 'active';?>">

                                <a href="guias-remision">

                                    <i class="fa fa-circle-o text-blue"></i>
                                    <span>Guias Remisión</span>

                                </a>

                            </li>

                            

                            <li class="<?php if($_GET["ruta"] == "proformas") echo 'active';?>">

                                <a href="proformas">

                                    <i class="fa fa-circle-o text-orange"></i>
                                    <span>Proformas</span>

                                </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "notas-credito" ||
                                                $_GET["ruta"] == "ver-nota-credito" ||
                                                $_GET["ruta"] == "editar-nota-credito") echo 'active';?>">

                                <a href="ver-nota-credito">

                                    <i class="fa fa-circle-o text-green"></i>
                                    <span>Notas credito</span>

                                </a>

                            </li>

                        </ul>

                    </li>

                    
                </ul>

            </li>
            
            <?php
            }
            if($_SESSION["cuenta"] == 1){
            ?>
            <li class="treeview <?php if($_GET["ruta"] == "cuentas" || $_GET["ruta"] == "cuentas-pendientes" || $_GET["ruta"] == "cuentas-canceladas" || $_GET["ruta"] == "abonos" || $_GET["ruta"] == "cancelar-abonos" || $_GET["ruta"] == "consultar-cuentas" || $_GET["ruta"] == "ver-envio-letras" || $_GET["ruta"] == "envio-letras" || $_GET["ruta"] == "reportes-generales") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-money text-green"></i>

                    <span>Cuentas corrientes</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">
                <li class="treeview <?php if($_GET["ruta"] == "cuentas" || $_GET["ruta"] == "cuentas-pendientes" || $_GET["ruta"] == "cuentas-canceladas" || $_GET["ruta"] == "abonos" || $_GET["ruta"] == "cancelar-abonos" || $_GET["ruta"] == "consultar-cuentas" || $_GET["ruta"] == "ver-envio-letras" || $_GET["ruta"] == "reportes-generales") echo 'active';?>">

                    <a href="#"><i class="fa fa-clipboard"></i> Cuentas

                        <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                        </span>

                    </a>

                        <ul class="treeview-menu">

                            <li class="<?php if($_GET["ruta"] == "cuentas") echo 'active';?>">

                            <a href="cuentas">

                                <i class="fa fa-circle-o text-blue"></i>
                                <span>Generales</span>

                            </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "cuentas-pendientes") echo 'active';?>">

                            <a href="cuentas-pendientes">

                                <i class="fa fa-circle-o text-red"></i>
                                <span>Pendientes</span>

                            </a>

                            </li>

                            <li class="<?php if($_GET["ruta"] == "cuentas-canceladas") echo 'active';?>">

                            <a href="cuentas-canceladas">

                                <i class="fa fa-circle-o text-green"></i>
                                <span>Canceladas</span>

                            </a>

                            </li>


                        </ul>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "abonos") echo 'active';?>">

                        <a href="abonos">

                            <i class="fa fa-circle-o"></i>
                            <span>Abonos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "cancelar-abonos") echo 'active';?>">
                        <a href="cancelar-abonos">

                            <i class="fa fa-circle-o"></i>
                            <span>Cancelar abonos</span>

                        </a>
                    </li>

                    <li class="<?php if($_GET["ruta"] == "consultar-cuentas") echo 'active';?>">
                        <a href="consultar-cuentas">

                            <i class="fa fa-circle-o"></i>
                            <span>Consultar cuentas</span>

                        </a>
                    </li>

                    <li class="<?php if($_GET["ruta"] == "ver-envio-letras") echo 'active';?>">
                        <a href="ver-envio-letras">

                            <i class="fa fa-circle-o"></i>
                            <span>Envio letras</span>

                        </a>
                    </li>

                    <li class="<?php if($_GET["ruta"] == "reportes-generales") echo 'active';?>">
                        <a href="reportes-generales">

                            <i class="fa fa-circle-o"></i>
                            <span>Reportes Generales</span>

                        </a>
                    </li>
                </ul>
            </li>
            <!--  Ticket-->
            <?php
            }
            if($_SESSION["ticket"] == 1){
            ?>
            <li class="treeview <?php if($_GET["ruta"] == "contactos" || $_GET["ruta"] == "mailbox") echo 'active';?>">

                <a href="#">

                    <i class="fa fa-inbox text-blue"></i>

                    <span>Ticket</span>

                    <span class="pull-right-container">

                        <i class="fa fa-angle-left pull-right"></i>

                    </span>

                </a>

                <ul class="treeview-menu">

                    <li class="<?php if($_GET["ruta"] == "contactos") echo 'active';?>">

                        <a href="contactos">

                            <i class="fa fa-users"></i>
                            <span>Contactos</span>

                        </a>

                    </li>

                    <li class="<?php if($_GET["ruta"] == "mailbox") echo 'active';?>">

                        <a href="mailbox">

                            <i class="fa fa-envelope-o"></i>
                            <span>Mailbox</span>

                        </a>

                    </li>

                </ul>

            </li>

            <?php
            }
            ?>

        </ul>

    </section>

</aside>

<script>
$(".search-menu-box").on('input', function() {
    var filter = $(this).val();
    $(".sidebar-menu > li").each(function(){
        if ($(this).text().search(new RegExp(filter, "i")) < 0) {
            $(this).hide();
        } else {
            $(this).show();
        }
    });
});
</script>