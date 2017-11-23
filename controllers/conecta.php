<?php

ORM::configure('mysql:host=localhost;dbname=vinum');
ORM::configure('username', 'root');
ORM::configure('password', '');

require_once ('../models/usuario.php');

class conecta
{
    public function cadastraUsuario(usuario $usuario)
    {
        if($usuarioDB = ORM::for_table('usuario')->where('email',$usuario->getEmail())->find_one())
        {
            return false;
        }
        else{
            $usuarioDB = ORM::for_table('usuario')->create();
            $usuarioDB->nome = $usuario->getNome();
            $usuarioDB->email = $usuario->getEmail();
            $usuarioDB->foto = '';
            $usuarioDB->senha = $usuario->getSenha();
            $usuarioDB->save();
            return true;
        }
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

    public function autenticaUsuario($email, $senha)
    {
        $usuario = ORM::for_table('usuario')->where(array('email' => $email, 'senha' => $senha))->find_one();
        return $usuario['ID_usuario'];
    }

    // VINHOS

    public function listaVinhos()
    {
        $vinhos = ORM::for_table('vinho')->find_many();
        return $vinhos;
    }

    public function buscaVinho($vinho){
        $vinhoBD = ORM::for_table('vinho')->where('nome', $vinho)->find_one();
        $vinho_tipo = ORM::for_table('tipo_vinho')->where('ID_tipo', $vinhoBD['ID_tipo'])->find_one();
        $vinho_estilo = ORM::for_table('estilo')->where('ID_estilo', $vinhoBD['ID_estilo'])->find_one();
        $vinho_regiao = ORM::for_table('regiao')->where('ID_regiao', $vinhoBD['ID_regiao'])->find_one();

        $vinhoBD['ID_tipo'] = $vinho_tipo['nome'];
        $vinhoBD['ID_estilo'] = $vinho_estilo['nome'];
        $vinhoBD['ID_regiao'] = $vinho_regiao['nome'];

        return $vinhoBD;
    }

    public function verificaMeusVinhos($idUsuario, $vinho)
    {
        $meusvinhos = ORM::for_table('usuario_vinhos')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $vinho))->find_one();
        if($meusvinhos)
        {
            return false;
        }
        else return true;
    }

    public function addMeuVinho($idUsuario, $vinho, $rotulo)
    {
        $meusVinhos = ORM::for_table('usuario_vinhos')->create();
        $meusVinhos->ID_usuario = $idUsuario;
        $meusVinhos->ID_vinho = $vinho;
        $meusVinhos->rotulo = $rotulo;
        $meusVinhos->save();
    }


}
