<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * UsuariosFixture
 */
class UsuariosFixture extends TestFixture
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
                'password' => 'Lorem ipsum dolor sit amet',
                'correo' => 'Lorem ipsum dolor sit amet',
                'telefono' => 'Lorem ipsum dolor sit amet',
                'nombre' => 'Lorem ipsum dolor sit amet',
                'apellidos' => 'Lorem ipsum dolor sit amet',
                'es_admin' => 1,
                'alta' => '2023-05-14 21:13:37',
                'modificado' => '2023-05-14 21:13:37',
                'eliminado' => '2023-05-14 21:13:37',
            ],
        ];
        parent::init();
    }
}
