<?php

namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {
    public function testGetLinea() {
        $tarjeta = new Tarjeta(600, 10);
        $cole = new Colectivo(103, $tarjeta);
        $this->assertEquals($cole->getLinea(), 103);
    }
}
?>