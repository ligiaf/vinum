<?php
require_once('../models/usuario.php');
include 'conecta.php';

class controllerUsuario
{
    public function cadastraUsuario($nome, $email, $senha)
    {
        $db = new conecta();
        $usuario = new usuario($nome, $email, $senha);
        $db->cadastraUsuario($usuario);
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
}
