<?php
namespace TrabajoSube;

class Boleto {
    private $lineaUsada;
    private $tarifaUsada;
    private $tarjetaID;
    private $tarjetaTipo;
    private $tarjetaSaldo;
    private $fechaHora;
    private $mensaje;
 
    
    public function __construct($linea,$tarifa,$tID,$tTipo,$tSaldo,$tiempo,$saldoAnterior) {
        $this->lineaUsada = $linea;
        $this->tarifaUsada = $tarifa;
        $this->tarjetaID = $tID;
        $this->tarjetaTipo = $tTipo;
        $this->tarjetaSaldo = $tSaldo;
        $this->fechaHora = $tiempo;

        $this->mensaje = 'La tarifa pagada es de ' . $this->tarifaUsada . ' pesos y su saldo restante es de ' . $this->tarjetaSaldo . ' pesos.';

        if($saldoAnterior != null && $saldoAnterior < 0 && $tSaldo >= 0) {
            $this->mensaje = $this->mensaje . ' Su saldo dejó de ser negativo.';
        }
    }

    public function mostrarMensaje(){//t
        echo $this->mensaje;

        return $this->mensaje;
    }


}
?>