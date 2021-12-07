<div class="content-wrapper">

  <section class="content-header">
    
    <h1>
      
      Ventas por vendedor - Documentos
    
    </h1>

    <ol class="breadcrumb">
      
      <li><a href="inicio"><i class="fa fa-dashboard"></i> Inicio</a></li>
      
      <li class="active">Ventas por vendedor - Documentos</li>
    
    </ol>

  </section>

    <section class="content col-lg-2">
        <div class="box">
            <div class="box-body">
                <form method="post">
                    <div class="form-check">
                    <label class="form-check-label" for="radio1">
                        <input type="radio" class="form-check-input radioTipoV" id="radio1" name="radioTipoV" value="resumen" checked> Resumen
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio2">
                        <input type="radio" class="form-check-input radioTipoV" id="radio2" name="radioTipoV" value="detallado"> Detallado
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio3">
                        <input type="radio" class="form-check-input radioTipoV" id="radio3" name="radioTipoV" value="postalResumen"> Cod.Postal - Rsm
                    </label>
                    </div>
                    <div class="form-check">
                    <label class="form-check-label" for="radio4">
                        <input type="radio" class="form-check-input radioTipoV" id="radio4" name="radioTipoV" value="postalDetalle"> Cod.Postal - Det
                    </label>
                    </div>
                    
                </form>
            </div>
        
        </div>

        <div class="box">
            <div class="box-body">
                <div class="form-check">
                <label  for="radioOrd1">
                    <input type="radio" class="form-check-input radioDocumento " id="radioOrd1" name="radioDocumento" value="S03" > Facturas
                </label>
                </div>

                <div class="form-check">
                <label  for="radioOrd2">
                    <input type="radio" class="form-check-input radioDocumento" id="radioOrd2" name="radioDocumento" value="E05"> Notas de crédito
                </label>
                </div>

                <div class="form-check">
                <label  for="radioOrd3">
                    <input type="radio" class="form-check-input radioDocumento" id="radioOrd3" name="radioDocumento"  value="S70"> Guias (*)
                </label>
                </div>

                <div class="form-check">
                <label  for="radioOrd4">
                    <input type="radio" class="form-check-input radioDocumento" id="radioOrd4" name="radioDocumento" value="S02"> Boletas de ventas
                </label>
                </div>


                <div class="form-check">
                <label  for="radioOrd5">
                    <input type="radio" class="form-check-input radioDocumento" id="radioOrd5" name="radioDocumento" value="todos" checked> Todo lo Anterior 
                </label>
                </div>
            </div>
        
        </div>

    </section>

    <section class="content col-lg-2">
        <div class="box">
            <div class="box-body">
                <div class="form-check">
                <label class="form-check-label" for="radioImpuesto1">
                    <input type="checkbox" class="form-check-input radioImpuesto" id="radioImpuesto1" name="radioImpuesto" value="1" > Impuestos por otros
                </label>
                </div>
            </div>
        
        </div>
   
        <label for="">Vendedores</label>
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <select class="form-control input-lg selectpicker" id="tipoVendedorReporteVenta" name="tipoVendedorReporteVenta" data-live-search="true" data-size="10">
                        <option value="">Seleccionar vendedor</option>
                        <?php
                            $item=null;
                            $valor = null;

                            $vendedor = ControladorVendedores::ctrMostrarVendedores($item,$valor);

                            foreach ($vendedor as $key => $value) {
                            echo '<option value="' . $value["codigo"] . '">' . $value["codigo"] ." - ". $value["descripcion"] . '</option>';
                            }

                        ?>  
                    </select>
                </div>
            </div>       
        </div>

        <label for="">Fechas</label>
        <div class="box">
            <div class="box-body">
                <div class="form-check">
                <label class="form-check-label" for="">
                Inicio:  <input type="date" class="form-check-input" id="fechaVentaInicio" name="fechaVentaInicio" >
                </label>
                </div>
                <div class="form-check">
                <label class="form-check-label" for="radioOr2">
                Fin:  &nbsp&nbsp&nbsp&nbsp&nbsp<input type="date" class="form-check-input" id="fechaVentaFin" name="fechaVentaFin" >
                </label>
                </div>
            </div>
        
        </div>

        <div class="box">
            <div class="box-body">
                <div class="form-check">
                    <label class="form-check-label" for="radioImpresion1">
                        <input type="radio" class="form-check-input radioImpresionV" id="radioImpresion1" name="radioImpresionV" value="pantalla" checked> Por pantalla
                    </label>
                </div>


                <div class="form-check">
                    <label class="form-check-label" for="radioImpresion2">
                        <input type="radio" class="form-check-input radioImpresionV" id="radioImpresion2" name="radioImpresionV"   value="excel"> Por archivo excel
                    </label>
                </div>
            </div>
        
        </div>
        <div align="center">
            <button class="btn btn-success btnGenerarReporteVenta"  optipo="resumen" opdocumento="todos" impuesto="0" vend="todos"  inicio="todos" fin="todos" impresion="pantalla"><i class="fa fa-check"></i> Aceptar</button>    

        </div>
        

    </section>

    <section class="content col-lg-2">
        

    </section>

    <section class="content col-lg-6 text-center">
        <div class="box">
            <div class="box-body">
                <div class="form-group" style="border:3px solid darkred">
                <img src="vistas/img/plantilla/jackyform_paloma.png" width="600px" height="400px">
                </div>
            </div>
        </div>
    </section>

</div>


<script>
window.document.title = "Reportes ventas"
</script>