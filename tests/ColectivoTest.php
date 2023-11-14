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

    public function testPagarConFP() {
        $tarjeta = new TarjetaFranquiciaParcial(4000,100,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,92.5,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($verificar,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,92.5,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($verificar,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,92.5,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($verificar,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,92.5,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($verificar,$verificar);

        $verificar = $colectivo->pagarCon($tarjeta,$tiempo);
        $boletoPrueba = new Boleto(10,185,100,$tarjeta->obtenerTarjetaTipo(),$tarjeta->obtenerTarjetaSaldo(),$tiempo);
        $this->assertEquals($verificar,$verificar);
    }








    public function testObtener(){
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);

        $colectivo->pagarCon($tarjeta,$tiempo);
        $colectivo->pagarCon($tarjetaFC,$tiempo);
        $colectivo->pagarCon($tarjetaFP,$tiempo);

        $verificar = $tarjeta->obtenerTiempoAnterior();
        $this->assertEquals($tiempo->obtenerTiempoInt(), $verificar);
        $verificar = $tarjetaFC->obtenerTiempoAnterior();
        $this->assertEquals($tiempo->obtenerTiempoInt(), $verificar);
        $verificar = $tarjetaFP->obtenerTiempoAnterior();
        $this->assertEquals($tiempo->obtenerTiempoInt(), $verificar);

        $verificar = $tarjeta->obtenerLineaAnterior();
        $this->assertEquals(10, $verificar);
        $verificar = $tarjetaFC->obtenerLineaAnterior();
        $this->assertEquals(10, $verificar);
        $verificar = $tarjetaFP->obtenerLineaAnterior();
        $this->assertEquals(10, $verificar);

        $verificar = $tarjeta->obtenerTarjetaSaldo();
        $this->assertEquals(3815, $verificar);
        $verificar = $tarjetaFC->obtenerTarjetaSaldo();
        $this->assertEquals(4000, $verificar);
        $verificar = $tarjetaFP->obtenerTarjetaSaldo();
        $this->assertEquals(3907.5, $verificar);

        $verificar = $tarjeta->obtenerTarjetaTipo();
        $this->assertEquals('Normal', $verificar);
        $verificar = $tarjetaFC->obtenerTarjetaTipo();
        $this->assertEquals('Jubilado', $verificar);
        $verificar = $tarjetaFP->obtenerTarjetaTipo();
        $this->assertEquals('Estudiantil', $verificar);

        $verificar = $tarjeta->obtenerTarjetaID();
        $this->assertEquals(1, $verificar);
        $verificar = $tarjetaFC->obtenerTarjetaID();
        $this->assertEquals(2, $verificar);
        $verificar = $tarjetaFP->obtenerTarjetaID();
        $this->assertEquals(3, $verificar);

        $verificar = $tarjeta->obtenerTarifaModificada();
        $this->assertEquals(185, $verificar);
        $verificar = $tarjetaFC->obtenerTarifaModificada();
        $this->assertEquals(0, $verificar);
        $verificar = $tarjetaFP->obtenerTarifaModificada();
        $this->assertEquals(92.5, $verificar);
    }

    public function testActualizarTariza(){
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $tiempo = new TiempoInventado(2023,11,7,6,0,0);


        $this->assertEquals(100,$tarjeta->actualizarTarifa(100,$tiempo));
        $tarjeta->sumarVecesUsada(29);
        $this->assertEquals(100,$tarjeta->actualizarTarifa(100,$tiempo));
        $tarjeta->sumarVecesUsada(30);
        $this->assertEquals(80,$tarjeta->actualizarTarifa(100,$tiempo));
        $tarjeta->sumarVecesUsada(50);
        $this->assertEquals(75,$tarjeta->actualizarTarifa(100,$tiempo));


        $this->assertEquals(0,$tarjetaFC->actualizarTarifa(100,$tiempo));
        $tarjetaFC->sumarVecesUsada(2);
        $this->assertEquals(0,$tarjetaFC->actualizarTarifa(100,$tiempo));
        
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Estudiantil');
        $this->assertEquals(0,$tarjetaFC->actualizarTarifa(100,$tiempo));
        $tarjetaFC->sumarVecesUsada(2);
        $this->assertEquals(100,$tarjetaFC->actualizarTarifa(100,$tiempo));

        
        $this->assertEquals(50,$tarjetaFP->actualizarTarifa(100,$tiempo));
        $tarjetaFC->sumarVecesUsada(4);
//        $this->assertEquals(100,$tarjetaFP->actualizarTarifa(100,$tiempo));

    }











}
?>