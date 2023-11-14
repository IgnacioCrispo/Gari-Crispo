<?php
namespace TrabajoSube;

class TarjetaFranquiciaParcial extends Tarjeta{
    protected $tipo;
    private $habilitadaFP;
    protected $vecesUsada = 0;
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
?>