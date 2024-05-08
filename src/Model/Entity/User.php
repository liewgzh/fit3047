<?php
declare(strict_types=1);

namespace App\Model\Entity;
use Authentication\PasswordHasher\DefaultPasswordHasher; // Add this line to the doc


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


    protected function _setPassword(string $password) : ?string
    {
        if (strlen($password) > 0) {
            return (new DefaultPasswordHasher())->hash($password);
        }
        return $password;


    }
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
        'image_path' => true,
        'bio' => true,
        'created' => true,
        'modified' => true,
        'client_appointments' => true,
        'nonce' => false, // Nonce and expiry dates are to be set in Controller directly, not through patching
        'nonce_expiry' => false,
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
    /**
     * Generate display field for User entity
     *
     * @return string Display field
     * @see \App\Model\Entity\User::$user_full_display
     */
    protected function _getUserFullDisplay(): string
    {
        return $this->first_name . ' ' . $this->last_name . ' (' . $this->email . ')';
    }

    /**
     * Generate Full Name of a user
     *
     * @return string Full Name
     * @see \App\Model\Entity\User::$full_name
     */
    protected function _getFullName(): string
    {
        return $this->first_name . ' ' . $this->last_name;
    }



}
