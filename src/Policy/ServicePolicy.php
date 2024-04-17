<?php
declare(strict_types=1);

namespace App\Policy;

use App\Model\Entity\Service;
use Authorization\IdentityInterface;

/**
 * Service policy
 */
class ServicePolicy
{
    /**
     * Check if $user can add Service
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Service $service
     * @return bool
     */
    public function canAdd(IdentityInterface $user, Service $service)
    {
        return $user->role === 'Admin';

    }

    /**
     * Check if $user can edit Service
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Service $service
     * @return bool
     */
    public function canEdit(IdentityInterface $user, Service $service)
    {
        return $user->role === 'Admin';

    }

    /**
     * Check if $user can delete Service
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Service $service
     * @return bool
     */
    public function canDelete(IdentityInterface $user, Service $service)
    {
        return $user->role === 'Admin';
        

    }

    /**
     * Check if $user can view Service
     *
     * @param \Authorization\IdentityInterface $user The user.
     * @param \App\Model\Entity\Service $service
     * @return bool
     */
    public function canView(IdentityInterface $user, Service $service)
    {
        return true;
    }
}
