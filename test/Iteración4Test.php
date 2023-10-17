<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class Iteración4Test extends TestCase {
    public function testDescuentos() {
        $tarjeta1 = new Tarjeta(600);
        $colectivo1 = new Colectivo(10);
        $boleto1 = new Boleto();
        $tiempoFalso1 = new TiempoFalso(0);

        $tarjeta1->establecerDias(2);
        $colectivo1->pagarCon($tarjeta1,$boleto1,$tiempoFalso1);
        $this->assertEquals($colectivo1->tarifa, $colectivo1->tarifaModificada);
        $tarjeta1->establecerDias(32);
        $colectivo1->pagarCon($tarjeta1,$boleto1,$tiempoFalso1);
        $this->assertEquals($colectivo1->tarifa * 0.8, $colectivo1->tarifaModificada);
        $tarjeta1->establecerDias(82);
        $colectivo1->pagarCon($tarjeta1,$boleto1,$tiempoFalso1);
        $this->assertEquals($colectivo1->tarifa * 0.75, $colectivo1->tarifaModificada);
    }

    public function testDias() {
        $tarjeta1 = new TarjetaFranquiciaCompleta(600);
        $tarjeta2 = new TarjetaFranquiciaParcial(600);
        $colectivo1 = new Colectivo(10);
        $boleto1 = new Boleto();
        $tiempoFalso1 = new TiempoFalso(0);

        $tiempoFalso1->avanzar(518400);
        $colectivo1->pagarCon($tarjeta1,$boleto1,$tiempoFalso1);
        $this->assertEquals(false, $tarjeta1->habilitada);

        $colectivo1->pagarCon($tarjeta2,$boleto1,$tiempoFalso1);
        $this->assertEquals(false, $tarjeta2->habilitada);

        
    }

}
?>