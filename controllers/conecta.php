<?php
ORM::configure('mysql:host=localhost;dbname=vinum');
ORM::configure('username', 'root');
ORM::configure('password', '');

require_once '../vendor/autoload.php';


class conecta
{
    public function cadastraUsuario(classes\usuario $usuario)
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

    public function buscaVinhoID($id)
    {
        $vinho= ORM::for_table('vinho')->where('ID_vinho', $id)->find_one();
        $vinho_tipo = ORM::for_table('tipo_vinho')->where('ID_tipo', $vinho['ID_tipo'])->find_one();
        $vinho_estilo = ORM::for_table('estilo')->where('ID_estilo', $vinho['ID_estilo'])->find_one();
        $vinho_regiao = ORM::for_table('regiao')->where('ID_regiao', $vinho['ID_regiao'])->find_one();
        $vinho_uva = ORM::for_table('uva')->where('ID_uva', $vinho['ID_uva'])->find_one();

        $vinho['ID_tipo'] = $vinho_tipo['nome'];
        $vinho['ID_estilo'] = $vinho_estilo['nome'];
        $vinho['ID_regiao'] = $vinho_regiao['nome'];
        $vinho['ID_uva'] = $vinho_uva['tipo'];

        return $vinho;
    }

    public function cadastraVinho(classes\vinho $vinho, $arrayComidas)
    {
        $addvinho = ORM::for_table('vinho')->create();
        $addvinho->nome = $vinho->getNome();
        $addvinho->rotulo = $vinho->getRotulo();
        $addvinho->produtor = $vinho->getProdutor();
        $addvinho->regiao = $vinho->getRegiao();
        $addvinho->preco = $vinho->getPreco();
        $addvinho->ID_regiao = $vinho->getIdRegiao();
        $addvinho->ID_tipo = $vinho->getIdTipo();
        $addvinho->ID_estilo = $vinho->getIdEstilo();
        $addvinho->ID_uva = $vinho->getIdUva();
        $addvinho->save();

        $idUsuario = $this->buscaUsuarioEmail($_SESSION['email']);
        $res = $this->buscaVinho($vinho->getNome());
        $this->addMeuVinho($idUsuario, $res['ID_vinho'], $vinho->getRotulo());
        $this->cadastraComidaVinho($res['ID_vinho'], $arrayComidas);

        return $addvinho;
    }

    public function cadastraComidaVinho($idVinho, $arrayComidas)
    {
        foreach($arrayComidas as $idComida)
        {
            $addVinhoComida = ORM::for_table('vinho_comida')->create();
            $addVinhoComida->ID_vinho = $idVinho;
            $addVinhoComida->ID_comida = $idComida;
            $addVinhoComida->save();
        }
    }

    public function calculaEstrelas($idVinho)
    {
        $estrelas = ORM::for_table('avaliacao')->where('ID_vinho', $idVinho)->avg('nota');
        return $estrelas;
    }


    //USUARIO

    public function verificaMeusVinhos($idUsuario, $vinho)
    {
        $meusvinhos = ORM::for_table('usuario_vinhos')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $vinho))->find_one();
        if($meusvinhos)
        {
            return false;
        }
        else return true;
    }

    public function buscaMeusVinhos($id)
    {
        $meusvinhos = ORM::for_table('usuario_vinhos')->where('ID_usuario', $id)->find_many();
        return $meusvinhos;
    }

    public function addMeuVinho($idUsuario, $vinho, $rotulo)
    {
        $meusVinhos = ORM::for_table('usuario_vinhos')->create();
        $meusVinhos->ID_usuario = $idUsuario;
        $meusVinhos->ID_vinho = $vinho;
        $meusVinhos->rotulo = $rotulo;
        $meusVinhos->save();

    }

    public function buscaComidasVinho($idVinho)
    {
        $comidas = ORM::for_table('vinho_comida')->where('ID_vinho', $idVinho)->find_many();
        foreach ($comidas as $comida)
        {
            $res = ORM::for_table('comida')->select('nome')->where('ID_comida', $comida['ID_comida'])->find_one();
        }
        return $res;
    }


    //RESENHA

    public function cadastraResenha(classes\resenha $resenha)
    {
        $resenhaBD = ORM::for_table('resenha')->create();
        $resenhaBD->ID_usuario = $resenha->getIdUsuario();
        $resenhaBD->ID_vinho = $resenha->getIdVinho();
        $resenhaBD->resenha = $resenha->getResenha();
        $resenhaBD->datahora = $resenha->getDatahora();
        $resenhaBD->save();
    }

    public function buscaResenhaVinho($idVinho)
    {
        $resenhas = ORM::for_table('resenha')->where('ID_vinho', $idVinho)->find_many();
        foreach ($resenhas as $resenha)
        {
            $resenhas['nomeUsuario'] = ORM::for_table('usuario')->select('nome')->where('ID_usuario', $resenha['ID_usuario'])->find_one();
        }
        return $resenhas;
    }

    public function buscaResenhaUsuario($idUsuario)
    {
        $resenhas = ORM::for_table('resenha')->where('ID_usuario', $idUsuario)->find_many();
        foreach ($resenhas as $resenha)
        {
            $resenhas['nomeVinho'] = ORM::for_table('vinho')->select('nome')->where('ID_vinho', $resenha['ID_vinho'])->find_one();
        }
        return $resenhas;
    }

    //OUTROS
    public function buscaPaises()
    {
        $paises = ORM::for_table('regiao')->find_many();
        return $paises;
    }

    public function buscaTipos()
    {
        $tipos = ORM::for_table('tipo_vinho')->find_many();
        return $tipos;
    }

    public function buscaEstilos()
    {
        $estilos = ORM::for_table('estilo')->find_many();
        return $estilos;
    }

    public function buscaUvas()
    {
        $uvas = ORM::for_table('uva')->find_many();
        return $uvas;
    }

    public function buscaComidas()
    {
        $comidas = ORM::for_table('comida')->find_many();
        return $comidas;
    }
}
