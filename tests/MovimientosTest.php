<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class MovimientosTest extends TestCase
{
    /**
    * /movimientos [GET]
    *
    * @return void
    */
    public function testShouldReturnAllMovimientos() {
        $this->get('/movimientos');

        $this->seeStatusCode(200);
        $this->seeJsonStructure([
            'response' => [
                'current_page',
                'data' => [
                    '*' => [
                        'id',
                        'numeroempleado',
                        'nombrecompleto',
                        'rol',
                        'tipo',
                        'cubrioturno',
                        'cantidadentregas',
                        'fechamovimiento'
                    ]
                ],
                'total'
            ]
        ]);
    }

    /**
    * /movimientos/id [GET]
    *
    * @return void
    */
    public function testShouldReturnMovimiento() {
        $this->get('/movimientos/1');

        $this->seeStatusCode(200);
        $this->seeJsonStructure(
        ['response' =>
            [
                'id',
                'numeroempleado',
                'nombrecompleto',
                'rol',
                'tipo',
                'cubrioturno',
                'cantidadentregas',
                'fechamovimiento'
            ]
        ]);
    }

    /**
    * /movimientos [POST]
    *
    * @return void
    */
    public function testShouldCreateMovimiento() {
        $parameters = [
            'numeroempleado' => '90000007',
            'cubrioturno' => 'true',
            'empleadocubrio' => '90000001',
            'cantidadentregas' => '5',
            'fechamovimiento' => '2018-01-15'
        ];
        $this->post("movimientos", $parameters);
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }

    /**
    * /movimientos/id [PUT]
    *
    * @return void
    */
    public function testShouldUpdateMovimiento() {
        $parameters = [
            'numeroempleado' => '90000007',
            'cubrioturno' => 'false',
            'empleadocubrio' => '0',
            'cantidadentregas' => '3',
            'fechamovimiento' => '2018-01-17'
        ];
        $this->put("movimientos/5", $parameters);
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }

    /**
    * /movimientos/id [DELETE]
    *
    *@return void
    */
    public function testShouldDeleteMovimiento() {
        $this->delete("movimientos/5");
        $this->seeStatusCode(200);
        $this->seeJson([
            'response' => true,
        ]);
    }
}
