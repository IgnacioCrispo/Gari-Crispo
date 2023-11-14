<?php
namespace TrabajoSube;

class Tarjeta {
    protected $ID;
    protected $tipo = "Normal";
    protected $saldo;
    protected $saldoExtra;
    protected $cargasValidas = [150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800,
                                900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000,
                                3500, 4000];
    protected $plus = 2;
    protected $vecesUsada;
    private $tarifaModificada = 0;
    protected $habilitada;
    protected $habilitadaTrasbordo;
    protected $lineaAnterior;
    protected $tiempoAnterior;
    private $mesAnterior;


    public function __construct($saldoInicial,$IDTarjeta) {
        $this->saldo = $saldoInicial;
        $this->ID = $IDTarjeta;
    }

    public function cargarTarjeta($cargarSaldo) {
        if(in_array($cargarSaldo,$this->cargasValidas)) {
            $this->saldo += $cargarSaldo;
            $this->actualizarSaldoExtra();
            $this->actualizarViajesPlus();

            return true;
        } else {
            return false;
        }
    }

    public function descargarTarjeta($tarifa,$linea,$tiempo) {
        $this->actualizarHabilitadaTrasbordo($tiempo,$linea);
        $this->tarifaModificada = $this->actualizarTarifa($tarifa,$tiempo);
        $this->actualizarHabilitada($tiempo);

        if($this->habilitadaTrasbordo) {
            $this->saldo -= $this->tarifaModificada;
            $this->actualizarVecesUsada($tiempo);
            $this->lineaAnterior = $linea;
            $this->tiempoAnterior = $tiempo->obtenerTiempoInt();

            return true;
        } elseif($this->habilitada) {
            $this->saldo -= $this->tarifaModificada;
            $this->actualizarSaldoExtra();
            $this->actualizarViajesPlus();
            $this->actualizarVecesUsada($tiempo);
            $this->lineaAnterior = $linea;
            $this->tiempoAnterior = $tiempo->obtenerTiempoInt();
            
            return true;
        } else {
            return false;
        }
    }

    public function actualizarHabilitada($tiempo) {
        if($this->saldo > 0) {
            $this->habilitada = true;
        } elseif(($this->saldo - $this->tarifaModificada) > -211.84 && $this->plus > 0) {
            $this->habilitada = true;
        } else {
            $this->habilitada = false;
        }
    }

    public function actualizarHabilitadaTrasbordo($tiempo,$linea) {
        if($this->lineaAnterior == null || $this->tiempoAnterior == null) {
            $this->habilitadaTrasbordo = false;
        } elseif($this->lineaAnterior != $linea && ($tiempo->obtenerTiempoInt() - $this->tiempoAnterior < 3600)) {
            $this->tarifaModificada = 0;
            $this->habilitadaTrasbordo = true;
        } else {
            $this->habilitadaTrasbordo = false;
        }
    }

    public function actualizarVecesUsada($tiempo) {
        $mes = date('m', $tiempo->obtenerTiempoInt());
        if($this->mesAnterior == $mes) {
            $this->vecesUsada++;
        } else {
            $this->vecesUsada = 1;
            $this->mesAnterior = $mes;
        }
    }

    public function actualizarSaldoExtra() {
        if($this->saldo > 6600) {
            $this->saldoExtra = $this->saldo - 6600;
            $this->saldo = 6600;
        } elseif(($this->saldo + $this->saldoExtra) > 6600) {
            $this->saldoExtra = ($this->saldo + $this->saldoExtra) - 6600;
            $this->saldo = 6600;
        } else {
            $this->saldo += $this->saldoExtra;
            $this->saldoExtra = 0;
        }
    }

    public function actualizarViajesPlus(){
        if($this->saldo > 0) {
            $this->plus = 2;
        } else {
            $this->plus--;
        }
    }

    public function actualizarTarifa($tarifa,$tiempo) {
        if($this->habilitadaTrasbordo){
            return 0;
        } elseif($this->vecesUsada < 30) {
            return $tarifa;
        } elseif($this->vecesUsada > 80) {
            return $tarifa * 0.75;
        } else {
            return $tarifa * 0.8;
        }
    }





    public function obtenerTarifaModificada() {//t
        return $this->tarifaModificada;
    }
    public function obtenerTarjetaID() {//t
        return $this->ID;
    }
    public function obtenerTarjetaTipo() {//t
        return $this->tipo;
    }
    public function obtenerTarjetaSaldo() {//t
        return $this->saldo;
    }
    public function obtenerLineaAnterior(){//t
        return $this->lineaAnterior;
    }
    public function obtenerTiempoAnterior() { //t
        return $this->tiempoAnterior;
    }

    public function sumarVecesUsada($veces) {
        $this->vecesUsada += $veces;
    }
}
?>