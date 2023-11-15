<?php
namespace TrabajoSube;

class Colectivo {
    private $tarifa = 185;
    private $tarifaInterurbana = 300;
    public $linea;
    private $lineasInterurbanas = [1000,1001,1002];

    public function __construct($lineaUsada) {
        $this->linea = $lineaUsada;
    }

    public function pagarCon($tarjeta,$tiempo) {//t
        $pagoHecho = $tarjeta->descargarTarjeta($this->usarTarifa(),$this->linea,$tiempo);
        if($pagoHecho){
            $boleto = new Boleto($this->linea,$tarjeta->obtenerTarifaModificada(),$tarjeta->obtenerTarjetaID(),$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
            return $boleto;
        } else {
            return false;
        }
    }

    public function usarTarifa() {//t
        if(in_array($this->linea,$this->lineasInterurbanas)) {
            return $this->tarifaInterurbana;
        } else {
            return $this->tarifa;
        }
    }   




    public function obtenerLinea() {//t
        return $this->linea;
    }


}
?>