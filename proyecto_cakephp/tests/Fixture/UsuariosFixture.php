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
                'alta' => '2023-06-10 16:40:23',
                'modificado' => '2023-06-10 16:40:23',
                'eliminado' => '2023-06-10 16:40:23',
                'reset_token' => 'Lorem ipsum dolor sit amet',
                'caducidad_token' => '2023-06-10 16:40:23',
            ],
        ];
        parent::init();
    }
}
