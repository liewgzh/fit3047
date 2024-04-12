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
                'guest_name' => 'Lorem ipsum dolor sit amet',
                'guest_email' => 'Lorem ipsum dolor sit amet',
                'counsellor_id' => 1,
                'service_id' => 1,
                'appointment_date' => '2024-04-12',
                'start_time' => '11:29:29',
                'end_time' => '11:29:29',
                'appointment_status' => 'Lorem ipsum dolor sit amet',
                'note' => 'Lorem ipsum dolor sit amet, aliquet feugiat. Convallis morbi fringilla gravida, phasellus feugiat dapibus velit nunc, pulvinar eget sollicitudin venenatis cum nullam, vivamus ut a sed, mollitia lectus. Nulla vestibulum massa neque ut et, id hendrerit sit, feugiat in taciti enim proin nibh, tempor dignissim, rhoncus duis vestibulum nunc mattis convallis.',
                'created' => '2024-04-12 11:29:29',
                'modified' => '2024-04-12 11:29:29',
            ],
        ];
        parent::init();
    }
}
