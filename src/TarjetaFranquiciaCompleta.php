<?php
namespace TrabajoSube;

class TarjetaFranquiciaCompleta extends Tarjeta{
    protected $tipo;
    private $habilitadaFC = true;
    private $viajesHoy = 0;
    private $fechaUltimoViaje;
    private $tiposEspeciales = ["Jubilado","Discapacitado"];


    public function __construct($saldoInicial,$tipoDeTarjeta) {
        parent::__construct($saldoInicial);
        $this->tipo = $tipoDeTarjeta;
    }

    public function pagar($tarifa) {
        $this->saldo -= $tarifa;
        $this->actualizarSaldoExtra();
        $this->actualizarViajesPlus();

    }

    public function cargarTarjeta($cargar) {
        if(in_array($cargar,$this->cargasValidas)) {
            $this->saldo += $cargar;
            $this->actualizarSaldoExtra();
            $this->actualizarViajesPlus();
            $this->actualizarHabilitadaFC();
        } else {
            return false;
        }
    }

    public function actualizarHabilitadaFC() {
        if(in_array($this->tipo,$this->tiposEspeciales)) {
            $this->habilitadaFC = true;
        } elseif($this->saldo > 0) {
            $this->habilitadaFC = true;
        } elseif($this->saldo > -211.84 && $this->plus > 0) {
            $this->habilitadaFC = true;
        } else {
            $this->habilitadaFC = false;
        }
    }




/*    public function registrarViaje($tiempo) {
        $this->viajesHoy++;
        $this->tiempoUltimoViaje = $tiempo;
        $this->actualizarHabilitacion($tiempo);
        $this->fechaUltimoViaje = date("Y-m-d", $tiempo);
    }

    public function actualizarHabilitacion($tiempo) {
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
    public function verificarHabilitada($tiempo) {
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
*/
    public function obtenerHabilitada(){
        return $this->habilitadaFC;
    }
}
?>