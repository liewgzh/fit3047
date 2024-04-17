<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Appointment;
use Authorization\IdentityInterface;

/**
 * Appointment policy
 */
class AppointmentPolicy
{
    /**
     * Check if $user can add Appointment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Appointment $appointment
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Appointment $appointment)
    {
        return true;

    }

    /**
     * Check if $user can edit Appointment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Appointment $appointment
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Appointment $appointment)
    {
        $isOwner = $user->id === $appointment->client_id;
        
        // Checks if the user is an admin
        $isStaff = $user->role === 'Admin';
        
        // Checks if the user is the counsellor assigned to the appointment
        $isCounsellor = $user->id === $appointment->counsellor_id;

        // Allow edit if the user is the owner, an admin, or the assigned counsellor
        return $isOwner || $isStaff || $isCounsellor;
    }
    

    /**
     * Check if $user can delete Appointment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Appointment $appointment
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Appointment $appointment)
    {
        $isOwner = $user->id === $appointment->client_id;
        
        // Checks if the user is an admin
        $isStaff = $user->role === 'Admin';
        
        // Checks if the user is the counsellor assigned to the appointment
        $isCounsellor = $user->id === $appointment->counsellor_id;

        // Allow edit if the user is the owner, an admin, or the assigned counsellor
        return $isOwner || $isStaff || $isCounsellor;
    }

    /**
     * Check if $user can view Appointment
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Appointment $appointment
     * @return bool
     */
    public function canView(IdentityInterface $user, Appointment $appointment)
    {

}
}