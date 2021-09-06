<?php

namespace App\Security;

use App\Entity\User as AppUser;
use Symfony\Component\Security\Core\Exception\LockedException;
use Symfony\Component\Security\Core\User\UserCheckerInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class UserChecker
 * @package App\Security
 */
class UserChecker implements UserCheckerInterface
{
    /**
     * @param UserInterface $user
     */
    public function checkPreAuth(UserInterface $user) : void
    {
        if (!$user instanceof AppUser) {
            return;
        }
        // User checker block the authentification if status is "en attente" or "desactivate"
        if ($user->getStatus() == 'en attente' || $user->getStatus() == 'desactive') {
            throw new LockedException();
        }
    }

    /**
     * @param UserInterface $user
     */
    public function checkPostAuth(UserInterface $user) : void
    {

    }

}

