<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CalendarioFixture
 */
class CalendarioFixture extends TestFixture
{
    /**
     * Table name
     *
     * @var string
     */
    public $table = 'calendario';
    /**
     * Init method
     *
     * @return void
     */
    public function init(): void
    {
        $this->records = [
            [
                'id_calendario' => 1,
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'fecha' => 'Lorem ipsum dolor sit amet',
            ],
        ];
        parent::init();
    }
}
