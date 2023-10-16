<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class Iteración1Test extends TestCase {
    
    public function testBoleto(){
        $tarjeta1 = new Tarjeta(400);
        $colectivo1 = new Colectivo(10);
        $boleto1 = new Boleto();

        $colectivo1->pagarCon($tarjeta1,$boleto1);

        $this->assertEquals($colectivo1->linea, $boleto1->lineaUsada);
        $this->assertEquals($colectivo1->tarifa, $boleto1->tarifaUsada);
        $this->assertEquals($tarjeta1->saldo, $boleto1->saldoRestante);
    }
}
?>