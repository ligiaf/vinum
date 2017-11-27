<?php
require_once '../vendor/autoload.php';
require_once ('conecta.php');

class controllerResenha
{
    public function cadastraResenha($idUsuario, $idVinho, $resenha, $datahora)
    {
        $db = new conecta();
        $resenha = new classes\resenha($idUsuario, $idVinho, $resenha, $datahora);
        $db->cadastraResenha($resenha);
    }

    public function verificaResenha($idUsuario, $idVinho)
    {
        $db = new conecta();
        $res = $db->verificaResenha($idUsuario, $idVinho);
        return $res;
    }
}
