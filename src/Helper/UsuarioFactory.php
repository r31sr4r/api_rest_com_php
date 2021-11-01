<?php

namespace App\Helper;

use App\Entity\Usuario;
use function Sodium\crypto_pwhash;

class UsuarioFactory implements EntidadeFactory
{
    public function CriarEntidade(string $json) : Usuario
    {
        $usuarioEmJson = json_decode($json);

        $usuario = new Usuario();
        $usuario
            ->setNome($usuarioEmJson->nome)
            ->setCpf($usuarioEmJson->cpf)
            ->setRg($usuarioEmJson->rg)
            ->setSenha($usuarioEmJson->senha);

        return $usuario;
    }
}