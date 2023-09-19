<?php

namespace App\Controller;

use App\Forms\LoginType;
use App\Forms\RegistrationType;
use App\Services\CaptainService;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route('/', name: 'login')]
    public function index(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        if($this->getUser() && in_array('ROLE_CAPTAIN',$this->getUser()->getRoles()) && !($request->headers->get('Turbo-Frame') === 'tf-login')){
            return $this->redirectToRoute('mainView');
        }
        if($this->getUser() && in_array('ROLE_CAPTAIN',$this->getUser()->getRoles()) && ($request->headers->get('Turbo-Frame') === 'tf-login')){
            return $this->render('components/loading.html.twig',['turboId' => 'tf-login']);
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        $registrationForm = $this->createForm(RegistrationType::class, [], ['action' => '/register', 'method' => 'POST',]);
        $loginForm = $this->createForm(LoginType::class, [], [
            'action' => '/',
            'method' => 'POST',
            'attr' => [
                'data-splash-target' => 'loginForm',
            ]]);

        if($request->headers->get('Turbo-Frame') === 'tf-login'){
            return $this->render('components/login.html.twig',[
                'loginForm' => $loginForm,
                'registrationForm' => $registrationForm,
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
        }

        return $this->render('splash.html.twig',[
            'showLoginForm' => false,
            'loginForm' => $loginForm,
            'registrationForm' => $registrationForm,
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
    public function register(CaptainService $captainService, Request $request): Response
    {
        try{
            $success = false;
            $registrationForm = $this->createForm(RegistrationType::class, [], ['action' => '/register', 'method' => 'POST']);

            $registrationForm->handleRequest($request);
            if($registrationForm->isSubmitted() && $registrationForm->isValid()){
                $success = $captainService->createCaptain(
                    $registrationForm->get('captain')->getData(),
                    $registrationForm->get('email')->getData(),
                    $registrationForm->get('password')->getData(),
                    ['ROLE_CAPTAIN']
                );
            }

            $captainName = $registrationForm->get('captain')->getData()??'New Captain';
            $twig = $success?'components/success.html.twig': 'components/register.html.twig';
            return $this->render($twig,['turboId' => 'tf-register','message' => $captainName.', registration complete','registrationForm' => $registrationForm]);
        }catch (Exception $e){
            return $this->render('components/error.html.twig',['turboId' => 'tf-register','message' => 'Could not add captain','registrationForm' => $registrationForm]);
        }
    }
}