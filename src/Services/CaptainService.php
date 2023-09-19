<?php

namespace App\Services;

use App\Entity\Captain;
use App\Repository\CaptainRepository;
use Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CaptainService
{
    private UserPasswordHasherInterface $userPasswordHasher;
    private CaptainRepository $captainRepository;

    public function __construct(CaptainRepository $captainRepository, UserPasswordHasherInterface $userPasswordHasher)
    {
        $this->captainRepository = $captainRepository;
        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param string $captainName
     * @param string $email
     * @param string $password
     * @param array<string> $roles
     * @return bool
     */
    public function createCaptain(string $captainName, string $email, string $password, array $roles): bool
    {
        $captain = new Captain();
        $captain->setCaptainName($captainName);
        $captain->setEmail($email);
        $captain->setRoles($roles);
        $captain->setPassword($this->userPasswordHasher->hashPassword($captain,$password));

        try{
            $this->captainRepository->save($captain,true);
        }catch (Exception $exception){
            return false;
        }

        return true;
    }
}