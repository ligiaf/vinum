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

    public function buscaAvaliacaoUsuario($idUsuario, $idVinho)
    {
        $nota = ORM::for_table('avaliacao')->select('nota')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $idVinho))->find_one();
        return $nota;
    }

    public function verificaAvaliacao($idUsuario, $idVinho)
    {
        $res = ORM::for_table('avaliacao')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $idVinho))->find_one();
        if($res)
        {
            return true;
        }
        return false;
    }

    public function avaliar($idUsuario, $idVinho, $nota)
    {
        $avaliacao = ORM::for_table('avaliacao')->create();
        $avaliacao->ID_usuario = $idUsuario;
        $avaliacao->ID_vinho = $idVinho;
        $avaliacao->nota = $nota;
        $avaliacao->save();
    }

    public function alteraAvaliacao($idUsuario, $idVinho, $nota)
    {
        $avaliacao = ORM::for_table('avaliacao')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $idVinho))->find_one();
        $avaliacao->set('nota',$nota);
        $avaliacao->save();
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

    public function cadastraVinho(classes\vinho $vinho, $arrayComidas=array())
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
        $rotulo=''.$addvinho->get(ID_vinho).'.jpg';
        $id = intval($addvinho->get(ID_vinho));
        //var_dump($rotulo);
        //var_dump($addvinho->get(ID_vinho));
        $addvinho = $this->atualizaRotulo($id,$rotulo);
        $idUsuario = $this->buscaUsuarioEmail($_SESSION['email']);
        //$res = $this->buscaVinho($vinho->getNome());
        $this->addMeuVinho($idUsuario, $addvinho->get(ID_vinho));
        $this->cadastraComidaVinho($addvinho->ID_vinho, $arrayComidas);

        return $addvinho;
    }

    public function atualizaRotulo($id,$rotulo)
    {
        $atualizaVinnho = ORM::for_table('vinho')->find_one($id);
        $atualizaVinnho->set('rotulo',$rotulo);
        $atualizaVinnho->save();
        return $atualizaVinnho;
    }
    public function cadastraComidaVinho($idVinho, $arrayComidas=array())
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

    public function addHarmonizacao($idVinho, $idComida)
    {
        $addHarmonizacao = ORM::for_table('vinho_comida')->create();
        $addHarmonizacao->ID_vinho = $idVinho;
        $addHarmonizacao->ID_comida = $idComida;
        $addHarmonizacao->save();
    }

    public function verificaHarmonizacao($idVinho, $idComida)
    {
        $res = ORM::for_table('vinho_comida')->where(array('ID_vinho' => $idVinho, 'ID_comida' => $idComida))->find_one();
        if($res)
        {
            return true;
        }
        return false;
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

    public function addMeuVinho($idUsuario, $vinho)
    {
        $meusVinhos = ORM::for_table('usuario_vinhos')->create();
        $meusVinhos->ID_usuario = $idUsuario;
        $meusVinhos->ID_vinho = $vinho;
        $meusVinhos->rotulo = $idUsuario.'-'.$vinho.'.jpg';
        $meusVinhos->save();
    }

    public function buscaComidasVinho($idVinho)
    {
        $comidas = ORM::for_table('vinho_comida')->where('ID_vinho', $idVinho)->find_many();
        $res = array();
        foreach ($comidas as $comida)
        {
            $comida = ORM::for_table('comida')->select('nome')->where('ID_comida', $comida['ID_comida'])->find_one();
            array_push($res, $comida['nome']);
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
        $resenhas = ORM::for_table('resenha')->where('ID_vinho', $idVinho)->order_by_desc('datahora')->find_many();
        $i = 0;
        foreach ($resenhas as $resenha)
        {
            $nome = ORM::for_table('usuario')->where('ID_usuario', $resenha['ID_usuario'])->find_one();
            $resenhas[$i]['nomeUsuario'] = $nome['nome'];
            $i++;
        }
        return $resenhas;
    }

    public function buscaResenhaUsuario($idUsuario)
    {
        $resenhas = ORM::for_table('resenha')->where('ID_usuario', $idUsuario)->order_by_desc('datahora')->find_many();
        $i = 0;
        foreach ($resenhas as $resenha)
        {
            $vinho = ORM::for_table('vinho')->where('ID_vinho', $resenha['ID_vinho'])->find_one();
            $resenhas[$i]['nomeVinho'] = $vinho['nome'];
            $i++;
        }
        return $resenhas;
    }

    public function verificaResenha($idUsuario, $idVinho)
    {
        $res = ORM::for_table('resenha')->where(array('ID_usuario' => $idUsuario, 'ID_vinho' => $idVinho))->find_one();
        if($res)
        {
            return true;
        }
        else return false;
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
    public function buscaUsuario()
    {
        $res = $this->buscaUsuarioEmail($_SESSION['email']);
        return $res;
    }

    public function buscaVinhosTotal($estrela, $preco_min, $preco_max, $regiao=array(), $estilo=array(), $tipo_vinho=array(), $tipo_uva=array(), $harmonizacao=array()){
        $vinhos = ORM::for_table('vinho')->find_many();
        foreach ($vinhos as $vinho) {
            $vinho['estrela'] = ORM::for_table('avaliacao')->where('ID_vinho', $vinho['ID_vinho'])->avg('nota');
            $resultado = ORM::for_table('regiao')->where('ID_regiao', $vinho['ID_regiao'])->find_one();
            $vinho['nome_regiao'] = $resultado['nome'];
            $resultado = ORM::for_table('tipo_vinho')->where('ID_tipo', $vinho['ID_tipo'])->find_one();
            $vinho['nome_tipo'] = $resultado['nome'];
            $resultado = ORM::for_table('estilo')->where('ID_estilo', $vinho['ID_estilo'])->find_one();
            $vinho['nome_estilo'] = $resultado['nome'];
            $resultado = ORM::for_table('uva')->where('ID_uva', $vinho['ID_uva'])->find_one();
            $vinho['tipo_uva'] = $resultado['tipo'];
            $comidas_vinho = ORM::for_table('vinho_comida')->where('ID_vinho', $vinho['ID_vinho'])->select('ID_comida')->find_many();
            $resultados = array();
            foreach ($comidas_vinho as $comida_vinho) {
                $resultado = ORM::for_table('comida')->where('ID_comida', $comida_vinho['ID_comida'])->select('nome')->find_one();
                $ID_comida = $comida_vinho['ID_comida'];
                $resultados[strval($ID_comida)] = $resultado['nome'];
            }
            $vinho['comidas'] = $resultados;
        }
        if ($estrela){
            $vinhos_estrela = array();
            foreach ($vinhos as $vinho) {
                if ($vinho['estrela']>=$estrela){
                    array_push($vinhos_estrela, $vinho);
                }
            }
            $vinhos = $vinhos_estrela;
        }
        if ($preco_max){
            $vinhos_preco = array();
            foreach ($vinhos as $vinho) {
                if (($vinho['preco']>=$preco_min)&&($vinho['preco']<=$preco_max)){
                    array_push($vinhos_preco, $vinho);
                }
            }
            $vinhos = $vinhos_preco;
        }
        if ($regiao){
            $vinhos_regiao = array();
            foreach ($regiao as $value) {
                foreach ($vinhos as $vinho) {
                    if ($vinho['nome_regiao']==$value){
                        array_push($vinhos_regiao, $vinho);
                    }
                }
            }
            $vinhos = $vinhos_regiao;
        }
        if ($estilo){
            $vinhos_estilo = array();
            foreach ($estilo as $value) {
                foreach ($vinhos as $value) {
                    if ($vinho['nome_estilo']==$estilo){
                        array_push($vinhos_estilo, $vinho);
                    }
                }
            }
            $vinhos = $vinhos_estilo;
        }
        if ($tipo_vinho){
            $vinhos_tipo_vinho = array();
            foreach ($tipo_vinho as $value) {
                foreach ($vinhos as $vinho) {
                    if ($vinho['nome_tipo']==$value){
                        array_push($vinhos_tipo_vinho, $vinho);
                    }
                }
            }
            $vinhos = $vinhos_tipo_vinho;
        }
        if ($tipo_uva){
            $vinhos_tipo_uva = array();
            foreach ($tipo_uva as $value) {
                foreach ($vinhos as $vinho) {
                    if ($vinho['tipo_uva']==$value){
                        array_push($vinhos_tipo_uva, $vinho);
                    }
                }
            }
            $vinhos = $vinhos_tipo_uva;
        }
        if ($harmonizacao){
            $vinhos_harmonizacao = array();
            foreach ($harmonizacao as $value) {
                foreach ($vinhos as $vinho) {
                    foreach ($vinho['comidas'] as $vinho_comida) {
                        if ($vinho_comida==$value){
                            array_push($vinhos_harmonizacao, $vinho);
                        }
                    }
                }
            }
            $vinhos = $vinhos_harmonizacao;
        }
        return $vinhos;
    }
}
