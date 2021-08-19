<?php

class ControladorMensajes{

    /* 
    * MOSTRAR MENSAJES CABECERA
    */

    static public function ctrMostrarMensajes($de, $para){

		$tabla = "mailboxjf";

		$respuesta = ModeloMensajes::mdlMostrarMensajes($tabla, $de, $para);

		return $respuesta;

	}

    /* 
    * CREAR MENSAJE
    */
    static public function ctrCrearMensaje(){

        if(isset($_POST["mensaje"])){

			if(preg_match('/^[-a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ?¿¡!:*.,() ]+$/', $_POST["mensaje"])){

                $respuesta = ModeloMensajes::mdlMostrarMensajes("mailboxjf", $_SESSION["id"], $_POST["para"]);
                #var_dump("respuesta", $respuesta);

                if($respuesta == false){

                    $datos = array("codigo"=>$_POST["codigo"],
                                    "de"=>$_SESSION["id"],
                                    "para"=>$_POST["para"]);
                    #var_dump("datos", $datos);
                    $respuesta = ModeloMensajes::mdlGuardarMailbox("mailboxjf", $datos);

                    if($respuesta = "ok"){

                        /* 
                        todo: GUARDAMOS EL MENSAJE
                        */
                        $datos = array( "codigo"=>$_POST["codigo"],
                        "de"=>$_SESSION["id"],
                        "para"=>$_POST["para"],
                        "mensaje"=>$_POST["mensaje"]);
                        #var_dump("datos", $datos);
                        
                        ModeloMensajes::mdlLeer("detalles_mailboxjf", $_SESSION["id"], $_POST["para"]);

                        $respuesta = ModeloMensajes::mdlGuardarMensaje("detalles_mailboxjf", $datos);

                        if($respuesta == "ok"){

                            echo'<script>

                                    window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";


                                </script>';

                        }else{

                            echo'<script>

                                    window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";


                                </script>';

                        }


                    }else{

                        echo'<script>

                                 window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";

                            </script>';


                    }



                }else{

                    /* 
                    todo: GUARDAMOS EL MENSAJE
                    */
                    $datos = array( "codigo"=>$_POST["codigo"],
                                    "de"=>$_SESSION["id"],
                                    "para"=>$_POST["para"],
                                    "mensaje"=>$_POST["mensaje"]);
                    #var_dump("datos", $datos);

                    ModeloMensajes::mdlLeer("detalles_mailboxjf", $_POST["para"], $_SESSION["id"]);

                    $respuesta = ModeloMensajes::mdlGuardarMensaje("detalles_mailboxjf", $datos);

                    if($respuesta == "ok"){

                        echo'<script>

                                window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";

        
                            </script>';

                    }else{

                        echo'<script>

                                window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";

        
                            </script>';

                    }

                }


            }else{

                echo'<script>

                swal({
                      type: "error",
                      title: "¡El mensaje no puede ir con los campos vacíos o llevar caracteres especiales!",
                      showConfirmButton: true,
                      confirmButtonText: "Cerrar"
                      }).then(function(result){
                        if (result.value) {

                            window.location="index.php?ruta=mensajes&idUsuario='.$_POST["para"].'";

                        }
                    })

              </script>';

            }

        }

    }

    /* 
    * bandeja de entrada
    */
	static public function ctrBandeja($valor, $estado){

		$tabla = "mailboxjf";

		$respuesta = ModeloMensajes::mdlBandeja($tabla, $valor, $estado);

		return $respuesta;

	}    
    

}