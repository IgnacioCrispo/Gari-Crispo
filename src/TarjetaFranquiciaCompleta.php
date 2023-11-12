<?php
namespace TrabajoSube;

class TarjetaFranquiciaCompleta extends Tarjeta {
    private $tipo;
    private $tiposEspeciales = ['Jubilado','Discapacidad'];
    private $habilitadaFC;
    private $vecesUsada = 0;
    private $fechaAnterior;
    private $flag = true;

    public function __construct($saldoInicial, $IDTarjeta, $tipoTarjeta){
        parent::__construct($saldoInicial, $IDTarjeta);
        $this->tipo = $tipoTarjeta;
    }

    public function actualizarHabilitadaFC($tiempo) {
        if($this->tipo == 'Jubilado' && $this->tiempoValido($tiempo)) {
            $this->habilitadaFC = true;
        } elseif($this->vecesUsada < 2 && $this->tiempoValido($tiempo)) {
            $this->habilitadaFC = true;
        } else {
            $this->flag = false;
            $this->habilitadaFC = false;
        }
    }

    public function actualizarTarifa($tarifa,$tiempo) {
        $this->actualizarHabilitadaFC($tiempo);
        if($this->habilitadaFC) {
            return 0;
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

        if($diaSemana >= 1 && $diaSemana <= 5 && $hora >= 6 && $hora <= 22) {
            return true;
        } else {
            return false;
        }
    }
}




/*class TarjetaFranquiciaCompleta extends Tarjeta{
    protected $tipo;
    private $habilitadaFC = true;
    private $viajesHoy = 0;
    private $fechaUltimoViaje;
    private $tiposEspeciales = ["Jubilado","Discapacitado"];
    private $hora;
    private $dia;



    public function __construct($saldoInicial,$tipoDeTarjeta) {
        parent::__construct($saldoInicial);
        $this->tipo = $tipoDeTarjeta;
    }

    public function pagar($tarifa) {
        $this->saldo -= $tarifa;
        $this->actualizarSaldoExtra();
        $this->actualizarViajesPlus();

        $this->viajesHoy++;
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
        } elseif($this->saldo > 0 && $this->viajesHoy < 2) {
            $this->habilitadaFC = true;
        } elseif($this->saldo > -211.84 && $this->plus > 0 && $this->viajesHoy < 2) {
            $this->habilitadaFC = true;
        } else {
            $this->habilitadaFC = false;
        }
    }
    
    public function registrarDiaHora($tiempo) {
        $this->hora = date("N",$tiempo);
        $this->dia = date("G",$tiempo);
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
*
    public function obtenerHabilitada(){
        return $this->habilitadaFC;
    }
}*/
?>