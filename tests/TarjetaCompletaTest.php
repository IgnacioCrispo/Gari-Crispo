<?php
use PHPUnit\Framework\TestCase;
use TrabajoSube\TarjetaCompleta;

class TarjetaCompletaTest extends TestCase {
    public function testPagarBoleto() {
        // Crea una TarjetaCompleta con saldo inicial de 1000
        $tarjeta = new TarjetaCompleta(1000);

        // Intenta pagar un boleto de 50
        $pagoExitoso = $tarjeta->descargarSaldo(50);

        // Verifica que el pago haya sido exitoso
        $this->assertTrue($pagoExitoso);

        // Verifica que el saldo de la tarjeta sea 1000 después del pago
        $this->assertEquals(1000, $tarjeta->obtenerSaldo());
    }
}
?>