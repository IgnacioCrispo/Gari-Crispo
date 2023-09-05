<?php
namespace TrabajoSube;

require_once 'Colectivo.php';
require_once 'Tarjeta.php';

use TrabajoSube\Tarjeta;
use TrabajoSube\Colectivo;

class Boleto{
    private $lineaColectivo;
    private $saldoRestante;
    private $tarifaUsada;

    public function __construct($tarjeta,$colectivo) {
        $this->lineaColectivo = $colectivo->obtenerLinea();
        $this->tarifaUsada = $colectivo->obtenerTarifa();
        $this->saldoRestante = $tarjeta->obtenerSaldo();
    }

    public function imprimirBoleto() {
        printf("Usted esta viajando en la linea %s, se le corbro %d y su saldo restante es %d", $this->lineaColectivo, $this->tarifaUsada, $this->saldoRestante);

    }
}
?>