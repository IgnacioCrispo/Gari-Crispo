<?php
namespace TrabajoSube;

class TarjetaFranquiciaCompleta extends Tarjeta{
    private $tipo;
    private $habilitada = true;
    private $viajesHoy = 0;
    private $fechaUltimoViaje;
    private $dia;
    private $hora;

    public function __construct($saldoInicial,$tipoDeTarjeta = "Jubilados",$tiempo) {
        parent::__construct($saldoInicial);
        $this->tipo = $tipoDeTarjeta;
    }

    public function registrarViaje($tiempo) {
        $this->viajesHoy++;
        $this->tiempoUltimoViaje = $tiempo;
        $this->actualizarHabilitacion($tiempo);
        $this->fechaUltimoViaje = date("Y-m-d", $tiempo);
    }

    private function actualizarHabilitacion($tiempo) {
        if ($this->fechaUltimoViaje === date("Y-m-d",$tiempo)) {
            if($this->viajesHoy >= 2) {
                $this->habilitada = false;
            }
            else {
                $this->habilitada = true;
            }
        } else {
            $this->viajesHoy = 1;
            $this->habilitada = true;
        }
    }

    private function verificarHabilitada($tiempo) {
        $dia = date("N",$tiempo);
        $hora = date("G",$tiempo);

        if($dia >= 1 && $dia <= 5 && $hora >= 6 && $hora <= 22) {
            $this->habilitada = true;
            return $this->habilitada;
        }
        else {
            $this->habilitada = false;
            return $this->habilitada;
        }
    }
}
?>