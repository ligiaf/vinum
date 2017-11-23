<?php

ORM::configure('mysql:host=localhost;dbname=vinum');
ORM::configure('username', 'root');
ORM::configure('password', '');

class conecta
{
    public function cadastraUsuario(usuario $usuario)
    {
        $usuarioDB = ORM::for_table('usuario')->create();

        $usuarioDB->nome = $usuario->getNome();
        $usuarioDB->email = $usuario->getEmail();
        $usuarioDB->foto = NULL;
        $usuarioDB->senha = $usuario->getSenha();
        $usuarioDB->save();
    }

    public function buscaUsuarioEmail($email)
    {
        $usuario = ORM::for_table('usuario')->where('email',$email)->find_one();
        return $usuario['ID_usuario'];
    }

    public function buscaUsuarioID($id)
    {
        $usuario = ORM::for_table('usuario')->where('ID_usuario',$id)->find_one();
        return $usuario;
    }
}
