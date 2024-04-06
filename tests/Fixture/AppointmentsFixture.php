<?php
declare(strict_types=1);

namespace App\Test\Fixture;

use Cake\TestSuite\Fixture\TestFixture;

/**
 * AppointmentsFixture
 */
class AppointmentsFixture extends TestFixture
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
                'client_id' => 1,
                'counsellor_id' => 1,
                'service_id' => 1,
                'appoinment_date_time' => '2024-04-06 05:36:40',
                'duration' => 1,
                'appoinment_status' => 'Lorem ipsum dolor ',
                'created' => '2024-04-06 05:36:40',
                'modified' => '2024-04-06 05:36:40',
            ],
        ];
        parent::init();
    }
}
