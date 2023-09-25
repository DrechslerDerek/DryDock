<?php

namespace App\Services;

use App\Entity\Captain;
use App\Entity\Part;
use App\Repository\PartRepository;
use Symfony\Component\Security\Core\User\UserInterface;

class PartService
{
    private CaptainService $captainService;
    private PartRepository $partRepository;

    /**
     * @param CaptainService $captainService
     * @param PartRepository $partRepository
     */
    public function __construct(CaptainService $captainService, PartRepository $partRepository)
    {
        $this->captainService = $captainService;
        $this->partRepository = $partRepository;
    }

    /**
     * @param mixed $data
     * @param UserInterface $user
     * @return Part
     */
    public function createPart(mixed $data, UserInterface $user): Part
    {
        $captain = $this->captainService->getByEmail($user->getUserIdentifier());
        return $this->setPartFields($data, new Part(), $captain);
    }

    /**
     * @param mixed $data
     * @param Part $part
     * @return Part
     */
    public function updatePart(mixed $data, Part $part): Part
    {
        return $this->setPartFields($data, $part);
    }

    /**
     * @return array<Part>
     */
    public function getParts(): array
    {
        return $this->partRepository->findAll();
    }

    /**
     * @param int $id
     * @return Part
     */
    public function getPartById(int $id): Part
    {
        return $this->partRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param mixed $data
     * @param Part $part
     * @param Captain|null $captain
     * @return Part
     */
    private function setPartFields(mixed $data, Part $part, Captain $captain = null): Part
    {
        $part->setCategory($data['partCategory']);
        $part->setOrigin($data['partOrigin']);
        $part->setName($data['partName']);
        $part->setDescription($data['partDescription']);
        $part->setCost($data['partCost']);
        $part->setDurability($data['partDurability']);
        $part->setPower($data['partPower']);

        if(isset($captain)){
            $part->setCreator($captain);
        }

        $this->partRepository->save($part, true);

        return $part;
    }
}