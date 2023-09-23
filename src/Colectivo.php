<?php
namespace TrabajoSube;

require_once 'Tarjeta.php';

use TrabajoSube\Tarjeta;
use TrabajoSube\Boleto;

class Colectivo{
    private $tarifa = 120;
    private $linea;
    private $tarjeta;

    public function __construct($lineaColectivo = 0,$tarjetaUsada) {
        $this->linea = $lineaColectivo;
        $this->tarjeta = $tarjetaUsada;
    }

    public function pagarTarifa($tarjeta) {
        if($tarjeta->obtenerSaldo() >= $this->tarifa) {
            $tarjeta->descargarSaldo($this->tarifa);
            $boleto = new Boleto($tarjeta,$this->linea,$this->tarifa);
            return $boleto;
        }
        elseif(($tarjeta->obtenerSaldo() - $this->tarifa) >= 211.84 && $tarjeta->obtenerPlus() > 0) {
            $tarjeta->descargarSaldo($this->tarifa);
            $tarjeta->descontarPlus();
            $boleto = new Boleto($tarjeta,$this->linea,$this->tarifa);
            return $boleto;
        }
        return false;
    }

    public function obtenerTarifa() {
        return $this->tarifa;
    }

    public function getLinea() {
        return $this->linea;
    }
}
?>