<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class Iteración3Test extends TestCase {
    public function testDistintosBoletos() {

        $tarjeta1 = new Tarjeta(200);
        $tarjeta2 = new TarjetaFranquiciaCompleta(200);
        $tarjeta3 = new TarjetaFranquiciaParcial(200);
        $tarjeta4 = new TarjetaFranquiciaParcial(200,"Ejemplo");
        $colectivo1 = new Colectivo(10);
        $boleto1 = new Boleto();


        $colectivo1->pagarCon($tarjeta1,$boleto1);
        $this->assertEquals("Normal", $boleto1->tipoTarjeta);

        $colectivo1->pagarCon($tarjeta2,$boleto1);
        $this->assertEquals("Jubilados", $boleto1->tipoTarjeta);

        $colectivo1->pagarCon($tarjeta3,$boleto1);
        $this->assertEquals("Estudiantil", $boleto1->tipoTarjeta);

        $colectivo1->pagarCon($tarjeta4,$boleto1);
        $this->assertEquals("Ejemplo", $boleto1->tipoTarjeta);
    }

    public function testParcialHabilitada() {
        $tarjeta5 = new TarjetaFranquiciaParcial(6600);
        $colectivo2 = new Colectivo(10);
        $boleto2 = new Boleto();
        $tiempoFalso2 = new TiempoFalso();

        $colectivo2->pagarCon($tarjeta5,$colectivo2,$tiempoFalso2);
        $tiempoFalso2->avanzar(120);
        $colectivo2->pagarCon($tarjeta5,$colectivo2,$tiempoFalso2);
        $this->assertEquals($colectivo2->tarifa,$boleto2->tarifaUsada);
        $tiempoFalso2->avanzar(300);
        $colectivo2->pagarCon($tarjeta5,$colectivo2,$tiempoFalso2);
        $this->assertEquals($colectivo2->mitadTarifa,$boleto2->tarifaUsada);
        $tiempoFalso2->avanzar(500);
        $colectivo2->pagarCon($tarjeta5,$colectivo2,$tiempoFalso2);
        $tiempoFalso2->avanzar(500);
        $colectivo2->pagarCon($tarjeta5,$colectivo2,$tiempoFalso2);
        $this->assertEquals($colectivo2->tarifa,$boleto2->tarifaUsada);
    }

    public function testCompletaHabilitada() {
        $tarjeta6 = new TarjetaFranquiciaCompleta(6600);
        $colectivo3 = new Colectivo(10);
        $boleto3 = new Boleto();
        $tiempoFalso3 = new TiempoFalso();

        $colectivo3->pagarCon($tarjeta6,$boleto3,$tiempoFalso3);
        $colectivo3->pagarCon($tarjeta6,$boleto3,$tiempoFalso3);
        $this->assertEquals($colectivo3->sinTarifa,$boleto3->tarifaUsada);
        $colectivo3->pagarCon($tarjeta6,$boleto3,$tiempoFalso3);
        $this->assertEquals($colectivo3->tarifa,$boleto3->tarifaUsada);
    }

    public function testSaldoExtra() {
        $tarjeta7 = new TarjetaFranquiciaCompleta(6100);
        $colectivo4 = new Colectivo(10);
        $boleto4 = new Boleto();
        $tiempoFalso4 = new TiempoFalso();


        $tarjeta7->cargarTarjeta(620);

        $this->assertEquals(6600,$tarjeta7->saldo);
        $this->assertEquals(120,$tarjeta7->saldoExtra);
        
        $colectivo4->pagarCon($tarjeta7,$boleto4,$tiempoFalso4);
        $this->assertEquals(6600,$tarjeta7->saldo);
        $this->assertEquals(0,$tarjeta7->saldoExtra);
    }
}

?>