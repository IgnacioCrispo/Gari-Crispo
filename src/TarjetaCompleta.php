<?php
namespace TrabajoSube;
class TarjetaCompleta extends Tarjeta {
    private $gratisDisponible = 2;
    public function __construct($saldoInicial = 0,$IDTarjeta = 0) {
        parent::__construct($saldoInicial,$IDTarjeta);
    }

    public function descargarSaldo($quitar) {
        if($this->gratisDisponible > 0){
            $this->saldo -= 0;
            return 0;
        }
        else{
            $this->saldo -= $quitar;
            return $quitar;
        }
    }
}
?>