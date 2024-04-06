<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\StaffsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\StaffsTable Test Case
 */
class StaffsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\StaffsTable
     */
    protected $Staffs;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Staffs',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Staffs') ? [] : ['className' => StaffsTable::class];
        $this->Staffs = $this->getTableLocator()->get('Staffs', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Staffs);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\StaffsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
