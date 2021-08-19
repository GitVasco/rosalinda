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

                    <div class="box-body no-padding">
                        
                        <ul class="nav nav-pills nav-stacked">

                            <li class="active"><a href="mailbox"><i class="fa fa-inbox"></i> Inbox
                                
                            <?php
                                
                                $para = $_SESSION["id"];

                                $sinLeer = ModeloMensajes::mdlSinLeer("mailboxjf", $para);
                                #var_dump("sinLeer", $sinLeer);

                                    echo '<span class="label label-primary pull-right">'.$sinLeer["sinLeer"].'</span></a>';

                            ?>

                            </li>
                            
                        </ul>

                    </div>
                    
                </div>

            </div>

            <div class="col-md-9">

                <div class="box box-primary">

                    <div class="box-header with-border">

                        <h3 class="box-title">Bandeja de entrada</h3>
                        
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">

                        

                            <table class="table table-bordered table-striped dt-responsive tablas" width="100%">

                            <thead>

                                <tr>

                                    <th style="width: 10px">#</th>
                                    <th style="width: 100px">De</th>
                                    <th>Mensaje</th>
                                    <th style="width: 150px">Fecha</th>

                                </tr>

                            </thead>

                                <tbody>

                                <?php
                                
                                $valor = $_SESSION["id"];
                                $estado = null;

                                $bandeja = ControladorMensajes::ctrBandeja($valor, $estado);
                                #var_dump("bandeja", $bandeja);

                                foreach($bandeja as $key => $value){

                                    echo '<tr>

                                            <td class="mailbox-star">';

                                            if($value["estado"] == "0"){

                                                echo '<i class="fa fa-star text-yellow"></i></a>';

                                            }else{

                                                echo '<i class="fa fa-star text-white"></i></a>';

                                            }
   
                                    echo    '</td>
                                            <td class="mailbox-name">

                                            <button class="btn btn-link btnLeer" de='.$value["de"].' para='.$_SESSION["id"].'>'.$value["nombre"].'</button>
                                            
                                            </td>

                                            <td class="mailbox-subject">';

                                            if($value["estado"] == "0"){

                                                echo '<b>'.$value["mensaje"].'</b>';

                                            }else{

                                                echo ''.$value["mensaje"].'';

                                            }
                                            
                                    echo    '</td>
                                                                                    
                                            <td class="mailbox-date">'.$value["fecha"].'</td>

                                        </tr>';

                                }
                                
                                ?>

                                </tbody>
                                
                            </table>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

