<?php
namespace TrabajoSube;

class Boleto {
    public $lineaUsada;
    public $tarifaUsada;
    public $tarjetaID;
    public $tarjetaTipo;
    public $tarjetaSaldo;
    public $fecha;
    public $mensaje;

    
    public function __construct($linea,$tarifa,$tID,$tTipo,$tSaldo,$tiempo) {
        $this->lineaUsada = $linea;
        $this->tarifaUsada = $tarifa;
        $this->tarjetaID = $tID;
        $this->tarjetaTipo = $tTipo;
        $this->tarjetaSaldo = $tSaldo;
        $this->fecha = $tiempo;
    }
}






/*class Boleto {
    private $lineaUsada;
    private $tarifaUsada;
    private $saldoRestante;
    private $tipoTarjeta;
    private $IDTarjetaUsada;
    private $saldoAnterior;

    public function __construct($linea,$tarifa,$tarjeta) {
        $this->lineaUsada = $linea;
        $this->tarifaUsada = $tarifa;
        $this->saldoRestante = $tarjeta->obtenerSaldo();
        $this->tipoTarjeta = $tarifa->obtenerTipoTarjeta();
        $this->IDTarjetaUsada = $tarifa->obtenerIdTarjetaUsada();
    }







/*   public function actualizarBoleto($linea,$tarifa,$saldo,$tipoDeTarjeta,$IDTarjeta) {
        $this->lineaUsada = $linea;
        $this->tarifaUsada = $tarifa;
        $this->saldoRestante = $saldo;
        $this->tipoTarjeta = $tipoDeTarjeta;
        $this->IDTarjetaUsada = $IDTarjeta;
    }
/*    public function mostrarBoleto($tarjeta) {
        $this->saldoAnterior = end($tarjeta->historialSaldo);
        printf("Linea: %s\n", $this->lineaUsada);
        printf("Tarifa: %s\n", $this->tarifaUsada);
        if ($this->saldoAnterior < 0 && $this->saldoRestante > 0) {
            printf("Tu saldo ya no es negativo\n");
        }
        printf("Saldo Restante: %s\n", $this->saldoRestante);
        printf("Tipo de Tarjeta: %s\n", $this->tipoTarjeta);
        printf("ID de Tarjeta Usada: %s\n", $this->IDTarjetaUsada);
    }*

    public function obtenerLineaUsada() {
        return $this->lineaUsada;
    }
    public function obtenerTarifaUsada() {
        return $this->tarifaUsada;
    }
    public function obtenerSaldoRestante() {
        return $this->saldoRestante;
    }
    public function obtenerTipoTarjeta() {
        return $this->tipoTarjeta;
    }
}*/
?>