<?php
require_once '../vendor/autoload.php';
require_once '../controllers/controllerVinho.php';
require_once '../controllers/controllerUsuario.php';
require_once '../controllers/controllerResenha.php';
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

$ctrUsuario= new controllerUsuario();
$ctrVinho= new controllerVinho();
$vinho = $ctrVinho->buscaVinhoID($_GET['id']);
$comidas = $ctrVinho->buscaComidasVinho($_GET['id']);
$resenhas = $ctrVinho->buscaResenhaVinho($_GET['id']);
$estrelas = $ctrVinho->calculaEstrelas($_GET['id']);
$avUsuario = $ctrUsuario->buscaAvaliacaoUsuario($_SESSION['id'], $_GET['id']);

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
    if(isset($_POST['txtResenha']) && $_POST['txtResenha'] != '')
    {
        if($ctrUsuario->verificaMeusVinhos($_SESSION['id'], $_GET['id']))
        {
            echo "<script language='JavaScript'>alert('Você precisa adicionar este vinho aos seus vinhos para escrever uma resenha!');</script>";
        }
        else
        {
            $ctrResenha = new controllerResenha();
            $datahora = new DateTime();
            $ctrResenha->cadastraResenha($_SESSION['id'], $_GET['id'], $_POST['txtResenha'], date_format($datahora, 'Y-m-d H:i:s'));
        }
    }

    if(isset($_POST['inputavaliacao']) && $_POST['inputavaliacao'] != '')
    {
        $ctrUsuario->avaliar($_SESSION['id'], $_GET['id'], $_POST['inputavaliacao']);
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
    <link rel="stylesheet" href="../css/jquery.rateyo.min.css"/>
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<?php
if(isset($_SESSION))
{
    ?>
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
<?php }
else {
    ?>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a id="logo-container" href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
            <ul class="right hide-on-med-and-down">
                <li><a href="viewBuscarVinho.php" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
                <li>
                    <!-- Modal Trigger -->
                    <a class="modal-trigger valign-wrapper" href="#modal1">Login</a>
                </li>
                <!-- Modal Structure -->
                <div id="modal1" class="modal">
                    <div class="modal-content">
                        <h4 class="black-text">Login</h4>
                        <form action="index.php" id="login" method="post" class="container grey-text col s6">
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
                                <a href="#" onclick="document.getElementById('login').submit();" class="modal-action waves-effect waves-green btn-flat" type="submit">Entrar</a>
                                <a href="#!" class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
                <li>
                    <!-- Modal Trigger -->
                    <a class="modal-trigger valign-wrapper" href="#modal2">Cadastre-se</a>
                </li>
                <!-- Modal Structure -->
                <div id="modal2" class="modal">
                    <div class="modal-content">
                        <h4 class="black-text">Cadastro</h4>
                        <form action="index.php" method="post" id="cadastrar" class="container grey-text">
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
                                    <a href="#" onclick="document.getElementById('cadastrar').submit();" name="btnCadastrar" class="modal-action waves-effect waves-green btn-flat">Cadastrar</a>
                                    <a href="#!"class="modal-action modal-close waves-effect waves-green btn-flat">Cancelar</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </ul>
        </div>
    </nav>
    <?php
}
?>

<div class="container">
    <div class="col s10">
        <div class="card-panel grey lighten-3">
            <div class="row col s12">
                <div class="card-panel white center col s3" style="padding-top: 10px; padding-bottom: 8px">
                    <img src="../images/vinhos/<?=$vinho['ID_vinho']?>.jpg" alt="" class="responsive-img">
                </div>
                <div class="col s9 valign-wrapper">
                    <div class="col s6 offset-s1 left-align">
                        <h4><b><?= $vinho['nome']; ?></b></h4>
                    </div>
                    <div class="right-align col col s4">
                        <form id="estrelas" method="post" action="viewVisualizarVinho.php?id=<?=$_GET['id']?>">
                            <input id="inputavaliacao" type="hidden">
                            <div id="rateYo"></div>
                        </form>
                    </div>
                </div>
                <div class="col s8 offset-s1">
                    <div class="row">
                        <p class="light" style="font-size:30px"><i class="material-icons left yellow-text text-darken-2" style="font-size: 28px">star</i>
                            <?php
                            if($estrelas)
                            {
                                echo $estrelas;
                            }else echo 0;
                            ?></p>
                        <p><b>Tipo:</b> <?=$vinho['ID_tipo']?> &nbsp; <b>Estilo:</b> <?=$vinho['ID_estilo']?> &nbsp; <b>Uva:</b> <?=$vinho['ID_uva']?></p>
                        <p><b>Região:</b> <?=$vinho['regiao']?> &nbsp; <b>País de origem:</b> <?=$vinho['ID_regiao']?></p>
                        <p><b>Harmoniza com: </b><?php foreach($comidas as $comida){echo $comida.' | ';}?></p>
                    </div>
                </div>
            </div>
            <div class="row">
                <br/>
                <section>
                    <h5>Resenhas</h5>
                </section>
            </div>
            <?php
            if($resenhas){
            foreach ($resenhas as $resenha){ ?>
                <div class="divider"> </div>
                <div class="row">
                    <p><a href="viewVisualizarUsuario.php?id=<?=$resenha['ID_usuario']?>" class="black-text"><b><?=$resenha['nomeUsuario']?></b></a>
                        <small>&nbsp;&nbsp;<?=$resenha['datahora'] ?></small></p>
                </div>
                <div class="row">
                    <blockquote>
                        <p class="light"><?=$resenha['resenha'] ?></p>
                    </blockquote>
                </div>
            <?php }
            }?>
            <form action="viewVisualizarVinho.php?id=<?= $_GET['id'] ?>" method="post" class="col s12">
                <div class="row">
                    <div class="input-field col s12">
                        <textarea name="txtResenha" id="textarea1" class="materialize-textarea"></textarea>
                        <label for="textarea1">Resenha</label>
                    </div>
                </div>
                <div class="row">
                    <input class="btn waves-effect waves-light center teal darken-4 col s2 offset-s10" type="submit" name="btnResenha" value="Publicar">
                </div>
            </form>
        </div>
    </div>
</div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.rateyo.js"></script>
<script language="Javascript">
    $(function () {
        $("#rateYo").rateYo({
            rating: <?php if($avUsuario['nota']) {echo $avUsuario['nota'];} else echo 0;?>,
            fullStar: true,
            ratedFill: "#004d40"
        });
    });

    $(function () {
        $("#rateYo").rateYo().on("rateyo.set", function (e, data) {
            document.getElementById('inputavaliacao').setAttribute(value, data.rating);
            document.forms['estrelas'].submit();
        });
    });

</script>
</body>
</html>