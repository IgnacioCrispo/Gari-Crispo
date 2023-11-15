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
    private $flag = true;
    protected $vecesUsada = 0;
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

    public function cargarTarjeta($cargarSaldo) { //t
        if(in_array($cargarSaldo,$this->cargasValidas)) {
            $this->saldo += $cargarSaldo;
            $this->actualizarSaldoExtra();
            $this->flag = false;    // Esta bandera es para que si se da el caso en el que al cargar la tarjeta y el saldo siga en negativo, entonces no se van a restar plus
            $this->actualizarViajesPlus();
            $this->flag = true;

            return true;
        } else {
            return false;
        }
    }

    public function descargarTarjeta($tarifa,$linea,$tiempo) {//t
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

    public function actualizarHabilitada($tiempo) {//t
        if($this->saldo > 0) {
            $this->habilitada = true;
        } elseif(($this->saldo - $this->tarifaModificada) >= -211.84 && $this->plus > 0) {
            $this->habilitada = true;
        } else {
            $this->habilitada = false;
        }
    }

    public function actualizarHabilitadaTrasbordo($tiempo,$linea) {//t
        if($this->lineaAnterior == null || $this->tiempoAnterior == null) {
            $this->habilitadaTrasbordo = false;
        } elseif($this->lineaAnterior != $linea && ($tiempo->obtenerTiempoInt() - $this->tiempoAnterior < 3600)) {
            $this->tarifaModificada = 0;
            $this->habilitadaTrasbordo = true;
        } else {
            $this->habilitadaTrasbordo = false;
        }
    }

    public function actualizarVecesUsada($tiempo) {//t
        $mes = date('m', $tiempo->obtenerTiempoInt());
        if($this->mesAnterior == $mes) {
            $this->vecesUsada++;
        } else {
            $this->vecesUsada = 1;
            $this->mesAnterior = $mes;
        }
    }

    public function actualizarSaldoExtra() {//t
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

    public function actualizarViajesPlus(){//t
        if($this->saldo > 0) {
            $this->plus = 2;
        } elseif($this->flag) {
            $this->plus--;
        }
    }

    public function actualizarTarifa($tarifa,$tiempo) {//t
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
    public function obtenerTarjetaSaldoExtra() {//t
        return $this->saldoExtra;
    }
    public function obtenerViajesPlus() {//t
        return $this->plus;
    }
    public function obtenerVecesUsada(){//t
        return $this->vecesUsada;
    }
    public function obtenerHabilitadaTrasbordo() {//t
        return $this->habilitadaTrasbordo;
    }
    public function obtenerHabilitada() {//t
        return $this->habilitada;
    }

    public function sumarVecesUsada($veces) {
        $this->vecesUsada += $veces;
    }
    public function sumarSaldoExtra($saldo) {//t
        $this->saldoExtra += $saldo;
    }
    public function restarViajesPlus($cantidad) {//t
        $this->plus -= $cantidad;
    }
    public function establecerSaldo($saldo) {//t
        $this->saldo = $saldo;
    }
}
?>