<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * CalendariosFixture
 */
class CalendariosFixture extends TestFixture
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
                'descripcion' => 'Lorem ipsum dolor sit amet',
                'fecha' => '2023-05-29',
            ],
        ];
        parent::init();
    }
}
