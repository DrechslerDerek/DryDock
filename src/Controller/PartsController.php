<?php

namespace App\Controller;

use App\Forms\CreatePartType;
use App\Services\PartService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

class PartsController extends AbstractController
{
    #[Route('/main/edit-part/{partId}', name: 'editPart')]
    #[Cache(maxage: 3600, public: true)]
    public function editPart(int $partId, Request $request, PartService $partService, Security $security): Response
    {
        $part = $partService->getPartById($partId);
        $editPartForm = $this->createForm(CreatePartType::class, ['part' => $part], ['action' => '/main/edit-part/'.$partId, 'method' => 'POST']);

        $editPartForm->handleRequest($request);
        if ($editPartForm->isSubmitted() && $editPartForm->isValid()) {
            try {
                $partService->updatePart($editPartForm->getData(), $part);
                return $this->render('components/success.html.twig',
                    [
                        'turboId' => 'tf-edit-part',
                        'message' => 'Part updated.',
                    ]
                );
            } catch (Exception $e) {
                return $this->render('components/error.html.twig',
                    [
                        'turboId' => 'tf-edit-part',
                        'message' => 'Database error, part could not be updated.',
                    ]
                );
            }
        }

        return $this->render('components/parts/edit-part.html.twig',
            [
                'editPartForm' => $editPartForm,
            ]
        );
    }
}