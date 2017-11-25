<?php
require_once('../models/usuario.php');
require_once ('conecta.php');

class controllerUsuario
{
    public function cadastraUsuario($nome, $email, $senha)
    {
        $db = new conecta();
        $usuario = new usuario($nome, $email, $senha);
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

    public function addMeuVinho($idUsuario, $vinho, $rotulo)
    {
        $db = new conecta();
        $db->addMeuVinho($idUsuario, $vinho, $rotulo);

    }

    public function buscaMeusVinhos($id)
    {
        $db = new conecta();
        $res = $db->buscaMeusVinhos($id);
        return $res;
    }


}