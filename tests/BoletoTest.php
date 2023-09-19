<?php


namespace TrabajoSube;
use TrabajoSube\Colectivo;
use TrabajoSube\Tarjeta;

use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase{
   public function mostrarBoleto() {
    $tarjeta = new Tarjeta(1000);
    $colectivo = new Colectivo(115);



   }

}