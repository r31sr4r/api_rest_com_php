<?php

namespace App\Controller;

use App\Repository\UsuarioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RecuperaSenhaController extends AbstractController
{

    /**
     * @var UsuarioRepository
     */
    private $repository;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        UsuarioRepository $repository,
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->repository = $repository;
        $this->encoder = $encoder;
    }


    /**
     * @Route("/recuperarsenha", name="recuperar_senha")
     */
    public function index(Request $request): Response
    {
        /*
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecuperaSenhaController.php',
        ]);
        */

        $dadosEmJson = json_decode($request->getContent());

        if (is_null($dadosEmJson->email)){
            return new JsonResponse([
                'erro ' => 'Favor enviar o email do usuario'
            ], Response::HTTP_BAD_REQUEST);
        }

        $user = $this->repository->findOneBy([
            'email' => $dadosEmJson->email
        ]);

        if (!is_object($user)){
            return new JsonResponse([
                'erro' => 'Usuario nao encontrado!'
            ], Response::HTTP_NOT_FOUND );
        }

        return new JsonResponse([
            'e-mail' => $dadosEmJson->email,
            'mensagem' => 'Usuario encontrado! Sera enviado um e-mail com instruçoes para recuperaçao de sua senha'
        ]);
    }
}
