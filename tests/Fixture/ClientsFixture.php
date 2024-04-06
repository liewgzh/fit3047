<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * ClientsFixture
 */
class ClientsFixture extends TestFixture
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
                'email' => 'Lorem ipsum dolor sit amet',
                'password' => 'Lorem ipsum dolor sit amet',
                'first_name' => 'Lorem ipsum dolor sit amet',
                'last_name' => 'Lorem ipsum dolor sit amet',
                'date_of_birth' => '2024-04-06',
                'gender' => '',
                'phone_number' => 'Lorem ipsum dolor sit a',
                'created' => '2024-04-06 05:59:34',
                'modified' => '2024-04-06 05:59:34',
            ],
        ];
        parent::init();
    }
}
