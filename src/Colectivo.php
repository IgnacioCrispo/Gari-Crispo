<?php
namespace TrabajoSube;

require_once 'Tarjeta.php';

use TrabajoSube\Tarjeta;
use TrabajoSube\Boleto;

class Colectivo{
    private $tarifa = 120;
    private $linea;

    public function __construct($lineaColectivo) {
        $this->linea = $lineaColectivo;
    }

    public function pagarTarifa($tarjeta) {
        if($tarjeta->obtenerSaldo() >= $this->tarifa) {
            $tarjeta->descargarSaldo($this->tarifa);
            $boleto = new Boleto($tarjeta,$linea,$tarifa);
            $boleto->imprimirBoleto();
            return true;
        }
        elseif(($tajeta->obtenerSaldo() - $tarifa) >= 211.84 && $tarjeta->obtenerPlus() > 0) {
            $tarjeta->descargarSaldo($this->tarifa);
            $tajeta->descontarPlus();
            $boleto = new Boleto($tarjeta,$linea,$tarifa);
            $boleto->imprimirBoleto();
            return true;
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