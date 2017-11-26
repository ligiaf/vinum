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
    /*echo '<br/>titulo <br/>';
    var_dump($_POST['txtTitulo']);
    echo '<br/>vinicola <br/>';
    var_dump($_POST['txtVinicola']);
    echo '<br/>pais <br/>';
    var_dump($_POST['selectPais']);
    echo '<br/>regiao <br/>';
    var_dump($_POST['txtRegiao']);
    echo '<br/>tipo <br/>';
    var_dump($_POST['selectTipo']);
    echo '<br/>estilo <br/>';
    var_dump($_POST['selectEstilo']);
    echo '<br/>uva <br/>';
    var_dump($_POST['selectUva']);
    echo '<br/>preco <br/>';
    var_dump($_POST['txtPreco']);
    echo '<br/>comidas <br/>';
    var_dump($_POST['selectComida']);
    echo '<br/>rotulo <br/>';
    var_dump($_POST['txtRotulo']);
    echo '<br/>Arquivo erro <br/>';
    var_dump($_FILES['arquivo']['error']);
    echo '<br/>Arquivo nome <br/>';
    var_dump($_FILES['arquivo']['tmp_name']);
    if(isset($_FILES['arquivo'])){
        echo '<br/>teste if 1<br/>';
    }*/
    if(((isset($_POST['txtTitulo'])) && ($_POST['txtTitulo'] != '')) &&
        ((isset($_POST['txtVinicola']) && $_POST['txtVinicola'] != '')) &&
        ((isset($_POST['selectPais']) && $_POST['selectPais'] != '')) &&
        ((isset($_POST['txtPreco']) && $_POST['txtPreco'] != '')) &&
        ((isset($_POST['txtRegiao']) && $_POST['txtRegiao'] != '')) &&
        ((isset($_POST['selectTipo']) && $_POST['selectTipo'] != '')) &&
        ((isset($_POST['selectEstilo']) && $_POST['selectEstilo'] != '')) &&
        ((isset($_POST['selectUva']) && $_POST['selectUva'] != '')) &&
        ((isset($_POST['selectComida']) && $_POST['selectComida'] != '')) &&
        ((isset($_FILES['arquivo']) && $_FILES['arquivo']['tmp_name'] != '')))
    {
        $ctrVinho = new controllerVinho();
        $res = $ctrVinho->cadastraVinho($_POST['txtTitulo'], $_POST['txtRotulo'], $_POST['txtVinicola'], $_POST['txtRegiao'],
            $_POST['txtPreco'], $_POST['selectPais'], $_POST['selectTipo'], $_POST['selectEstilo'],
            $_POST['selectUva'], $_POST['selectComida']);
        //($nomeVinho, $rotulo, $produtor, $regiao, $preco, $idRegiao, $idTipo, $idEstilo, $idUva, $arrayIDComida)
        if($res)
        {
            $idVinho = $res->get('id');
            $destino = "..\images\vinhos'".$idVinho.'.jpg';
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

<nav class="white" role="navigation">
    <div class="nav-wrapper container">
        <a href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
        <ul id="nav-mobile" class=" right hide-on-med-and-down">
            <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar
                    vinhos</a></li>
            <li><a href="viewMeusVinhos.php?id=<?=$_SESSION['id']?>" class="valign-wrapper"><i class="material-icons left">dashboard</i>Meus
                    vinhos</a></li>
            <li><a href="viewVisualizarUsuario.php?id=<?=$_SESSION['id']?>" class="valign-wrapper"><i class="material-icons left">account_circle</i><?= $_SESSION['nome'] ?></a></li>
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
        <!--AQUI � ONDE TEM Q APARECER AS SUGESTOES DE VINHO PRA NAO CADASTRAR DNV-->
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
            <form enctype="multipart/form-data" action="viewAddVinho.php" method="post">
                <section>
                    <h5>Adicione um novo vinho</h5>
                </section>
                <br>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="" name="txtTitulo" id="txtTitulo" type="text" class="validate">
                        <label>T�tulo</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="" name="txtVinicola" type="text" class="validate">
                        <label>Vin�cola</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <select name="selectPais">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($paises as $pais){
                                echo "<option value=".$pais['ID_regiao'].">".$pais['nome']."</option>";
                            }?>
                        </select>
                        <label>Pa�s de origem</label>
                    </div>
                    <div class="input-field col s6">
                        <input placeholder="" name="txtRegiao" type="text" class="validate">
                        <label>Regi�o</label>
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
                                echo "<option value=".$uva['ID_uva'].">".$uva['tipo']."</option>";
                            }?>
                        </select>
                        <label>Tipo de uva</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <select multiple name="selectComida[]">
                            <option value="" disabled selected>Selecionar</option>
                            <?php
                            foreach ($comidas as $comida){
                                echo "<option value=".$comida['ID_comida'].">".$comida['nome']."</option>";
                            }?>
                        </select>
                        <label>Harmoniza��o com comidas</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s6">
                        <input placeholder="" name="txtPreco" type="text" class="validate">
                        <label>Pre�o</label>
                    </div>
                    <div class="file-field input-field col s6">
                        <div class="btn grey">
                            <span>R�tulo: </span>
                            <input name="arquivo" type="file" />
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