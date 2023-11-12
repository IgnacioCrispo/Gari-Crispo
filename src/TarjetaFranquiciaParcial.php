<?php
namespace TrabajoSube;

class TarjetaFranquiciaParcial extends Tarjeta{
    private $tipo;
    private $habilitadaFP;
    private $vecesUsada = 0;
    private $fechaAnterior;
    protected $tiempoIntAnterior;
    private $flag = true;

    public function __construct($saldoInicial, $IDTarjeta, $tipoTarjeta) {
        parent::__construct($saldoInicial, $IDTarjeta);
        $this->tipo = $tipoTarjeta;
    }

    public function actualizarHabilitadaFP($tiempo) {
        if($this->vecesUsada < 4) {
            $this->habilitadaFP = true;
        } else {
            $this->flag = false;
            $this->habilitadaFP = false;
        }
    }

    public function actualizarTarifa($tarifa,$tiempo) {
        $this->actualizarHabilitadaFP($tiempo);
        if($this->habilitadaFP) {
            return $tarifa * 0.5;
        } else {
            return $tarifa;
        }
    }

    public function actualizarVecesUsada($tiempo) {
        $fechaActual = $tiempo->obtenerSoloFecha();

        if($this->fechaAnterior == $fechaActual && $this->flag) {
            
            $this->vecesUsada++;
        } else {
            $this->flag = true;
            $this->fechaAnterior = $fechaActual;
            $this->vecesUsada = 1;
        }
    }

    public function tiempoValido($tiempo) {
        $diaSemana = date('N',$tiempo->obtenerTiempoInt());
        $hora = date('G',$tiempo->obtenerTiempoInt());
        $tiempoActual = $tiempo->obtenerTiempoInt();

        if($diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora <= 22 && ($this->tiempoIntAnterior ==  null || ($tiempoActual - $this->tiempoIntAnterior) >= 500)) {
            if($this->tiempoIntAnterior ==  null) {
                $this->tiempoIntAnterior = $tiempoActual;
            }
            return true;
        } else {
            $this->tiempoAnterior = $tiempoActual;
            return false;
        }
    }
}










/*class TarjetaFranquiciaParcial extends Tarjeta{
    protected $tipo;
    private $habilitada = true;
    private $viajesHoy = 0;
    private $tiempoUltimoViaje = 0;
    private $fechaUltimoViaje;


    public function __construct($saldoInicial,$tipoDeTarjeta = "Estudiantil") {
        parent::__construct($saldoInicial);
        $this->tipo = $tipoDeTarjeta;
    }

    public function registrarViaje($tiempo) {
        $this->viajesHoy++;
        $this->tiempoUltimoViaje = $tiempo;
        $this->actualizarHabilitacion($tiempo);
        $this->fechaUltimoViaje = date("Y-m-d", $tiempo);
    }

    public function actualizarHabilitacion($tiempo) {
        if ($this->fechaUltimoViaje === date("Y-m-d",$tiempo)) {
            if($this->viajesHoy >= 4){
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

        if($tiempo - $this->tiempoUltimoViaje >= 300 && $dia >= 1 && $dia <= 5 && $hora >= 6 && $hora <= 22) {
            $this->habilitada = true;
            return $this->habilitada;
        }
        else {
            $this->habilitada = false;
            return $this->habilitada;
        }
    }

    public function obtenerHabilitada(){
        return $this->habilitada;
    }
}*/
?>