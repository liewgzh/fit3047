<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\User;
use Authorization\IdentityInterface;

/**
 * User policy
 */
class UserPolicy
{
    /**
     * Check if $user can add User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canAdd(IdentityInterface $user, User $resource)
    {
        $isStaff = $user->role === 'Admin';
        return  $isStaff;
    }

    /**
     * Check if $user can edit User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canEdit(IdentityInterface $user, User $resource)
    {       
            $isOwner = $user->id === $resource->id;
            $isStaff = $user->role === 'Admin';
            return $isOwner || $isStaff;

    }

    /**
     * Check if $user can delete User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canDelete(IdentityInterface $user, User $resource)
    {

        
            // Prevent deleting the user with ID 1
            if ($resource->first_name === "admin" || $resource->first_name === "Admin") {
                return false;
            }


        $isOwner = $user->id === $resource->id;
        $isStaff = $user->role === 'Admin';
        return $isOwner || $isStaff;
    }

    /**
     * Check if $user can view User
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\User $resource
     * @return bool
     */
    public function canView(IdentityInterface $user, User $resource)
    {
        $isOwner = $user->id === $resource->id;
        $isStaff = $user->role === 'Admin';
        return $isOwner || $isStaff;
    }
    public function canChangePassword(IdentityInterface $user, User $resource)
    {
        $isOwner = $user->id === $resource->id;
        $isStaff = $user->role === 'Admin';
        return $isOwner || $isStaff;
    }


}
