<?php

declare(strict_types=1);

namespace App\Authorization\Voter;

use App\Entity\Post;
use App\Entity\User;

final class PostVoter implements VoterInterface
{
    const READ = 'post_read';
    const WRITE = 'post_write';

    const SUPPORTED_ATTRIBUTES = [
        self::READ,
        self::WRITE,
    ];

    public function vote(string $attribute, $subject, User $user): bool
    {
        switch ($attribute) {
            case self::READ:
                return $user->hasRole(User::ROLE_USER);
            case self::WRITE:
                return $user->hasRole(User::ROLE_ADMIN);
                break;
            default:
                throw new \LogicException(sprintf('Attribute "%s" is not supported.', $attribute));
        }
    }

    public function supports(string $attribute, $subject, User $user): bool
    {
        return in_array($attribute, self::SUPPORTED_ATTRIBUTES) && $subject instanceof Post;
    }
}
