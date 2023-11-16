<?php
namespace TrabajoSube;
use PHPUnit\Framework\TestCase;

class TiempoInventadoTest extends TestCase {

    public function testObtener() {
        $tiempo = new TiempoInventado(1,1,1970,0,0,0); // En PHP el 1ero de enero de 1970 es cuando se empieza a contar para las funciones de tiempo
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(0, $verificar);

        $tiempo = new TiempoInventado(1,1,1970,0,0,1); // 1s
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(1, $verificar);

        $tiempo = new TiempoInventado(1,1,1970,0,1,0); // 60s = 1 min
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(60, $verificar);

        $tiempo = new TiempoInventado(1,1,1970,1,0,0); // 3600s = 1 h
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(3600, $verificar);

        $tiempo = new TiempoInventado(2,1,1970,0,0,0); // 86400s = 1 d
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(86400, $verificar);

        $tiempo = new TiempoInventado(1,2,1970,0,0,0); // 2678400s = 1 mes (31 días)
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(2678400, $verificar);

        $tiempo = new TiempoInventado(1,1,1971,0,0,0); // 31536000 s = 1 año (365 días)
        $verificar = $tiempo->obtenerTiempoInt();
        $this->assertEquals(31536000, $verificar);
        

        $verificar = $tiempo->obtenerSoloFecha();
        $this->assertEquals(['dia' => '01', 'mes' => '01', 'anio' => '1971'], $verificar);
    }

    public function testAgregar() {
        $tiempo = new TiempoInventado(1,1,1970,0,0,0); // 0s
        $tiempo->agregarSegundos(5);
        $this->assertEquals(5,$tiempo->obtenerTiempoInt()); // 5s

        $tiempo = new TiempoInventado(1,1,1970,0,0,0);
        $tiempo->agregarDias(1);
        $this->assertEquals(86400,$tiempo->obtenerTiempoInt()); // 86400s = 1 día

        $tiempo = new TiempoInventado(1,1,1970,0,0,0);
        $tiempo->agregarMeses(1);
        $this->assertEquals(2678400,$tiempo->obtenerTiempoInt()); // Enero tiene 31 por lo que para pasar a frebero son necesarios 2678400 segundos
    }
}