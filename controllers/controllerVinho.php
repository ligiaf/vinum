<?php
include 'conecta.php';

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

}