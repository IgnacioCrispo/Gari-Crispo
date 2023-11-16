<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class BoletoTest extends TestCase {
    public function testMostrarMensaje() {
        $tarjeta = new Tarjeta(0,1);
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals('La tarifa pagada es de 185 pesos y su saldo restante es de -185 pesos.', $verificar->mostrarMensaje());

        $tarjeta->cargarTarjeta(4000);
        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals('La tarifa pagada es de 185 pesos y su saldo restante es de 3630 pesos. Su saldo dejó de ser negativo.', $verificar->mostrarMensaje());

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals('La tarifa pagada es de 185 pesos y su saldo restante es de 3445 pesos.', $verificar->mostrarMensaje());

        $tarjeta->cargarTarjeta(150);
        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals('La tarifa pagada es de 185 pesos y su saldo restante es de 3410 pesos.', $verificar->mostrarMensaje());
}

}

?>