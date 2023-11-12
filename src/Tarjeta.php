<?php
namespace TrabajoSube;

class Tarjeta {
    protected $ID;
    private $tipo = "Normal";
    protected $saldo;
    protected $saldoExtra;
    protected $cargasValidas = [150, 200, 250, 300, 350, 400, 450, 500, 600, 700, 800,
                                900, 1000, 1100, 1200, 1300, 1400, 1500, 2000, 2500, 3000,
                                3500, 4000];
    protected $plus = 2;
    private $diasUsada;
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
            $this->diasUsada++;
        } else {
            $this->diasUsada = 1;
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
        } elseif($this->diasUsada < 30) {
            return $tarifa;
        } elseif($this->diasUsada > 80) {
            return $tarifa * 0.75;
        } else {
            return $tarifa * 0.8;
        }
    }





    public function obtenerTarifaModificada() {
        return $this->tarifaModificada;
    }
    public function obtenerTarjetaID() {
        return $this->ID;
    }
    public function obtenerTarjetaTipo() {
        return $this->tipo;
    }
    public function obtenerTarjetaSaldo() {
        return $this->saldo;
    }
    public function obtenerLineaAnterior(){
        return $this->lineaAnterior;
    }
    public function obtenerTiempoAnterior() {
        return $this->tiempoAnterior;
    }
}
















/*class Tarjeta {
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
    private $habilitadaN;

    public function __construct($saldoInicial, $IDTarjeta) {
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
        if($this->actualMesRegistrado == $this->ultimoMesRegistrado) {
            return true;
        } else {
            $this->ultimoMesRegistrado = $this->actualMesRegistrado;
            return false;
        }

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
    }
}*/


?>