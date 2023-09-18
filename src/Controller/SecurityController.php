<?php

namespace App\Controller;

use App\Services\CaptainService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{

    #[Route('/login', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

          return $this->render('login/index.html.twig', [
              'controller_name' => 'LoginController',
              'last_username' => $lastUsername,
              'error'         => $error,
          ]);
    }

    #[Route('/logout', name: 'logout', methods: ['GET'])]
    public function logout(): RedirectResponse
    {
       return $this->redirectToRoute('splash');
    }

    #[Route('/register', name: 'register')]
    public function register(CaptainService $captainService): Response
    {

        $captainName = 'test';
//        return $this->render('register.html.twig', []);
        return $this->render('components/success.html.twig',['turboId' => 'tf-register','message' => $captainName.' registration complete']);
    }
}