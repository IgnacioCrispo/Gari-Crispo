<?php
namespace TrabajoSube;

class Tarjeta {
    private $tipo = "Normal";
    private $ID;
    private $saldo;
    private $saldoExtra;
    private $plus = 2;
    private $historialSaldo = [];
    private $vecesUsadaMes = 0;
    private $ultimoMes;



    public function __construct($saldoInicial = 0, $IDTarjeta = 0) {
        $this->saldo = $saldoInicial;
        $this->ID = $IDTarjeta;
        $this->historialSaldo[] = $saldoInicial;
    }

    public function cargarTarjeta($cargarSaldo) {
        if (in_array($cargarSaldo,[150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800, 900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000, 3500, 4000])) {
            if($this->saldo + $cargarSaldo < 6600){
                $this->saldo += $cargarSaldo;
                if ($this->saldo > 0) {
                    $this->plus = 2;
                }
            
                return true;
            }
            else {
                $this->saldoExtra = $cargarSaldo - $this->saldo;

                return true;
            }
        }
        else {
            return false;
        }
    }

    public function descargarSaldo($restarSaldo) {
        $this->historialSaldo[] = $this->saldo;
        $this->saldo -= $restarSaldo;
        $this->vecesUsadaMes++;
        $this->agregarSaldoExtra();
    }

    public function agregarSaldoExtra() {
        if($this->saldo + $this->saldoExtra <= 6600) {
            $this->saldo += $this->saldoExtra;
            $this->saldoExtra = 0;
        }
        elseif($this->saldo) {
            $this->saldoExtra = 6600 - $this->saldo;
            $this->saldo = 6600;
        }
    }

    public function actualizarMes($mes) {
        if($this->ultimoMes == $mes || $this->ultimoMes == null){
            $this->ultimoMes = $mes;
        }
        else {
            $this->vecesUsadaMes = 0;
            $this->ultimoMes = $mes;
        }
    }

    public function establecerDias($dias){
        $this->vecesUsadaMes = $dias;
    }

}
?>