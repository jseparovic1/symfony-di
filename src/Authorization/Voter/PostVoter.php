<?php

declare(strict_types=1);

namespace App\Authorization\Voter;

use App\Entity\Post;
use App\Entity\User;
use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerAwareTrait;

final class PostVoter implements VoterInterface, LoggerAwareInterface
{
    use LoggerAwareTrait;

    const READ = 'post_read';

    const WRITE = 'post_write';
    const SUPPORTED_ATTRIBUTES = [
        self::READ,
        self::WRITE,
    ];

    public function vote(string $attribute, $subject, User $user): bool
    {
//        $this->logger->debug(self::class. ' executed!');
//        $this->logger->info('info');
//        $this->logger->notice('notice');
//        $this->logger->warning('warning');
//        $this->logger->error('error');
//        $this->logger->critical('critical');
//        $this->logger->alert('alert');
//        $this->logger->emergency('emergency');

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
