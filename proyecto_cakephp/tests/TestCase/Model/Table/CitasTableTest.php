<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\CitasTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\CitasTable Test Case
 */
class CitasTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\CitasTable
     */
    protected $Citas;

    /**
     * Fixtures
     *
     * @var array<string>
     */
    protected $fixtures = [
        'app.Citas',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Citas') ? [] : ['className' => CitasTable::class];
        $this->Citas = $this->getTableLocator()->get('Citas', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Citas);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\CitasTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
