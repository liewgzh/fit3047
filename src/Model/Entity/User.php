<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * User Entity
 *
 * @property int $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $password
 * @property string|null $role
 * @property string|null $gender
 * @property \Cake\I18n\Date $date_of_birth
 * @property string $phone_number
 * @property string $address
 * @property string|null $bio
 * @property \Cake\I18n\DateTime|null $created
 * @property \Cake\I18n\DateTime|null $modified
 *
 * @property \App\Model\Entity\Appointment[] $client_appointments
 * @property \App\Model\Entity\Appointment[] $counsellor_appointments
 */
class User extends Entity
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
        'first_name' => true,
        'last_name' => true,
        'email' => true,
        'password' => true,
        'role' => true,
        'gender' => true,
        'date_of_birth' => true,
        'phone_number' => true,
        'address' => true,
        'bio' => true,
        'created' => true,
        'modified' => true,
        'client_appointments' => true,
        'counsellor_appointments' => true,
    ];

    /**
     * Fields that are excluded from JSON versions of the entity.
     *
     * @var list<string>
     */
    protected array $_hidden = [
        'password',
    ];
}
