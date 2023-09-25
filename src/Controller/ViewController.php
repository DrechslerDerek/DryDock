<?php

namespace App\Controller;

use App\Entity\Part;
use App\Forms\CreatePartType;
use App\Forms\LoginType;
use App\Forms\RegistrationType;
use App\Services\PartService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/main', name: 'mainView')]
    #[Cache(maxage: 3600, public: true)]
    public function mainView(): Response
    {
        return $this->render('views/main.html.twig', ['view' => 'shipyard']);
    }

    #[Route('/main/shipyard', name: 'shipyardView')]
    #[Cache(maxage: 3600, public: true)]
    public function shipyardView(): Response
    {
        return $this->render('views/shipyard.html.twig', ['view' => 'shipyard']);
    }

    #[Route('/main/view-parts', name: 'partsView')]
    #[Cache(maxage: 3600, public: true)]
    public function partsView(PartService $partService): Response
    {
        return $this->render('views/view-parts.html.twig', [
            'parts' => $partService->getParts(),
            'view' => 'view-parts'
        ]);
    }

    #[Route('/main/create-part', name: 'createPartView')]
    #[Cache(maxage: 3600, public: true)]
    public function createPartView(Request $request, PartService $partService, Security $security): Response
    {
        $createPartForm = $this->createForm(CreatePartType::class, ['part' => new Part()], ['action' => '/main/create-part', 'method' => 'POST']);

        $createPartForm->handleRequest($request);
        if ($createPartForm->isSubmitted() && $createPartForm->isValid()) {
            try {
                $partService->createPart($createPartForm->getData(), $security->getUser());

                return $this->render('components/success.html.twig',
                    [
                        'turboId' => 'tf-create-a-part',
                        'message' => 'Part created.',
                        'link' => [
                            'linkText' => 'Create New Part',
                            'linkHREF' => '/main/create-part'
                        ]
                    ]
                );
            } catch (Exception $e) {
                return $this->render('components/error.html.twig',
                    [
                        'turboId' => 'tf-create-a-part',
                        'message' => 'Database error, part could not be created.',
                        'link' => [
                            'linkText' => 'Try Again',
                            'linkHREF' => '/main/create-part']
                    ]
                );
            }
        }

        return $this->render('views/create-part.html.twig',
            [
                'createPartForm' => $createPartForm,
                'view' => 'create-part'
            ]
        );
    }

    #[Route('/main/build-ship', name: 'buildShipView')]
    #[Cache(maxage: 3600, public: true)]
    public function buildShipView(): Response
    {
        return $this->render('views/build-ship.html.twig', ['view' => 'build-ship']);
    }
}