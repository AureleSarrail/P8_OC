<?php

namespace App\Security\Voter;

use App\Entity\Task;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\User\UserInterface;

class TaskDeleteVoter extends Voter
{
    protected function supports($attribute, $subject)
    {
        // replace with your own logic
        // https://symfony.com/doc/current/security/voters.html
        return in_array($attribute, ['DELETE_TASK', 'ANONYMOUS_DELETE'])
            && $subject instanceof Task;
    }

    protected function voteOnAttribute($attribute, $subject, TokenInterface $token)
    {
        $user = $token->getUser();
        // if the user is anonymous, do not grant access
        if (!$user instanceof UserInterface) {
            return false;
        }

        $roles = $user->getRoles();

        // ... (check conditions and return true to grant permission) ...
        switch ($attribute) {
            case 'DELETE_TASK':
                if ($user === $subject->getUser()) {
                    return true;
                } elseif ($roles[0] === 'ROLE_ADMIN' && $subject->getUser()->getUsername() === 'Anonymous'){
                    return true;
                }
                break;
        }

        return false;
    }
}
