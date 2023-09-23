<?php
use PHPUnit\Framework\TestCase;
use TrabajoSube\TarjetaCompleta;
use TrabajoSube\Colectivo;
use TrabajoSube\Boleto;

class TarjetaCompletaTest extends TestCase {
    public function testPagarBoleto() {
        // Crea una TarjetaCompleta con saldo inicial de 1000
        $tarjeta = new TarjetaCompleta(1000);
        $colectivo = new Colectivo(115);

        // Intenta pagar un boleto de 50
        $pagoExitoso = $colectivo->pagarTarifa($tarjeta);

        // Verifica que el pago haya sido exitoso
        $this->assertTrue($pagoExitoso);

        // Verifica que el saldo de la tarjeta sea 1000 después del pago
        $this->assertEquals(1000, $tarjeta->obtenerSaldo());
    }

    public function testDosViajesGratisPorDia() {
        // Crear una tarjeta de tipo boleto educativo gratuito
        $tarjeta = new TarjetaCompleta(0, 12345);
    
        // Hacer dos viajes gratuitos en el mismo día
        $colectivo = new Colectivo("115");
        $boleto1 = $colectivo->pagarTarifa($tarjeta);
    
        $colectivo = new Colectivo("116");
        $boleto2 = $colectivo->pagarTarifa($tarjeta);
    
        // Intentar hacer un tercer viaje gratuito
        $colectivo = new Colectivo("117");
        $boleto3 = $colectivo->pagarTarifa($tarjeta);
    
        // Verificar que los primeros dos viajes son gratuitos
        $this->assertTrue($boleto1 !== false);
        $this->assertTrue($boleto2 !== false);
    
        // Verificar que el tercer viaje no es gratuito
        $this->assertFalse($boleto3);
    }
    
    public function testViajesPosterioresAlSegundoCobranPrecioCompleto() {
        // Crear una tarjeta de tipo boleto educativo gratuito
        $tarjeta = new TarjetaCompleta(0,123);
    
        // Hacer dos viajes gratuitos en el mismo día
        $colectivo = new Colectivo("115");
        $boleto1 = $colectivo->pagarTarifa($tarjeta);
    
        $colectivo = new Colectivo("116");
        $boleto2 = $colectivo->pagarTarifa($tarjeta);
    
        // Hacer un tercer viaje que debería cobrarse con precio completo
        $colectivo = new Colectivo("117");
        $boleto3 = $colectivo->pagarTarifa($tarjeta);
    
        // Verificar que los primeros dos viajes son gratuitos
        $this->assertTrue($boleto1 !== false);
        $this->assertTrue($boleto2 !== false);
    
        // Verificar que el tercer viaje se cobre con precio completo
        $this->assertTrue($boleto3 !== false);
        $this->assertEquals(120, $colectivo->obtenerTarifa());
    }
}

?>