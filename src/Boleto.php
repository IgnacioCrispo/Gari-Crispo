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
    private $IDTarjetaUsada;
    private $fechaHora = time();


    public function __construct($tarjeta,$linea,$tarifa) {
        $this->lineaColectivo = $linea;
        $this->tarifaUsada = $tarifa;
        $this->saldoRestante = $tarjeta->obtenerSaldo();
        $this->IDTarjetaUsada = $tarjeta->obtenerID();
    }

    public function imprimirBoleto() {
        printf("Usted esta viajando en la linea %s, se le cobro %d a la fecha de %s y su saldo restante es %d", $this->lineaColectivo, $this->tarifaUsada, date("d/m/Y H:i:s", $this->fechaHora), $this->saldoRestante);
    }
}
?>