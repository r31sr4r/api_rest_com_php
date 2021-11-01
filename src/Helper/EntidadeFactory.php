<?php

namespace App\Helper;

interface EntidadeFactory
{
    public function CriarEntidade(string $json);
}