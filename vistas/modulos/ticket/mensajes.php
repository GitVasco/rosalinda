
<div class="content-wrapper">

    <section class="content-header">

        <h1>

            Bandeja de entrada

        </h1>

        <ol class="breadcrumb">

            <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>

            <li class="active">Bandeja de entrada</li>

        </ol>

    </section>

    <section class="content">

        <div class="row">

            <div class="col-md-3">

                <div class="box box-solid">

                    <div class="box-header with-border">

                        <h3 class="box-title">Carpetas</h3>

                    </div>

                    <a href="mailbox" class="btn btn-primary btn-block margin-bottom">Ir a la Bandeja</a>

                    <div class="box-body no-padding">

                        <ul class="nav nav-pills nav-stacked">

                            <li class="active"><a href="mailbox"><i class="fa fa-inbox"></i> Inbox

                            <?php
                            
                            $para = $_SESSION["id"];

                            $sinLeer = ModeloMensajes::mdlSinLeer("mailboxjf", $para);
                            #var_dump("sinLeer", $sinLeer);

                                echo'<span class="label label-primary pull-right">'.$sinLeer["sinLeer"].'</span></a>';

                            ?>


                            </li>

                        </ul>

                    </div>

                </div>

            </div>

            <div class="col-md-9">

                <div class="box box-warning direct-chat direct-chat-warning">

                    <div class="box-header with-border">

                        <?php
                        
                        $usuario = ModeloUsuarios::mdlMostrarUsuarios("usuariosjf", "id", $_GET["idUsuario"]);
                        #var_dump("usaurio", $usuario);

                        echo '<h3 class="box-title">Mensajes con '.$usuario["nombre"].'</h3>';
                        
                        ?>

                        

                    </div>

                    <div class="box-body" id="cajaRefresh" name="cajaRefresh">
                        
                        <div class="direct-chat-messages" style="overflow: scroll; height: 400px;">

                        <?php

                        $tabla = "detalles_mailboxjf";
                        $de = $_SESSION["id"];
                        $para = $_GET["idUsuario"];


                        $chat   = ModeloMensajes::mdlMostraDetallesMensajes($tabla, $de, $para);
                        #var_dump("chat", $chat);

                        foreach($chat as $key => $value){


                            if($value["de"] == $para){


                                echo '<div class="direct-chat-msg">

                                        <div class="direct-chat-info clearfix">

                                            <span class="direct-chat-name pull-left">'.$value["nom_de"].'</span>
                                            <span class="direct-chat-timestamp pull-right">'.$value["fecha"].'</span>

                                        </div>
                                    
                                        <img class="direct-chat-img" src="'.$value["foto_de"].'" alt="message user image">
                                        
                                        <div class="direct-chat-text">
                                            '.$value["mensaje"].'
                                        </div>
                        
                                    </div>';


                            }else{

                                echo'<div class="direct-chat-msg right">

                                        <div class="direct-chat-info clearfix">

                                            <span class="direct-chat-name pull-right">'.$value["nom_de"].'</span>
                                            <span class="direct-chat-timestamp pull-left">'.$value["fecha"].'</span>

                                        </div>
                                    
                                        <img class="direct-chat-img" src="'.$value["foto_de"].'" alt="message user image">
                                        
                                        <div class="direct-chat-text">
                                            '.$value["mensaje"].'
                                        </div>
                        
                                    </div>';

                            }

                        }
                        
                        ?>
                                                                                    
                        </div>

                    </div>

                    <div class="box-footer"><!-- parte 1 -->

                        <form role="form" method="post"><!-- parte 2 -->

                        <?php

                        $de = $_SESSION["id"];
                        $para = $_GET["idUsuario"];

                        $mensaje = ControladorMensajes::ctrMostrarMensajes($de, $para);
                        #var_dump("mensaje", $mensaje["codigo"]);

                        $codigo =$mensaje["codigo"];
                        
                        if($mensaje["codigo"] != null){

                            echo '<input type="hidden" class="form-control" id="codigo" name="codigo" value="'.$codigo.'" readonly>';

                        }else{

                            $de1 = null;
                            $para1 = null;

                            $mensaje1 = ControladorMensajes::ctrMostrarMensajes($de1, $para1);

                            foreach ($mensaje1 as $key => $value) {                    
                    
                            }

                            $codigo = $value["codigo"] + 1;

                            echo '<input type="hidden" class="form-control" id="codigo" name="codigo" value="'.$codigo.'" readonly>';

                        }

                        ?>
                        <input type="hidden" name="para" value="<?php echo $para; ?>">

                            <div class="input-group">

                                <input type="text" name="mensaje" id="mensaje" placeholder="Escribir Mensaje ..." class="form-control" autofocus>

                                <span class="input-group-btn">

                                    <button type="submit" name="enviar" id="mensaje" class="btn btn-warning btn-flat">Enviar</button>

                                    
                                
                                </span>

                            </div>

                        </form>
                        <?php

                            $crearMensaje = new ControladorMensajes();
                            $crearMensaje -> ctrCrearMensaje();

                        ?>

                        <?php

                            echo '<button class="btn btn-success btn-flat btnRefresh" idUsuario='.$_GET["idUsuario"].' ><i class="fa fa-refresh"> Revisar</i></button>';

                        ?>

                    </div>
                    
                </div>
                
            </div>

        </div>

    </section>

</div>

<script>
    var height = 0;
    $('div div').each(function(i, value){
        height += parseInt($(this).height());
    });

    height += '';

    $('div').animate({scrollTop: height});
</script>

