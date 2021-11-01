<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UsuarioRepository::class)
 */
class Usuario implements \JsonSerializable
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cpf;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $rg;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $senha;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNome(): ?string
    {
        return $this->nome;
    }

    public function setNome(string $nome): ?self
    {
        $this->nome = $nome;
        return $this;
    }

    public function getCpf(): ?string
    {
        return $this->cpf;
    }

    public function setCpf(string $cpf): ?self
    {
        $this->cpf = $cpf;
        return $this;
    }

    public function getRg(): ?string
    {
        return $this->rg;
    }

    public function setRg(string $rg): ?self
    {
        $this->rg = $rg;
        return $this;
    }

    public function getSenha(): ?string
    {
        return $this->senha;
    }

    public function setSenha(string $senha): ?self
    {
        $this->senha = $senha;
        return $this;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'nome' => $this->getNome(),
            'cpf' => $this->getCpf(),
            'rg' => $this->getRg(),
            'senha' => $this->getSenha(),
            '_links' => [
                'rel' => 'self',
                'path' => '/usuarios/' . $this->getId()
            ]
        ];
    }
}