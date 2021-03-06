<?php

require_once 'conecta.php';
require_once '../vendor/autoload.php';

class controllerUsuario
{
    public function cadastraUsuario($nome, $email, $senha)
    {
        $db = new conecta();
        $usuario = new classes\usuario($nome, $email, $senha);
        $res = $db->cadastraUsuario($usuario);
        return $res;
    }

    public function buscaUsuarioEmail($email)
    {
        $db = new conecta();
        $res = $db->buscaUsuarioEmail($email);
        return $res;
    }

    public function buscaUsuarioID($id)
    {
        $db = new conecta();
        $res = $db->buscaUsuarioID($id);
        return $res;
    }

    public function autenticaUsuario($email, $senha)
    {
        $db = new conecta();
        $res = $db->autenticaUsuario($email, $senha);
        return $res;
    }

    public function verificaMeusVinhos($idUsuario, $vinho)
    {
        $db = new conecta();
        $res = $db->verificaMeusVinhos($idUsuario, $vinho);
        return $res;
    }

    public function addMeuVinho($idUsuario, $vinho)
    {
        $db = new conecta();
        $db->addMeuVinho($idUsuario, $vinho);
    }

    public function buscaMeusVinhos($id)
    {
        $db = new conecta();
        $res = $db->buscaMeusVinhos($id);
        return $res;
    }

    public function buscaResenhaUsuario($idUsuario)
    {
        $db = new conecta();
        $res = $db->buscaResenhaUsuario($idUsuario);
        return $res;
    }

    public function buscaAvaliacaoUsuario($idUsuario, $idVinho)
    {
        $db = new conecta();
        $res = $db->buscaAvaliacaoUsuario($idUsuario, $idVinho);
        return $res;
    }

    public function verificaAvaliacao($idUsuario, $idVinho)
    {
        $db = new conecta();
        $res = $db->verificaAvaliacao($idUsuario, $idVinho);
        return $res;
    }

    public function avaliar($idUsuario, $idVinho, $nota)
    {
        $db = new conecta();
        $db->avaliar($idUsuario, $idVinho, $nota);
    }

    public function alteraAvaliacao($idUsuario, $idVinho, $nota)
    {
        $db = new conecta();
        $db->alteraAvaliacao($idUsuario, $idVinho, $nota);
    }

}