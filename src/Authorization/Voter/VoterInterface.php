<?php declare(strict_types=1);

namespace App\Authorization\Voter;

use App\Entity\User;

interface VoterInterface
{
    public function vote(string $attribute, $subject, User $user): bool;

    public function supports(string $attribute, $subject, User $user): bool;
}
