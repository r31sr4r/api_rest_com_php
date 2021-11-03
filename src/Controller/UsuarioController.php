<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Helper\ExtratorDadosRequest;
use App\Helper\UsuarioFactory;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UsuarioController extends BaseController
{

    public function __construct(
        EntityManagerInterface $entityManager,
        UsuarioFactory $usuarioFactory,
        UsuarioRepository $repository,
        ExtratorDadosRequest $extratorDadosRequest,
        UserPasswordEncoderInterface $encoder
    )
    {
        parent::__construct($repository, $entityManager, $usuarioFactory, $extratorDadosRequest, $encoder);
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
            ->setUsername($entidadeEnviada->getUsername())
            ->setCpf($entidadeEnviada->getCpf())
            ->setRg($entidadeEnviada->getRg())
            ->setEmail($entidadeEnviada->getEmail());
            //->setPassword($entidadeEnviada->getPassword());
    }

}