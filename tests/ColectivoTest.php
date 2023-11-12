<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class ColectivoTest extends TestCase {
    
    public function testCargarTarjeta() {
        $tarjeta = new Tarjeta(0,10);
        
        $verificar = $tarjeta->cargarTarjeta(100);
        $this->assertFalse($verificar);

        $verificar = $tarjeta->cargarTarjeta(150);
        $this->assertTrue($verificar);

        $verificar = $tarjeta->cargarTarjeta(4000);
        $this->assertTrue($verificar);
    }

    public function testPagarBoleto() {
        $tarjeta = new Tarjeta(-211.84,100);
        $colectivo = new Colectivo(10);
        $colectivo2 = new Colectivo(11);
        $tiempo = new TiempoInventado(2023,11,11,0,0,0);

  
        $verificar = $colectivo->pagarCon($tarjeta,$tiempo); // Intentar pagar con mínimo de saldo posible y sin trasbordo
        $this->assertFalse($verificar);

        $tiempoInt = $tiempo->agregarDias(1); // Intentar pagar con saldo = 188.16 y sin trasbordo
        $tarjeta->cargarTarjeta(400); 
        $verificar = $colectivo2->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(11,185,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);
        
        $tiempo->agregarDias(1); // Intentar pagar con saldo = 3.16 y sin trasbordo
        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,185,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $tiempo->agregarSegundos(3);
        $verificar = $colectivo2->pagarCon($tarjeta,$tiempo); // Intentar pagar con saldo = -181.84 pero con trasbordo
        $boletoPrueba = new Boleto(11,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $tiempo->agregarDias(1); // Intentar pagar con saldo = -181.84 pero sin trasbordo
        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($verificar);
    }

    public function testPagarConFC() {
        $tarjeta = new TarjetaFranquiciaCompleta(4000,100,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,185,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $tiempo->agregarDias(1);
        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,185,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);
    }

    public function testPagarConFCEspeciales() {
        $tarjeta = new TarjetaFranquiciaCompleta(4000,100,'Jubilado');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);
        
        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $tiempo->agregarDias(1);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta, $tiempo);
        $boletoPrueba = new Boleto(10,0,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($boletoPrueba,$verificar);
    }
}
?>