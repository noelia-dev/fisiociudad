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
                'id' => 1,
                'fecha' => '2023-05-18',
                'hora' => '21:07:25',
                'nota_profesional' => 'Lorem ipsum dolor sit amet',
                'nota_paciente' => 'Lorem ipsum dolor sit amet',
                'usuario_id' => 1,
                'calendario_id' => 1,
                'alta' => '2023-05-18 21:07:25',
            ],
        ];
        parent::init();
    }
}
