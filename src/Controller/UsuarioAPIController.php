<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Entity\UsuarioAPI;
use App\Repository\UsuarioAPIRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UsuarioAPIController extends AbstractController
{

    /**
     * @var UsuarioAPIRepository
     */
    private $repository;

    public function __construct(
        EntityManagerInterface $entityManager,
        UsuarioAPIRepository $repository
    )
    {
        $this->entityManager = $entityManager;
        $this->repository = $repository;
    }


    /**
     * @Route("/usuarioAPI", methods={"POST"})
     */
    public function Inserir(Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $dadosJason = json_decode($corpoRequisicao);

        $usuario = new UsuarioAPI();
        $usuario->setNome($dadosJason->nome);
        $usuario->setCpf($dadosJason->cpf);
        $usuario->setRg($dadosJason->rg);
        $usuario->setSenha($dadosJason->senha);

        $this->entityManager->persist($usuario);
        $this->entityManager->flush();

        return new JsonResponse($usuario);
    }

    /**
     * @Route("/usuarioAPI", methods={"GET"})
     */
    public function BuscarTodos(): Response
    {

        $usuarioList = $this->repository->findAll();

        return new JsonResponse($usuarioList);
    }

    /**
     * @Route ("/usuarioAPI/{id}", methods={"GET"})
     */
    public function BuscarUsuarioID(int $id): Response
    {
        return new JsonResponse($this->repository->find($id));
    }

    /**
     * @Route ("/usuarioAPI/{id}", methods={"PUT"})
     */
    public function Atualizar(int $id, Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $dadosJason = json_decode($corpoRequisicao);

        $usuario = $this->repository->find($id);

        $usuario
            ->setNome($dadosJason->nome)
            ->setCpf($dadosJason->cpf)
            ->setRg($dadosJason->rg)
            ->setSenha($dadosJason->senha);

        $this->entityManager->flush();

        return new JsonResponse($usuario);

    }

    /**
     * @param int $id
     * @return Response
     * @Route ("/usuarioAPI/{id}", methods={"DELETE"})
     */
    public function ExcluirUsuario(int $id)
    {
        $usuario = $this->repository->find($id);
        $this->entityManager->remove($usuario);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);

    }


}
