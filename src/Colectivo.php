<?php
namespace TrabajoSube;

require_once 'Tarjeta.php';

use TrabajoSube\Tarjeta;

class Colectivo{
    private $tarifa = 120;
    private $linea;

    public function __construct($lineaColectivo) {
        $this->linea = $lineaColectivo;
    }

    public function pagarTarifa($tarjeta) {
        if($tarjeta->obtenerSaldo() >= $this->tarifa) {
            $tarjeta->descargarSaldo($this->tarifa);
            return true;
        }
        return false;
    }

    public function obtenerTarifa() {
        return $this->tarifa;
    }

    public function obtenerLinea() {
        return $this->linea;
    }
}
?>