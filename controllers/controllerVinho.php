<?php
require_once('../models/vinho.php');
require_once ('conecta.php');

class controllerVinho
{
    public function listaVinho()
    {
        $db = new conecta();
        $res=$db->listaVinhos();
        return $res;
    }

    public function buscarVinho($vinho){
        $db = new conecta();
        $res=$db->buscaVinho($vinho);
        return $res;
    }

    public function buscaVinhoID($id)
    {
        $db = new conecta();
        $res = $db->buscaVinhoID($id);
        return $res;
    }

    public function cadastraVinho($nomeVinho, $rotulo, $produtor, $regiao, $preco, $idRegiao, $idTipo, $idEstilo, $idUva, $arrayIDComida)
    {
        $db = new conecta();
        $vinho = new vinho($nomeVinho, $rotulo, $produtor, $regiao, $preco, $idRegiao, $idTipo, $idEstilo, $idUva);
        $res = $db->cadastraVinho($vinho, $arrayIDComida);
        return $res;
    }
}