<?php
namespace TrabajoSube;

class TarjetaFranquiciaCompleta extends Tarjeta {
    protected $tipo;
    private $tiposEspeciales = ['Jubilado','Discapacidad'];
    private $habilitadaFC;
    protected $vecesUsada = 0;
    private $fechaAnterior;
    private $flag = true;

    public function __construct($saldoInicial, $IDTarjeta, $tipoTarjeta){
        parent::__construct($saldoInicial, $IDTarjeta);
        $this->tipo = $tipoTarjeta;
    }

    public function actualizarHabilitadaFC($tiempo) {//t
        if(in_array($this->tipo,$this->tiposEspeciales) && $this->tiempoValido($tiempo)) {
            $this->habilitadaFC = true;
        } elseif($this->vecesUsada < 2 && $this->tiempoValido($tiempo)) {
            $this->habilitadaFC = true;
        } else {
            $this->flag = false;
            $this->habilitadaFC = false;
        }
    }

    public function actualizarTarifa($tarifa,$tiempo) {//t
        $this->actualizarHabilitadaFC($tiempo);
        if($this->habilitadaFC) {
            return 0;
        } else {
            return $tarifa;
        }
    }

    public function actualizarVecesUsada($tiempo) {//t
        $fechaActual = $tiempo->obtenerSoloFecha();

        if($this->fechaAnterior == $fechaActual  && $this->flag) { // Esta bandera permite que al cambiarse el día se empiece desde 1
            
            $this->vecesUsada++;
        } else {
            $this->flag = true;
            $this->fechaAnterior = $fechaActual;
            $this->vecesUsada = 1;
        }
    }

    public function tiempoValido($tiempo) {//t
        $diaSemana = date('N',$tiempo->obtenerTiempoInt());
        $hora = date('G',$tiempo->obtenerTiempoInt());

        if($diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora <= 22) {
            return true;
        } else {
            return false;
        }
    }
 

    public function obtenerHabilitadaFC() {//t
        return $this->habilitadaFC;
    }
}
?>