<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {
    
    public function testPagarConFP() {
        $tarjeta = new TarjetaFranquiciaParcial(4000,100,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,92.5,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);
    }
}
?>