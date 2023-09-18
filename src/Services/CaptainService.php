<?php

namespace App\Services;

use App\Entity\Captain;
use App\Repository\CaptainRepository;
use PHPUnit\Exception;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class CaptainService
{
//    private UserPasswordHasherInterface $userPasswordHasher;
//    private CaptainRepository $captainRepository;

    public function __construct(CaptainRepository $captainRepository, UserPasswordHasherInterface $userPasswordHasher)
    {
//        $this->captainRepository = $captainRepository;
//        $this->userPasswordHasher = $userPasswordHasher;
    }

    /**
     * @param string $captainName
     * @param string $email
     * @param string $password
     * @param string $role
     * @return bool
     */
    public function createCaptain(string $captainName, string $email, string $password, string $role): bool
    {
        $captain = new Captain();
        $captain->setCaptainName($captainName);
        $captain->setEmail($email);
        $captain->setRoles(['ROLE_CAPTAIN']);
        $captain->setPassword($this->userPasswordHasher->hashPassword($captain,$password));

        try{
            $this->captainRepository->save($captain,true);
        }catch (Exception $exception){
            return false;
        }

        return true;
    }
}