<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserHelper
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function isPasswordValid(User $user, string $password): Bool
    {
        return $this->passwordEncoder->isPasswordValid($user, $password);
    }
}
