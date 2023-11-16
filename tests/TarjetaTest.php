<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class TarjetaTest extends TestCase {
    
    public function testObtener(){
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

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

        $verificar = $tarjeta->obtenerTarjetaSaldoExtra();
        $this->assertEquals(0, $verificar);
        $verificar = $tarjetaFC->obtenerTarjetaSaldoExtra();
        $this->assertEquals(0, $verificar);
        $verificar = $tarjetaFP->obtenerTarjetaSaldoExtra();
        $this->assertEquals(0, $verificar);

        $verificar = $tarjeta->obtenerViajesPlus();
        $this->assertEquals(2, $verificar);
        $verificar = $tarjetaFC->obtenerViajesPlus();
        $this->assertEquals(2, $verificar);
        $verificar = $tarjetaFP->obtenerViajesPlus();
        $this->assertEquals(2, $verificar);

        $verificar = $tarjeta->obtenerVecesUsada();
        $this->assertEquals(1, $verificar);
        $verificar = $tarjetaFC->obtenerVecesUsada();
        $this->assertEquals(1, $verificar);
        $verificar = $tarjetaFP->obtenerVecesUsada();
        $this->assertEquals(1, $verificar);

        $verificar = $tarjeta->obtenerHabilitadaTrasbordo();
        $this->assertEquals(false, $verificar);
        $verificar = $tarjetaFC->obtenerHabilitadaTrasbordo();
        $this->assertEquals(false, $verificar);
        $verificar = $tarjetaFP->obtenerHabilitadaTrasbordo();
        $this->assertEquals(false, $verificar);

        $verificar = $tarjeta->obtenerHabilitada();
        $this->assertEquals(true, $verificar);
        $verificar = $tarjetaFC->obtenerHabilitada();
        $this->assertEquals(true, $verificar);
        $verificar = $tarjetaFP->obtenerHabilitada();
        $this->assertEquals(true, $verificar);

        $verificar = $tarjetaFC->obtenerHabilitadaFC();
        $this->assertEquals(true, $verificar);
        $verificar = $tarjetaFP->obtenerHabilitadaFP();
        $this->assertEquals(true, $verificar);

        $colectivo->pagarCon($tarjeta,$tiempo);
        $colectivo->pagarCon($tarjetaFC,$tiempo);
        $colectivo->pagarCon($tarjetaFP,$tiempo);

        $verificar = $tarjeta->obtenerSaldoAnterior();
        $this->assertEquals(3815, $verificar);
        $verificar = $tarjetaFC->obtenerSaldoAnterior();
        $this->assertEquals(4000, $verificar);
        $verificar = $tarjetaFP->obtenerSaldoAnterior();
        $this->assertEquals(3907.5, $verificar);
    }

    public function testSumarEstablecer() {
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');

        $tarjeta->establecerSaldo(0);
        $tarjetaFC->establecerSaldo(0);
        $tarjetaFP->establecerSaldo(0);
        $this->assertEquals(0,$tarjeta->obtenerTarjetaSaldo());
        $this->assertEquals(0,$tarjetaFC->obtenerTarjetaSaldo());
        $this->assertEquals(0,$tarjetaFP->obtenerTarjetaSaldo());

        $tarjeta->restarViajesPlus(1);
        $tarjetaFC->restarViajesPlus(1);
        $tarjetaFP->restarViajesPlus(1);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());
        $this->assertEquals(1,$tarjetaFC->obtenerViajesPlus());
        $this->assertEquals(1,$tarjetaFP->obtenerViajesPlus());

        $tarjeta->sumarSaldoExtra(500);
        $tarjetaFC->sumarSaldoExtra(500);
        $tarjetaFP->sumarSaldoExtra(500);
        $this->assertEquals(500,$tarjeta->obtenerTarjetaSaldoExtra());
        $this->assertEquals(500,$tarjetaFC->obtenerTarjetaSaldoExtra());
        $this->assertEquals(500,$tarjetaFP->obtenerTarjetaSaldoExtra());

        $tarjeta->sumarVecesUsada(2);
        $tarjetaFC->sumarVecesUsada(2);
        $tarjetaFP->sumarVecesUsada(2);
        $this->assertEquals(2,$tarjeta->obtenerVecesUsada());
        $this->assertEquals(2,$tarjetaFC->obtenerVecesUsada());
        $this->assertEquals(2,$tarjetaFP->obtenerVecesUsada());
    }

    public function testActualizarViajesPlus() {
        $tarjeta = new Tarjeta(0,100);
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

        $this->assertEquals(2,$tarjeta->obtenerViajesPlus());
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());
        $tarjeta->cargarTarjeta(150);
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());

        $tarjeta = new Tarjeta(184,10);
        $colectivo->pagarCon($tarjeta,$tiempo);
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals(0,$tarjeta->obtenerViajesPlus());
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertEquals(0,$tarjeta->obtenerViajesPlus());
    }

    public function testActualizarSaldoExtra() {
        $tarjeta = new Tarjeta(6800,100);
        $tarjeta->actualizarSaldoExtra();
        $this->assertEquals(200,$tarjeta->obtenerTarjetaSaldoExtra());

        $tarjeta = new Tarjeta(6200,100);
        $tarjeta->sumarSaldoExtra(150);
        $tarjeta->actualizarSaldoExtra();
        $this->assertEquals(0,$tarjeta->obtenerTarjetaSaldoExtra());

        $tarjeta = new Tarjeta(6200,100);
        $tarjeta->sumarSaldoExtra(500);
        $tarjeta->actualizarSaldoExtra();
        $this->assertEquals(100,$tarjeta->obtenerTarjetaSaldoExtra());
    }

    public function testCargarTarjeta() {
        $tarjeta = new Tarjeta(0,10);
        $tarjetaFC = new TarjetaFranquiciaCompleta(0,11,'Estudiantil');
        $tarjetaFP = new TarjetaFranquiciaCompleta(0,12,'Estudiantil');
        $colectivo = new Colectivo(10);
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

        $colectivo->pagarCon($tarjeta, $tiempo);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());
        $verificar = $tarjeta->cargarTarjeta(5000);
        $this->assertFalse($verificar);
        $this->assertEquals(1,$tarjeta->obtenerViajesPlus());
        $verificar = $tarjeta->cargarTarjeta(4000);
        $this->assertEquals(2,$tarjeta->obtenerViajesPlus());
        

        $tarjeta = new Tarjeta(0,10);
        $verificar = $tarjeta->cargarTarjeta(100);
        $this->assertFalse($verificar);
        $this->assertEquals(0,$tarjeta->obtenerTarjetaSaldo());

        $verificar = $tarjeta->cargarTarjeta(150);
        $this->assertTrue($verificar);
        $this->assertEquals(150,$tarjeta->obtenerTarjetaSaldo());

        $verificar = $tarjeta->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(4150,$tarjeta->obtenerTarjetaSaldo());


        $verificar = $tarjeta->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(6600,$tarjeta->obtenerTarjetaSaldo());
        $this->assertEquals(1550,$tarjeta->obtenerTarjetaSaldoExtra());


        



        $colectivo->pagarCon($tarjetaFC, $tiempo);
        $this->assertEquals(1,$tarjetaFC->obtenerViajesPlus());
        $verificar = $tarjetaFC->cargarTarjeta(5000);
        $this->assertFalse($verificar);
        $this->assertEquals(1,$tarjetaFC->obtenerViajesPlus());
        $verificar = $tarjetaFC->cargarTarjeta(4000);
        $this->assertEquals(2,$tarjetaFC->obtenerViajesPlus());
        

        $tarjetaFC = new TarjetaFranquiciaCompleta(0,11,'Estudiantil');
        $verificar = $tarjetaFC->cargarTarjeta(100);
        $this->assertFalse($verificar);
        $this->assertEquals(0,$tarjetaFC->obtenerTarjetaSaldo());

        $verificar = $tarjetaFC->cargarTarjeta(150);
        $this->assertTrue($verificar);
        $this->assertEquals(150,$tarjetaFC->obtenerTarjetaSaldo());

        $verificar = $tarjetaFC->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(4150,$tarjetaFC->obtenerTarjetaSaldo());


        $verificar = $tarjetaFC->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(6600,$tarjetaFC->obtenerTarjetaSaldo());
        $this->assertEquals(1550,$tarjetaFC->obtenerTarjetaSaldoExtra());






        $colectivo->pagarCon($tarjetaFP, $tiempo);
        $this->assertEquals(1,$tarjetaFP->obtenerViajesPlus());
        $verificar = $tarjetaFP->cargarTarjeta(5000);
        $this->assertFalse($verificar);
        $this->assertEquals(1,$tarjetaFP->obtenerViajesPlus());
        $verificar = $tarjetaFP->cargarTarjeta(4000);
        $this->assertEquals(2,$tarjetaFP->obtenerViajesPlus());
        

        $tarjetaFP = new TarjetaFranquiciaParcial(0,11,'Estudiantil');
        $verificar = $tarjetaFP->cargarTarjeta(100);
        $this->assertFalse($verificar);
        $this->assertEquals(0,$tarjetaFP->obtenerTarjetaSaldo());

        $verificar = $tarjetaFP->cargarTarjeta(150);
        $this->assertTrue($verificar);
        $this->assertEquals(150,$tarjetaFP->obtenerTarjetaSaldo());

        $verificar = $tarjetaFP->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(4150,$tarjetaFP->obtenerTarjetaSaldo());


        $verificar = $tarjetaFP->cargarTarjeta(4000);
        $this->assertTrue($verificar);
        $this->assertEquals(6600,$tarjetaFP->obtenerTarjetaSaldo());
        $this->assertEquals(1550,$tarjetaFP->obtenerTarjetaSaldoExtra());
    }

    public function testActualizarTarifa(){
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $colectivo = new Colectivo(10);


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

        //AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA
        $this->assertEquals(50,$tarjetaFP->actualizarTarifa(100,$tiempo));
        $tarjetaFP->sumarVecesUsada(4);
        $this->assertEquals(100,$tarjetaFP->actualizarTarifa(100,$tiempo));

    }

    public function testActualizarVecesUsada() {
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,2,'Jubilado');

        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

        $this->assertEquals(0,$tarjeta->obtenerVecesUsada());
        $this->assertEquals(0,$tarjetaFC->obtenerVecesUsada());
        $this->assertEquals(0,$tarjetaFP->obtenerVecesUsada());
        
        $tarjeta->actualizarVecesUsada($tiempo);
        $tarjetaFC->actualizarVecesUsada($tiempo);
        $tarjetaFP->actualizarVecesUsada($tiempo);

        $this->assertEquals(1,$tarjeta->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFC->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFP->obtenerVecesUsada());


        $tiempo->agregarDias(1);

        $tarjeta->actualizarVecesUsada($tiempo);
        $tarjetaFC->actualizarVecesUsada($tiempo);
        $tarjetaFP->actualizarVecesUsada($tiempo);

        $this->assertEquals(2,$tarjeta->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFC->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFP->obtenerVecesUsada());

        $tiempo->agregarMeses(1);

        $tarjeta->actualizarVecesUsada($tiempo);
        $tarjetaFC->actualizarVecesUsada($tiempo);
        $tarjetaFP->actualizarVecesUsada($tiempo);

        $this->assertEquals(1,$tarjeta->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFC->obtenerVecesUsada());
        $this->assertEquals(1,$tarjetaFP->obtenerVecesUsada());
    }

    public function testTiempoValidoTrasbordo() {
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Estudiantil');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $tiempo = new TiempoInventado(7,11,2023,7,0,0);

        $this->assertTrue($tarjeta->tiempoValidoTrasbordo($tiempo));
        $this->assertTrue($tarjetaFC->tiempoValidoTrasbordo($tiempo));
        $this->assertTrue($tarjetaFP->tiempoValidoTrasbordo($tiempo));

        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $this->assertFalse($tarjeta->tiempoValidoTrasbordo($tiempo));
        $this->assertFalse($tarjetaFC->tiempoValidoTrasbordo($tiempo));
        $this->assertFalse($tarjetaFP->tiempoValidoTrasbordo($tiempo));

        $tiempo = new TiempoInventado(12,11,2023,7,0,0); // Mi cumpleaños
        $this->assertFalse($tarjeta->tiempoValidoTrasbordo($tiempo));
        $this->assertFalse($tarjetaFC->tiempoValidoTrasbordo($tiempo));
        $this->assertFalse($tarjetaFP->tiempoValidoTrasbordo($tiempo));
    }

    public function testActualizarHabilitadaTrasbordo() {
        $tarjeta = new Tarjeta(4000,1);
        $tiempo = new TiempoInventado(7,11,2023,7,0,0);
        $colectivo = new Colectivo(10);
        $colectivo2 = new Colectivo(11);

        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitadaTrasbordo());

        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitadaTrasbordo());

        $colectivo2->pagarCon($tarjeta,$tiempo);
        $this->assertTrue($tarjeta->obtenerHabilitadaTrasbordo());

        $tiempo->agregarSegundos(3600);
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitadaTrasbordo());

        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $colectivo->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitadaTrasbordo());
        $colectivo2->pagarCon($tarjeta,$tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitadaTrasbordo());

    }

    public function testActualizarHabilitada() {
        $tarjeta = new Tarjeta(4000,1);
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);

        $tarjeta->actualizarHabilitada($tiempo);
        $this->assertTrue($tarjeta->obtenerHabilitada());

        $tarjeta->restarViajesPlus(2);
        $tarjeta->actualizarHabilitada($tiempo);
        $this->assertTrue($tarjeta->obtenerHabilitada());

        $tarjeta = new Tarjeta(-1,1);
        $tarjeta->actualizarHabilitada($tiempo);
        $this->assertTrue($tarjeta->obtenerHabilitada());

        $tarjeta = new Tarjeta(-212,1);
        $tarjeta->actualizarHabilitada($tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitada());

        $tarjeta = new Tarjeta(-1,1);
        $tarjeta->restarViajesPlus(2);
        $tarjeta->actualizarHabilitada($tiempo);
        $this->assertFalse($tarjeta->obtenerHabilitada());
    }

    public function testTiempoValido() {
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,1,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,2,'Estudiantil');
        
        $tiempo = new TiempoInventado(7,11,2023,5,0,0);
        $this->assertFalse($tarjetaFC->tiempoValido($tiempo));
        
        $tiempo = new TiempoInventado(11,11,2023,6,0,0);
        $this->assertFalse($tarjetaFC->tiempoValido($tiempo));

        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $this->assertTrue($tarjetaFC->tiempoValido($tiempo));


        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $this->assertTrue($tarjetaFP->tiempoValido($tiempo));

        $tiempo = new TiempoInventado(7,11,2023,5,0,0);
        $this->assertFalse($tarjetaFP->tiempoValido($tiempo));
        
        $tiempo = new TiempoInventado(11,11,2023,6,0,0);
        $this->assertFalse($tarjetaFP->tiempoValido($tiempo));
    }

    public function testHabilitadaFranquicia() {
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,1,'Jubilado');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,2,'Estudiantil');

        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $tarjetaFP->actualizarHabilitadaFP($tiempo);
        $this->assertTrue($tarjetaFP->obtenerHabilitadaFP());
        $tarjetaFP->sumarVecesUsada(4);
        $tarjetaFP->actualizarHabilitadaFP($tiempo);
        $this->assertFalse($tarjetaFP->obtenerHabilitadaFP());

        $tiempo = new TiempoInventado(7,11,2023,5,0,0);
        $tarjetaFP->actualizarHabilitadaFP($tiempo);
        $this->assertFalse($tarjetaFP->obtenerHabilitadaFP());


        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertTrue($tarjetaFC->obtenerHabilitadaFC());
        $tarjetaFC->sumarVecesUsada(2);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertTrue($tarjetaFC->obtenerHabilitadaFC());

        $tiempo = new TiempoInventado(7,11,2023,5,0,0);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertFalse($tarjetaFC->obtenerHabilitadaFC());


        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,1,'Estudiantil');
        $tiempo = new TiempoInventado(7,11,2023,6,0,0);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertTrue($tarjetaFC->obtenerHabilitadaFC());
        $tarjetaFC->sumarVecesUsada(2);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertFalse($tarjetaFC->obtenerHabilitadaFC());

        $tiempo = new TiempoInventado(7,11,2023,5,0,0);
        $tarjetaFC->actualizarHabilitadaFC($tiempo);
        $this->assertFalse($tarjetaFC->obtenerHabilitadaFC());

    }

    public function testDescargarTarjeta() {
        $tarjeta = new Tarjeta(4000,1);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Estudiantil');
        $tarjetaFP = new TarjetaFranquiciaParcial(4000,3,'Estudiantil');
        $colectivo1 = new Colectivo(1);
        $colectivo2 = new Colectivo(2);
        $tiempo = new TiempoInventado(7,11,2023,7,0,0);

        $this->assertTrue($tarjeta->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjeta->establecerSaldo(-211.84);
        $this->assertFalse($tarjeta->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $this->assertTrue($tarjeta->descargarTarjeta(185,$colectivo2->obtenerLinea(),$tiempo));
        $tiempo->agregarDias(1);
        $this->assertFalse($tarjeta->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));


        $tiempo = new TiempoInventado(7,11,2023,7,0,0);
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-211.84);
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo2->obtenerLinea(),$tiempo));
        $tiempo->agregarDias(1);
        $this->assertFalse($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-212);
        $this->assertFalse($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-211.84);
        $tiempo = new TiempoInventado(7,11,2023,23,0,0);
        $this->assertFalse($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        

        $tiempo = new TiempoInventado(7,11,2023,7,0,0);
        $tarjetaFC = new TarjetaFranquiciaCompleta(4000,2,'Jubilado');
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-211.84);
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo2->obtenerLinea(),$tiempo));
        $tiempo->agregarDias(1);
        $this->assertTrue($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-212);
        $this->assertFalse($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFC->establecerSaldo(-211.84);
        $tiempo = new TiempoInventado(7,11,2023,23,0,0);
        $this->assertFalse($tarjetaFC->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));

        $tiempo = new TiempoInventado(7,11,2023,7,0,0);
        $this->assertTrue($tarjetaFP->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFP->establecerSaldo(-2);
        $this->assertTrue($tarjetaFP->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $this->assertTrue($tarjetaFP->descargarTarjeta(185,$colectivo2->obtenerLinea(),$tiempo));
        $tiempo->agregarDias(1);
        $this->assertFalse($tarjetaFP->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tarjetaFP->establecerSaldo(-211.84);
        $this->assertFalse($tarjetaFP->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
        $tiempo = new TiempoInventado(7,11,2023,23,0,0);
        $this->assertFalse($tarjetaFP->descargarTarjeta(185,$colectivo1->obtenerLinea(),$tiempo));
    }
}

?>