<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CitasFixture
 */
class CitasFixture extends TestFixture
{
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_cita' => 1,
                'fecha' => '2023-05-12',
                'hora' => '19:26:13',
                'nota_profesional' => 'Lorem ipsum dolor sit amet',
                'nota_paciente' => 'Lorem ipsum dolor sit amet',
                'id_usuario' => 1,
            ],
        ];
        parent::init();
    }
}
