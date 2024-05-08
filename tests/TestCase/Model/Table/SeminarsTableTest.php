<?php
declare(strict_types=1);

namespace App\Test\TestCase\Model\Table;

use App\Model\Table\SeminarsTable;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\SeminarsTable Test Case
 */
class SeminarsTableTest extends TestCase
{
    /**
     * Test subject
     *
     * @var \App\Model\Table\SeminarsTable
     */
    protected $Seminars;

    /**
     * Fixtures
     *
     * @var list<string>
     */
    protected array $fixtures = [
        'app.Seminars',
    ];

    /**
     * setUp method
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();
        $config = $this->getTableLocator()->exists('Seminars') ? [] : ['className' => SeminarsTable::class];
        $this->Seminars = $this->getTableLocator()->get('Seminars', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    protected function tearDown(): void
    {
        unset($this->Seminars);

        parent::tearDown();
    }

    /**
     * Test validationDefault method
     *
     * @return void
     * @uses \App\Model\Table\SeminarsTable::validationDefault()
     */
    public function testValidationDefault(): void
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
