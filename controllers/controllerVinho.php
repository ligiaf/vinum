<?php
require_once '../vendor/autoload.php';
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
        $vinho = new classes\vinho($nomeVinho, $rotulo, $produtor, $regiao, $preco, $idRegiao, $idTipo, $idEstilo, $idUva);
        $res = $db->cadastraVinho($vinho, $arrayIDComida);
        return $res;
    }

    public function buscaComidasVinho($idVinho)
    {
        $db = new conecta();
        $res = $db->buscaComidasVinho($idVinho);
        return $res;
    }
    public function buscaResenhaVinho($idVinho)
    {
        $db = new conecta();
        $res = $db->buscaResenhaVinho($idVinho);
        return $res;
    }

    public function calculaEstrelas($idVinho)
    {
        $db = new conecta();
        $res = $db->calculaEstrelas($idVinho);
        return $res;
    }

    public function addHarmonizacao($idVinho, $idComida)
    {
        $db = new conecta();
        $db->addHarmonizacao($idVinho, $idComida);
    }

    public function verificaHarmonizacao($idVinho, $idComida)
    {
        $db = new conecta();
        $res = $db->verificaHarmonizacao($idVinho, $idComida);
        return $res;
    }

    public function buscaUsuario()
    {
        $db = new conecta();
        $res = $db->buscaUsuario();
        return $res;
    }

    public function buscarVinhosTotal($estrela, $preco_min, $preco_max, $regiao=array(), $estilo=array(), $tipo_vinho=array(), $tipo_uva=array(), $harmonizacao=array()){
        $db = new conecta();
        $res = $db->buscaVinhosTotal($estrela, $preco_min, $preco_max, $regiao, $estilo, $tipo_vinho, $tipo_uva, $harmonizacao);
        return $res;
    }

}