<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
//    #[Route('/', name: 'splash')]
//    #[Cache(maxage: 3600, public: true)]
//    public function splash(): Response
//    {
//        return $this->render('',[]);
//    }

    #[Route('/shipyard', name: 'shipyardView')]
    #[Cache(maxage: 3600, public: true)]
    public function shipyardView(): Response
    {
        return $this->render('views/shipyard.html.twig',['view' => 'shipyard']);
    }
}