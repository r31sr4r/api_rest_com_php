<?php

namespace App\Controller;

use App\Helper\EntidadeFactory;
use App\Helper\ExtratorDadosRequest;
use App\Helper\ResponseFactory;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

abstract class BaseController extends AbstractController
{

    /**
     * @var ObjectRepository
     */
    protected $repository;
    /**
     * @var EntityManagerInterface
     */
    protected $entityManager;
    /**
     * @var EntidadeFactory
     */
    protected $entidadeFactory;
    /**
     * @var ExtratorDadosRequest
     */
    private $extratorDadosRequest;
    /**
     * @var UserPasswordEncoderInterface
     */
    private $encoder;

    public function __construct(
        ObjectRepository $repository,
        EntityManagerInterface $entityManager,
        EntidadeFactory $entidadeFactory,
        ExtratorDadosRequest $extratorDadosRequest,
        UserPasswordEncoderInterface $encoder
    )
    {
        $this->repository = $repository;
        $this->entityManager = $entityManager;
        $this->entidadeFactory = $entidadeFactory;
        $this->extratorDadosRequest = $extratorDadosRequest;
        $this->encoder = $encoder;
    }

    public function Inserir(Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $entity = $this->entidadeFactory->CriarEntidade($corpoRequisicao);

        $encoded = $this->encoder->encodePassword($entity, $entity->getPassword());

        $entity->setPassword($encoded);

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return new JsonResponse($entity);
    }


    public function BuscarTodos(Request $request): Response
    {
        $infOrdenacao = $this->extratorDadosRequest->BuscarDadosOrdenacao($request);
        $infFiltro = $this->extratorDadosRequest->BuscarDadosFiltro($request);
        [$paginaAtual, $itensPorPagina] = $this->extratorDadosRequest->BuscarDadosPaginacao($request);

        $entityList = $this->repository->findBy(
            $infFiltro,
            $infOrdenacao,
            $itensPorPagina,
            ($paginaAtual - 1) * $itensPorPagina
        );

        $fabricaResposta = new ResponseFactory(
            true,
            $entityList,
            Response::HTTP_OK,
            $paginaAtual,
            $itensPorPagina
        );
        return $fabricaResposta->getResponse();
    }

    public function BuscarPorID(int $id): Response
    {
        $entity = $this->repository->find($id);
        $statusResposta = is_null($entity)
            ? Response::HTTP_NO_CONTENT
            : Response::HTTP_OK;
        $fabricaResposta = new ResponseFactory(
            true,
            $entity,
            $statusResposta
        );
        return $fabricaResposta->getResponse();
    }

    public function Excluir(int $id)
    {
        $entity = $this->repository->find($id);
        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return new Response('', Response::HTTP_NO_CONTENT);

    }

    public function Atualizar(int $id, Request $request): Response
    {
        $corpoRequisicao = $request->getContent();
        $entidadeEnviada = $this->entidadeFactory->CriarEntidade($corpoRequisicao);

        try {
            $entidadeExistente = $this->repository->find($id);
            $this->AtualizarEntidadeExistente($entidadeExistente, $entidadeEnviada);
            $this->entityManager->flush();

            $fabrica = new ResponseFactory(
              true,
              $entidadeExistente,
              Response::HTTP_OK
            );

            return $fabrica->getResponse();

        } catch (\InvalidArgumentException $ex) {
            $fabrica = new ResponseFactory(
                false,
                'Recurso nao encontrado',
                Response::HTTP_NOT_FOUND
            );
            return $fabrica->getResponse();
        }


    }

    abstract public function AtualizarEntidadeExistente(
        $entidadeExistente,
        $entidadeEnviada
    );


}