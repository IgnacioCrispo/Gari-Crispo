<?php
namespace TrabajoSube;

class Tarjeta {
    protected $tipo = "Normal";
    protected $ID;
    protected $saldo;
    protected $saldoExtra;
    protected $plus = 2;
    protected $cargasValidas = [150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000, 3500, 4000];
    protected $historialSaldo = [];
    private $vecesUsada = 0;
    private $ultimoMesRegistrado;
    private $actualMesRegistrado;
    private $habilitadaN = true;

    public function __construct($saldoInicial = 0, $IDTarjeta = 0) {
        $this->saldo = $saldoInicial;
        $this->ID = $IDTarjeta;
        $this->historialSaldo[] = $saldoInicial;
    }

    public function pagar($tarifa) {
        $this->saldo -= $tarifa;
        $this->actualizarSaldoExtra();
        $this->actualizarHabilitadaN();
    }

    public function agregarDiasUsada() {
            $this->vecesUsada++;
    }

    public function reestablecerDiasUsada() {
        $this->vecesUsada = 0;
    }

    public function actualizarMesActual($tiempo) {
        $mes = date('m', $tiempo);
        $this->actualMesRegistrado = $mes;
    }

    public function verificarMismoMes() {
        return $this->actualMesRegistrado == $this->ultimoMesRegistrado;
    }



    public function cargarTarjeta($cargar) {
        if(in_array($cargar,$this->cargasValidas)) {
            $this->saldo += $cargar;
            $this->actualizarSaldoExtra();
            $this->actualizarViajesPlus();
            $this->actualizarHabilitadaN();
        } else {
            return false;
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
    public function actualizarViajesPlus() {
        if($this->saldo > 0) {
            $this->plus = 2;
        } else {
            $this->plus--;
        }
    }

    public function actualizarHabilitadaN(){
        if($this->saldo > 0) {
            $this->habilitadaN = true;
        } elseif($this->saldo >= -211.84 && $this->plus > 0) {
            $this->habilitadaN = true;
        } else {
            $this->habilitadaN = false;
        }
    }

    public function obtenerHabilitada() {
        return $this->habilitadaN;
    }


/*    public function cargarTarjeta($cargarSaldo) {
    if (in_array($cargarSaldo,[150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000, 3500, 4000])) {
        if($this->saldo + $cargarSaldo <= 6600){
            $this->saldo += $cargarSaldo;
            if ($this->saldo > 0) {
                $this->plus = 2;
            }
        
            return true;
        }
        else {
            $excess = $this->saldo + $cargarSaldo - 6600;
            $this->saldo = 6600;
            $this->saldoExtra = $excess;

            return true;
        }
    }
    else {
        return false;
    }
}*/


    /*public function descargarSaldo($restarSaldo) {
        $this->historialSaldo[] = $this->saldo;
        $this->saldo -= $restarSaldo;
    }*/

/*    public function agregarSaldoExtra() {
        if($this->saldo < 6600 && $this->saldo + $this->saldoExtra > 6600) {
            $this->saldoExtra -= (6600 - $this->saldo);
            $this->saldo = 6600;
        }
        elseif($this->saldo + $this->saldoExtra <= 6600) {
            $this->saldo += $this->saldoExtra;
            $this->saldoExtra = 0;
        }
    }
*/


    public function descargarPlus(){
        $this->plus--;
    }

    public function obtenerSaldo() {
        return $this->saldo;
    }
    public function obtenerTipo() {
        return $this->tipo;
    }
    public function obtenerPlus() {
        return $this->plus;
    }
    public function obtenerID() {
        return $this->ID;
    }
    public function obtenerSaldoExtra() {
        return $this->saldoExtra;
    }
    
/*    public function actualizarMes($mes) {
        if($this->ultimoMes == $mes || $this->ultimoMes == null){
            $this->ultimoMes = $mes;
        }
        else {
            $this->vecesUsadaMes = 0;
            $this->ultimoMes = $mes;
        }
    }
*/
/*    public function sumarVecesUsadas() {
        $this->vecesUsadaMes++;
    }

    public function establecerDias($dias){
        $this->vecesUsadaMes = $dias;
    }*/
}


?>