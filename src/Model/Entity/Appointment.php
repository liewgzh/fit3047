<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Appointment Entity
 *
 * @property int $id
 * @property int|null $client_id
 * @property string|null $guest_name
 * @property string|null $guest_email
 * @property int $counsellor_id
 * @property int $service_id
 * @property \Cake\I18n\Date $appoinment_date
 * @property \Cake\I18n\Time $appoinment_time
 * @property \Cake\I18n\Time $end_time
 * @property string|null $appoinment_status
 * @property string|null $note
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\User $user
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
        'guest_name' => true,
        'guest_email' => true,
        'counsellor_id' => true,
        'service_id' => true,
        'appoinment_date' => true,
        'appoinment_time' => true,
        'end_time' => true,
        'appoinment_status' => true,
        'note' => true,
        'created' => true,
        'modified' => true,
        'user' => true,
        'service' => true,
    ];
}
