<?php

namespace App\Controller;

use App\Forms\LoginType;
use App\Forms\RegistrationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\Cache;
use Symfony\Component\Routing\Annotation\Route;

class ViewController extends AbstractController
{
    #[Route('/', name: 'splash')]
    #[Cache(maxage: 3600, public: true)]
    public function splash(): Response
    {
        $registrationForm = $this->createForm(RegistrationType::class, [], ['action' => '/register', 'method' => 'POST']);
        $loginForm = $this->createForm(LoginType::class, [], ['action' => '/login', 'method' => 'POST','attr' => ['data-splash-target' => 'loginForm']]);

        return $this->render('splash.html.twig',[
            'showLoginForm' => false,
            'loginForm' => $loginForm,
            'registrationForm' => $registrationForm
        ]);
    }

    #[Route('/main', name: 'mainView')]
    #[Cache(maxage: 3600, public: true)]
    public function mainView(): Response
    {
        return $this->render('views/main.html.twig',['view' => 'shipyard']);
    }

    #[Route('/main/shipyard', name: 'shipyardView')]
    #[Cache(maxage: 3600, public: true)]
    public function shipyardView(): Response
    {
        return $this->render('views/shipyard.html.twig',['view' => 'shipyard']);
    }

    #[Route('/main/view-parts', name: 'partsView')]
    #[Cache(maxage: 3600, public: true)]
    public function partsView(): Response
    {
        return $this->render('views/view-parts.html.twig',['view' => 'view-parts']);
    }

    #[Route('/main/create-part', name: 'createPartView')]
    #[Cache(maxage: 3600, public: true)]
    public function createPartView(): Response
    {
        return $this->render('views/create-part.html.twig',['view' => 'create-part']);
    }

    #[Route('/main/build-ship', name: 'buildShipView')]
    #[Cache(maxage: 3600, public: true)]
    public function buildShipView(): Response
    {
        return $this->render('views/build-ship.html.twig',['view' => 'build-ship']);
    }
}