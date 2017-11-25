<?php
require_once '../vendor/autoload.php';
require_once '../controllers/controllerVinho.php';
require_once '../controllers/controllerPais.php';
require_once '../controllers/controllerTipoVinho.php';
require_once '../controllers/controllerEstilo.php';
require_once '../controllers/controllerUva.php';
require_once '../controllers/controllerComida.php';
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

if(!isset($_SESSION['nome']))
{
    header('Location:index.php');
    exit;
}

$ctrPais = new controllerPais();
$ctrTipo = new controllerTipoVinho();
$ctrEstilo = new controllerEstilo();
$ctrUva = new controllerUva();
$ctrComida = new controllerComida();

$paises = $ctrPais->buscaPaises();
$tipos = $ctrTipo->buscaTipos();
$estilos = $ctrEstilo->buscaEstilos();
$uvas = $ctrUva->buscaUvas();
$comidas = $ctrComida->buscaComidas();

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['txtTitulo']) && $_POST['txtTitulo'] != '' &&
        isset($_POST['txtVinicola']) && $_POST['txtVinicola'] != '' &&
        isset($_POST['selectPais']) && $_POST['selectPais'] != '' &&
        isset($_POST['txtPreco']) && $_POST['txtPreco'] != '' &&
        isset($_POST['txtRegiao']) && $_POST['txtRegiao'] != '' &&
        isset($_POST['selectTipo']) && $_POST['selectTipo'] != '' &&
        isset($_POST['selectEstilo']) && $_POST['selectEstilo'] != '' &&
        isset($_POST['selectUva']) && $_POST['selectUva'] != '' &&
        isset($_POST['selectComida']) && $_POST['selectComida'] != '' &&
        isset($_FILES['arquivo']) && $_FILES['arquivo'] != '')
    {
        $ctrVinho = new controllerVinho();
        $res = $ctrVinho->cadastraVinho($_POST['txtTitulo'], $_POST['txtRotulo'], $_POST['txtVinicola'], $_POST['selectPais'],
            $_POST['txtPreco'], $_POST['txtRegiao'], $_POST['selectTipo'], $_POST['selectEstilo'],
            $_POST['selectUva'], $_POST['selectComida']);
        if($res)
        {
            $idVinho = $res['ID_vinho'];
            $destino = 'images/vinhos/'.$idVinho.'jpg';
            $arquivo_tmp = $_FILES['arquivo']['tmp_name'];
            move_uploaded_file( $arquivo_tmp, $destino);
            header("Location:viewVisualizarVinho.php?id=".$idVinho);
        }
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1"/>
    <title>VINUM</title>

    <!-- CSS  -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="../css/materialize.css" type="text/css" rel="stylesheet" media="screen,projection"/>
    <link href="../css/style.css" type="text/css" rel="stylesheet" media="screen,projection"/>
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<!-- NAO LOGADO -->
<!--
<nav class="white" role="navigation">
  <div class="nav-wrapper container">
    <a id="logo-container" href="#" class="brand-logo"><img class="responsive-img" src="images/logo.fw.png"></a>
    <ul class="right hide-on-med-and-down">
      <li><a href="viewBuscarVinho.html" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
      <li>
<a class="modal-trigger valign-wrapper" href="#modal1">Login</a>
</li>
<div id="modal1" class="modal">
    <div class="modal-content">
        <h4 class="black-text">Login</h4>
        <form class="container grey-text col s6">
            <div class="row">
                <div class="input-field ">
                    <input type="email" name="txtLoginEmail"/>
                    <label>Email: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="password" name="txtLoginSenha"/>
                    <label>Senha: </label>
                </div>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-action waves-effect waves-green btn-flat" type="submit">Entrar</a>
                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
            </div>
        </form>
    </div>
</div>
<li>
    <a class="modal-trigger valign-wrapper" href="#modal2">Cadastre-se</a>
</li>
<div id="modal2" class="modal">
    <div class="modal-content">
        <h4 class="black-text">Cadastro</h4>
        <form class="container grey-text">
            <div class="row">
                <div class="input-field">
                    <input type="text" name="txtNome" class="validate"/>
                    <label>Nome: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="email" name="txtEmail" class="validate"/>
                    <label>Email: </label>
                </div>
            </div>
            <div class="row">
                <div class="input-field ">
                    <input type="password" name="txtSenha" class="validate"/>
                    <label>Senha: </label>
                </div>
            </div>
            <div class="row valign-wrapper">
                <div class="modal-footer">
                    <a name="btnCadastrar" href="#!" class="modal-action waves-effect waves-green btn-flat">Entrar</a>
                    <a href="#!" class="modal-action modal-close waves-effect waves-green  btn-flat">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
    </ul>
    <ul id="nav-mobile" class="side-nav">
        <li><a href="#">Login</a></li>
        <li><a href="#">Entrar</a></li>
    </ul>
    <a href="#" data-activates="nav-mobile" class="button-collapse"><i class="material-icons">menu</i></a>
</div>
</nav>
-->

<!-- LOGADO -->

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
        <ul id="nav-mobile" class=" right hide-on-med-and-down">
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
            <li><a href="viewMeusVinhos.php" class="valign-wrapper"><i class="material-icons left">dashboard</i>Meus vinhos</a></li>
            <li><a href="viewVisualizarUsuario.php" class="valign-wrapper"><i class="material-icons left">account_circle</i>Nome do individuo</a></li>
        </ul>
    </div>
</nav>

<div class="container" >
    <div class="card-panel grey lighten-3">

        <section class="section">
            <h4> Adicionar vinho </h4>
        </section>
        <div class="divider"></div>
        <br>
        <!--AQUI É ONDE TEM Q APARECER AS SUGESTOES DE VINHO PRA NAO CADASTRAR DNV-->
        <form id="vinho" method="post" action="viewVinhoExistente.php">
            <div class="input-field">
                <i class="material-icons prefix">local_bar</i>

                <input type="text" name="autocomplete" id="autocomplete-input" class="autocomplete">
                <label>Nome do vinho</label>

            </div>
        </form>
        <br>

        <!-- ISSO APARECE SE NAO TIVER VINHO CADASTRADO -->
        <div class="row" id="cadastro">
            <form action="viewAddVinho.php" method="post" class="col s12">
                <section>
                    <h5>Adicione um novo vinho</h5>
                </section>
                <br>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="" name="txtTitulo" id="txtTitulo" type="text" class="validate">
                        <label>Título</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="" name="txtVinicola" type="text" class="validate">
                        <label>Vinícola</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="selectPais">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($paises as $pais){
                                echo "<option value=".$pais['ID_pais'].">".$pais['nome']."</option>";
                            }?>
                        </select>
                        <label>País de origem</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="" name="txtRegiao" type="text" class="validate">
                        <label>Região</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="selectTipo">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($tipos as $tipo){
                                echo "<option value=".$tipo['ID_tipo'].">".$tipo['nome']."</option>";
                            }?>
                        </select>
                        <label>Tipo</label>
                    </div>
                    <div class="input-field col s6">
                        <select name="selectEstilo">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($estilos as $estilo){
                                echo "<option value=".$estilo['ID_estilo'].">".$estilo['nome']."</option>";
                            }?>
                        </select>
                        <label>Estilo</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="selectUva">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($uvas as $uva){
                                echo "<option value=".$uva['ID_estilo'].">".$uva['tipo']."</option>";
                            }?>
                        </select>
                        <label>Tipo de uva</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <select multiple name="selectComida">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($comidas as $comida){
                                echo "<option value=".$comida['ID_comida'].">".$comida['nome']."</option>";
                            }?>
                        </select>
                        <label>Harmonização com comidas</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="" name="txtPreco" type="text" class="validate">
                        <label>Preço</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn grey">
                            <span>Rótulo: </span>
                            <input type="file" name="arquivo" >
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" name="txtRotulo" value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="file-field input-field col s2 offset-s10">
                        <input type="submit" class="btn waves-effect waves-light teal darken-4" value="Adicionar">
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.0/jquery.mask.js"></script>
<script type="text/javascript" src="../js/materialize.js"></script>

<script>

    $("#autocomplete-input").change(function(){
        $("#txtTitulo").val($("#autocomplete-input").val());
    });

    $(function() {
        $('input.autocomplete').autocomplete({
            data: {
                <?php
                $ctrVinho = new controllerVinho();
                $res =  $ctrVinho->listaVinho();
                foreach ($res as $vinho){
                ?>
                "<?= $vinho['nome'] ?>": null,
                <?php } ?>
            },
            limit: 15, // The max amount of results that can be shown at once. Default: Infinity.
            onAutocomplete: function(val) {
                $('#vinho').submit();
            },
            minLength: 1 // The minimum length of the input for the autocomplete to start. Default: 1.
        });
    });
</script>

</body>
</html>