<?php
namespace TrabajoSube;

class TiempoInventado {
    private $tiempo;

    public function __construct($dia,$mes,$anio,$hora,$minutos,$segundos) {
        $this->tiempo = mktime($hora,$minutos,$segundos,$mes,$dia,$anio);
    }

    public function agregarSegundos($aSegundos) {
        $this->tiempo += $aSegundos;
        return $this->tiempo;
    }
    public function agregarDias($aDias) {
        $this->tiempo += $aDias * 24 * 60 * 60;
        return $this->tiempo;
    }
    public function agregarMeses($aMeses) {
        $this->tiempo = strtotime("+$aMeses months", $this->tiempo);
        return $this->tiempo;
    }

    public function obtenerTiempoInt() {
        return $this->tiempo;
    }
    public function obtenerSoloFecha() {
        return [
            'dia' => date('d', $this->tiempo),
            'mes' => date('m', $this->tiempo),
            'anio' => date('Y', $this->tiempo), 
        ];
    }
}
?>