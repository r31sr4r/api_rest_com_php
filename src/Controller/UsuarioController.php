<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Helper\ExtratorDadosRequest;
use App\Helper\UsuarioFactory;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;


class UsuarioController extends BaseController
{

    public function __construct(
        EntityManagerInterface $entityManager,
        UsuarioFactory $usuarioFactory,
        UsuarioRepository $repository,
        ExtratorDadosRequest $extratorDadosRequest
    )
    {
        parent::__construct($repository, $entityManager, $usuarioFactory, $extratorDadosRequest);
    }


    /**
     * @param Usuario $entidadeExistente
     * @param Usuario $entidadeEnviada
     */
    public function AtualizarEntidadeExistente($entidadeExistente, $entidadeEnviada)
    {
        if (is_null($entidadeExistente)){
            throw new \InvalidArgumentException();
        }

        $entidadeExistente
            ->setNome($entidadeEnviada->getNome())
            ->setCpf($entidadeEnviada->getCpf())
            ->setRg($entidadeEnviada->getRg())
            ->setSenha($entidadeEnviada->getSenha());
    }

}