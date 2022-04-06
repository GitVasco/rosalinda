<?php

class ControladorMovimientos{

    /* 
    * total unidades vendidas del mes actual y pasado
    */
    static public function ctrTotUndVen($valor){

        $respuesta = ModeloMovimientos::mdlTotUndVen($valor);

        return $respuesta;

    }

    /* 
    * total unidades producidas del mes actual y pasado
    */
    static public function ctrTotUndProd($valor){

        $respuesta = ModeloMovimientos::mdlTotUndProd($valor);

        return $respuesta;

    }

    /* 
    * sacar los meses codigo y nombre
    */
    static public function ctrMesesMov(){

        $respuesta = ModeloMovimientos::mldMesesMov();

        return $respuesta;

    }

    /* 
    * sacamos los totales de ventas por mes
    */
    static public function ctrTotalMesVent(){

        $respuesta = ModeloMovimientos::mdlTotalMesVent();

        return $respuesta;
    }

    /* 
    * sacamos los totales de produccion por mes
    */
    static public function ctrTotalMesProd(){

        $respuesta = ModeloMovimientos::mdlTotalMesProd();

        return $respuesta;
    } 
    
    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrMostrarTotales(){

        $respuesta = ModeloMovimientos::mldMostrarTotales();

        return $respuesta;

    }

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrTotalesSolesVenta(){

        $respuesta = ModeloMovimientos::mdlTotalesSolesVenta();

        return $respuesta;

    }

    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrTotalesSolesPagos(){

        $respuesta = ModeloMovimientos::mdlTotalesSolesPagos();

        return $respuesta;

    }

    /* 
    * total de dias con produccion del mes pasado
    */
    static public function ctrTotDiasProd($valor){

        $respuesta = ModeloMovimientos::mdlTotDiasProd($valor);

        return $respuesta;

    }

    /* 
    * top 10 de ventas modelos
    */
    static public function ctrMovMes($valor){

        $respuesta = ModeloMovimientos::mdlMovMes($valor);

        return $respuesta;

    }
    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrSumaUnd($valor){

        $respuesta = ModeloMovimientos::mdlSumaUnd($valor);

        return $respuesta;

    }
    
    /* 
    * MOSTRAR ULTIMO NUMERO DE TALONARIO
    */
    static public function ctrMostrarTalonario(){

        $respuesta = ModeloMovimientos::mdlMostrarTalonario();

        return $respuesta;

    }      

     /* 
    * MOSTRAR ULTIMO NUMERO DE TALONARIO SALIDA
    */
    static public function ctrMostrarTalonarioSalida(){

        $respuesta = ModeloMovimientos::mdlMostrarTalonarioSalida();

        return $respuesta;

    }  
    
    /* 
    * MOSTRAR LOS MOVIMIENTOS DE PRODUCCION POR MODELO
    */
    static public function ctrMovProdMod($modelo){

        $respuesta = ModeloMovimientos::mdlMovProdMod($modelo);

        return $respuesta;

    }
    
    /* 
    * MOSTRAR LOS MOVIMIENTOS DE VENTAS POR MODELO
    */
    static public function ctrMovVtaMod($modelo){

        $respuesta = ModeloMovimientos::mdlMovVtaMod($modelo);

        return $respuesta;

    }    
    

    /* 
    * MOSTRAR LOS MOVIMIENTOS DE VENTAS POR MODELO
    */
    static public function ctrLineaMP(){

        $respuesta = ModeloMovimientos::mdlLineaMP();

        return $respuesta;

    }
    
    /* 
    * MOSTRAR LOS INGRESOS POR MATERIA PRIMA
    */
    static public function ctrMovIngMp($inea){

        $respuesta = ModeloMovimientos::mdlMovIngMp($inea);

        return $respuesta;

    }       

    /* 
    * MOSTRAR LAS SALIDAS POR MATERIA PRIMA
    */
    static public function ctrMovSalMp($linea){

        $respuesta = ModeloMovimientos::mdlMovSalMp($linea);

        return $respuesta;

    }   
    
    /* 
    * MOSTRAR TOTALES DEL MES VTAS - PAGOS
    */
    static public function ctrTotalesSoles($mes){

        $respuesta = ModeloMovimientos::mdlTotalesSoles($mes);

        return $respuesta;

    }       
    
    /* 
    * MOSTRAR TOTALES DEL MES PEDIDOS
    */
    static public function ctrTotalesSolesPedidos($mes){

        $respuesta = ModeloMovimientos::mdlTotalesSolesPedidos($mes);

        return $respuesta;

    } 
    
    /* 
    * MOSTRAR TOTALES VENCIDOS
    */
    static public function ctrTotalVencidos(){

        $respuesta = ModeloMovimientos::mdlTotalVencidos();

        return $respuesta;

    } 
    
    /* 
    * MOSTRAR TOTALES EN FACTURAS
    */
    static public function ctrFacturas($mes){

        $respuesta = ModeloMovimientos::mdlFacturas($mes);
  
        return $respuesta;
  
    } 
    
    /* 
    * MOSTRAR TOTALES EN PROFORMAS
    */
    static public function ctrProformas($mes){

        $respuesta = ModeloMovimientos::mdlProformas($mes);

        return $respuesta;

    }      

    /* 
    * sacamos los totales vencidos por vendedor
    */
    static public function ctrTotalesVencidosVendedor($inicio, $lineas){

        $respuesta = ModeloMovimientos::mdlTotalesVencidosVendedor($inicio, $lineas);

        return $respuesta;

    }    
    
    /* 
    * sacamos los totales por mes de la  nueva tabla TOTALES
    */
    static public function ctrMostrarCtasVdor(){

        $respuesta = ModeloMovimientos::mldMostrarCtasVdor();

        return $respuesta;

    } 
    
    /* 
    * rangos por meses
    */
    static public function ctrMostrarRangosDias(){

        $respuesta = ModeloMovimientos::mldMostrarRangosDias();

        return $respuesta;

    } 
    
    /* 
    * MOSTRAR RANGOS
    */
    static public function ctrMostrarRangos($mes){

        $respuesta = ModeloMovimientos::mdlMostrarRangos($mes);

        return $respuesta;

    }    
    
    /* 
    * MOSTRAR RESUMEN DE VENTAS
    */
    static public function ctrMostrarResumenVtas($mes){

        $respuesta = ModeloMovimientos::mdlMostrarResumenVtas($mes);

        return $respuesta;

    }  
    
    /* 
    * MOSTRAR RESUMEN DE VENTAS POR VENDEDOR
    */
    static public function ctrMostrarResumenVdor($mes){

        $respuesta = ModeloMovimientos::mdlMostrarResumenVdor($mes);

        return $respuesta;

    }  
    
    /* 
    * sacamos los datos de mov del dia
    */
    static public function ctrMostrarDias(){

        $respuesta = ModeloMovimientos::mldMostrarDias();

        return $respuesta;

    }        

    /* 
    * MOSTRAR RESUMEN DE VENTAS
    */
    static public function ctrMostrarResumenVtasB($mes){

        $respuesta = ModeloMovimientos::mdlMostrarResumenVtasB($mes);

        return $respuesta;

    }    

    /* 
    * top 12 de ventas modelos fotos
    */
    static public function ctrMovMesFoto(){

        $respuesta = ModeloMovimientos::mdlMovMesFoto();

        return $respuesta;

    }    

}