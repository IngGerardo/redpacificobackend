<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class EmpleadosTest extends TestCase
{
    /**
    * /empleados [GET]
    *
    * @return void
    */
    public function testShouldReturnAllEmpleados() {
        $this->get('/empleados');

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'response' => [
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'numeroempleado',
                        'nombre',
                        'apellidopaterno',
                        'apellidomaterno',
                        'rol',
                        'tipo',
                        'fecharegistro'
                    ]
                ],
                'total'
            ]
        ]);
    }

    /**
    * /empleados/id [GET]
    *
    * @return void
    */
    public function testShouldReturnEmpleado() {
        $this->get('/empleados/90000000');

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
        ['response' =>
            [
                'id',
                'numeroempleado',
                'nombre',
                'apellidopaterno',
                'apellidomaterno',
                'rol',
                'tipo',
                'fecharegistro'
            ]
        ]);
    }

    /**
    * /empleados [POST]
    *
    * @return void
    */
    public function testShouldCreateEmpleado() {
        $parameters = [
            'nombre' => 'Usuario Test',
            'apellidopaterno' => 'phpunit',
            'apellidomaterno' => 'prueba',
            'rol' => '3',
            'tipo' => '1'
        ];
        $this->post("empleados", $parameters);
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }

    /**
    * /empleados/id [PUT]
    *
    * @return void
    */
    public function testShouldUpdateEmpleado() {
        $parameters = [
            'nombre' => 'Usuario Actualizado',
            'apellidopaterno' => 'phpunit',
            'apellidomaterno' => 'test',
            'rol' => '1',
            'tipo' => '2'
        ];
        $this->put("empleados/90000008", $parameters);
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }

    /**
    * /empleados/id [DELETE]
    *
    *@return void
    */
    public function testShouldDeleteEmpleado() {
        $this->delete("empleados/90000008");
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }
}
