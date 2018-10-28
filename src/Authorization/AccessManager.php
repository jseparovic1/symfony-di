<?php

declare(strict_types=1);

namespace App\Authorization;

use App\Authorization\Voter\VoterInterface;
use App\Entity\User;

final class AccessManager
{
    /**
     * @var VoterInterface[]
     */
    private $voters;

    public function decide(string $attribute, $subject, User $user): bool
    {
        foreach ($this->voters as $voter) {
            if ($voter->supports($attribute, $subject, $user)) {
                return $voter->vote($attribute, $subject, $user);
            }
        }

        throw new \LogicException('No voter can handle this resource.');
    }

    public function addVoter(VoterInterface $voter)
    {
        $this->voters[] = $voter;
    }
}
