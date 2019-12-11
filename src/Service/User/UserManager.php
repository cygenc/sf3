<?php

namespace App\Service\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserManager
{
    private $passwordEncoder;
    private $userRepository;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        $this->passwordEncoder = $passwordEncoder;
        $this->userRepository  = $userRepository;
    }

    public function setPassword(User $user, string $password): User
    {
        $newEncodedPassword = $this->passwordEncoder->encodePassword($user, $password);
        $this->userRepository->upgradePassword($user, $newEncodedPassword);

        return $user;
    }
}
