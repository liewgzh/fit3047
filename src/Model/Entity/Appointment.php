<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property int $client_id
 * @property int $counsellor_id
 * @property int $service_id
 * @property \Cake\I18n\DateTime $appoinment_date_time
 * @property int $duration
 * @property string|null $appoinment_status
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Client $client
 * @property \App\Model\Entity\Counsellor $counsellor
 * @property \App\Model\Entity\Service $service
 */
class Appointment extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'client_id' => true,
        'counsellor_id' => true,
        'service_id' => true,
        'appoinment_date_time' => true,
        'duration' => true,
        'appoinment_status' => true,
        'created' => true,
        'modified' => true,
        'client' => true,
        'counsellor' => true,
        'service' => true,
    ];
}
