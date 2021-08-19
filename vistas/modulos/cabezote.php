<header class="main-header">

    <!--=====================================
     LOGOTIPO
     ======================================-->
    <a href="inicio" class="logo">

        <!-- logo mini -->
        <span class="logo-mini">

            <img src="vistas/img/plantilla/vascorp.png" class="img-responsive" style="padding:10px">

        </span>

        <!-- logo normal -->

        <span class="logo-lg">

            <img src="vistas/img/plantilla/vasco.png" class="img-responsive" style="padding:10px 0px">

        </span>

    </a>

    <!--=====================================
     BARRA DE NAVEGACIÓN
     ======================================-->
    <nav class="navbar navbar-static-top" role="navigation">

        <!-- Botón de navegación -->

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

            <span class="sr-only">Toggle navigation</span>

        </a>

        <!-- perfil de usuario -->

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <li class="dropdown messages-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-envelope-o"></i>

                        <?php
                                
                        $para = $_SESSION["id"];

                        $sinLeer = ModeloMensajes::mdlSinLeer("mailboxjf", $para);
                        #var_dump("sinLeer", $sinLeer);

                            echo '<span class="label label-success">'.$sinLeer["sinLeer"].'</span>';

                        ?>
    
                    </a>

                    <ul class="dropdown-menu">

                        <?php
                                
                        $para = $_SESSION["id"];

                        $sinLeer = ModeloMensajes::mdlSinLeer("detalles_mailboxjf", $para);
                        #var_dump("sinLeer", $sinLeer);

                            echo '<li class="header">Tienes '.$sinLeer["sinLeer"].' mensajes</li>';

                        ?>

                        <li>

                            <ul class="menu">

                                <?php

                                $valor = $_SESSION["id"];
                                $estado= '0';

                                $bandeja = ControladorMensajes::ctrBandeja($valor, $estado);
                                #var_dump("bandeja", $bandeja);

                                foreach($bandeja as $key => $value){

                                    echo '<li>

                                            <a href="index.php?ruta=mensajes&idUsuario='.$value["de"].'">

                                                <div class="pull-left">';

                                                echo '<img src="'.$value["foto"].'" class="img-circle" alt="User Image">';

                                        echo    '</div>';

                                        echo    '<h4>

                                                    '.$value{"nombre"}.'
                                                    <small><i class="fa fa-clock-o"></i> '.$value["fecha"].'</small>

                                                </h4>';

                                        echo    '<p>'.$value["mensaje"].'</p>

                                            </a>

                                        </li>';


                                }
                                
                                ?>



                            </ul>

                        </li>

                        <li class="footer">

                            <a href="mailbox">Ver todos los mensajes</a>

                        </li>

                    </ul>

                </li>

                <li class="dropdown user user-menu">

                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                        <?php

                        if ($_SESSION["foto"] != "") {

                            echo '<img src="' . $_SESSION["foto"] . '" class="user-image">';
                        } else {


                            echo '<img src="vistas/img/usuarios/default/anonymous.png" class="user-image">';
                        }


                        ?>

                        <span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>

                    </a>

                    <!-- Dropdown-toggle -->

                    <ul class="dropdown-menu">

                        <li class="user-body">

                            <div class="pull-right">

                                <a href="salir" class="btn btn-default btn-flat">Salir</a>

                            </div>

                        </li>

                    </ul>

                </li>

            </ul>

        </div>

    </nav>

</header>