<?php

namespace App\Helper;

use Symfony\Component\HttpFoundation\Request;

class ExtratorDadosRequest
{

    private function BuscarDadosRequest(Request $request)
    {
        $queryString = $request->query->all();
        $infOrdenacao = array_key_exists('sort', $queryString)
            ? $queryString['sort']
            : null;
        unset($queryString['sort']);

        $paginaAtual = array_key_exists('page', $queryString)
            ? $queryString['page']
            : 1;
        unset($queryString['page']);

        $itensPorPagina = array_key_exists('itensPorPagina', $queryString)
            ? $queryString['itensPorPagina']
            : 5;
        unset($queryString['itensPorPagina']);


        return[$infOrdenacao, $queryString, $paginaAtual, $itensPorPagina];
    }
    
    public function BuscarDadosOrdenacao(Request $request)
    {
        [$infOrdenacao, ] = $this->BuscarDadosRequest($request);

        return $infOrdenacao;
    }

    public function BuscarDadosFiltro(Request $request)
    {
        [, $infFiltro] = $this->BuscarDadosRequest($request);

        return $infFiltro;
    }

    public function BuscarDadosPaginacao(Request $request)
    {
        [, , $paginaAtual, $itensPorPagina] = $this->BuscarDadosRequest($request);

        return [$paginaAtual, $itensPorPagina];
    }
}