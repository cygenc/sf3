<?php

namespace App\Service\User;

use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function setPassword(User $user, string $password): User
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $password));

        return $user;
    }
}
