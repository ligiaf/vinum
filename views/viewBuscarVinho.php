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

$ctrPais = new controllerPais();
$ctrTipo = new controllerTipoVinho();
$ctrEstilo = new controllerEstilo();
$ctrUva = new controllerUva();
$ctrComida = new controllerComida();
$ctrVinho = new controllerVinho();

$paises = $ctrPais->buscaPaises();
$tipos = $ctrTipo->buscaTipos();
$estilos = $ctrEstilo->buscaEstilos();
$uvas = $ctrUva->buscaUvas();
$comidas = $ctrComida->buscaComidas();

$tipo_vinho = array();
$tipo_vinho = null;
$regiao_vinho = array();
$regiao_vinho = null;
$tipo_uva = array();
$tipo_uva = null;
$estilo_vinho = array();
$estilo_vinho = null;
$harmonizacao_vinho = array();
$harmonizacao_vinho = null;
$menorPreco = null;
$maiorPreco = null;
$estrelas = null;


if(isset($_GET['menorPreco'])){
    $menorPreco = $_GET['menorPreco'];
}
if(isset($_GET['maiorPreco'])){
    $maiorPreco = $_GET['maiorPreco'];
}
if(isset($_GET['estrelas'])){
    $estrelas = $_GET['estrelas'];
}
if(isset($_GET['tipoVinho'])){
    $tipo_vinho = explode(',',$_GET['tipoVinho']);
}
if(isset($_GET['regiaoVinho'])&& $_GET['regiaoVinho']!= ','){
    $regiao_vinho = explode(',',$_GET['regiaoVinho']);
    $key = array_search(',', $regiao_vinho);
    if($key!==false){
        unset($regiao_vinho[$key]);
    }
}
if(isset($_GET['tipoUva']) && $_GET['tipoUva']!= ','){
    $tipo_uva = explode(',',$_GET['tipoUva']);
    $key = array_search(',', $tipo_uva);
    if($key!==false){
        unset($tipo_uva[$key]);
    }
}
if(isset($_GET['estiloVinho'])&& $_GET['estiloVinho']!= ','){
    $estilo_vinho = explode(',',$_GET['estiloVinho']);
    $key = array_search(',', $estilo_vinho);
    if($key!==false){
        unset($estilo_vinho[$key]);
    }
}
if(isset($_GET['harmonizacao'])&& $_GET['harmonizacao']!= ','){
    $harmonizacao_vinho = explode(',',$_GET['harmonizacao']);
    $key = array_search(',', $harmonizacao_vinho);
    if($key!==false){
        unset($harmonizacao_vinho[$key]);
    }
}

$vinhos = $ctrVinho->buscarVinhosTotal($estrelas,$menorPreco, $maiorPreco, $regiao_vinho, $estilo_vinho, $tipo_vinho, $tipo_uva, $harmonizacao_vinho);

if(!$regiao_vinho){
    $regiao_vinho = [','];
}
if(!$tipo_uva){
    $tipo_uva = [','];
}
if(!$estilo_vinho){
    $estilo_vinho = [','];
}
if(!$harmonizacao_vinho){
    $harmonizacao_vinho = [','];
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.css" />
</head>
<body style="background-image: radial-gradient(#ffffff,#2e525a)">

<?php
if(isset($_SESSION['id']))
{
    ?>
    <nav class="white" role="navigation">
        <div class="nav-wrapper container">
            <a href="index.php" class="brand-logo"><img class="responsive-img" src="../images/logo.fw.png"></a>
            <ul id="nav-mobile" class=" right hide-on-med-and-down">
                <li><a href="viewBuscarVinho.php?tipoVinho=&menorPreco=&maiorPreco=&estrelas=" class="valign-wrapper"><i class="material-icons left">search</i>Buscar
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
                <li><a href="viewBuscarVinho.php?tipoVinho=&menorPreco=&maiorPreco=&estrelas=" class="valign-wrapper"><i class="material-icons left">search</i>Buscar vinhos</a></li>
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
    <div class="col s12">
        <div class="card-panel grey lighten-3">
            <div class="row">
                <div class="col s4">
                    <section>
                        <h5>Filtros</h5>
                    </section>
                    <div class="divider"></div>
                    <br>
                    <section>
                        <b>Tipo do vinho</b>
                    </section>
                    <br>
                    <?php
                    foreach ($tipos as $tipo){
                        $tipo_vinho_c = $tipo_vinho;
                        $key = array_search($tipo['nome'], $tipo_vinho_c);
                        if($key==false && count($tipo_vinho_c) > 1){
                            unset($tipo_vinho_c[$key]);
                            echo '<a href="viewBuscarVinho.php?tipoVinho='.implode(',', $tipo_vinho_c).'&estrelas='.$estrelas.'&menorPreco='.$menorPreco.'&maiorPreco='.$maiorPreco.'&regiaoVinho='.implode(',', $regiao_vinho).'&tipoUva='.implode(',', $tipo_uva).'&estiloVinho='.implode(',', $estilo_vinho).'&harmonizacao='.implode(',', $harmonizacao_vinho).'">
                                    <div class="chip" id="'.$tipo['nome'].'">'.$tipo['nome'].'</div></a>';
                        }
                        else {
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . $tipo['nome'] . ',' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                            <div class="chip" id="' . $tipo['nome'] . '">' . $tipo['nome'] . '</div></a>';
                        }
                    }
                    //QUANDO SELECIONADO OS CHIPS FICAM NESSA COR <a href="#"><div class="chip teal white-text">'.$tipo['nome'].'</div></a>
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Faixa de preço</b>
                    </section>
                    <br><br>
                    <div id="sliderPreco"></div>
                    <br>
                    <div class="input-field">
                        <section>
                            <b>Avaliação dos usuários</b>
                        </section>
                        <br><br>
                        <div id="sliderAvaliacao"></div>
                    </div>
                    <br>
                    <section>
                        <b>Uva</b>
                    </section>
                    <br>
                    <?php
                    foreach ($uvas as $uva){
                        $tipo_uva_c = $tipo_uva;
                        $key = array_search($uva['tipo'], $tipo_uva_c);
                        if($key==false && count($tipo_uva_c) > 1) {
                            unset($tipo_uva_c[$key]);
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva='. implode(',', $tipo_uva_c) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                            <div class="chip">' . $uva['tipo'] . '</div></a>';
                        }
                        else{
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . $uva['tipo'] . ','. implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                            <div class="chip">' . $uva['tipo'] . '</div></a>';
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>País de origem</b>
                    </section>
                    <br>
                    <div class="chip">Brasil</div>
                    <?php
                    foreach ($paises as $pais){
                        $regiao_vinho_c = $regiao_vinho;
                        $key = array_search($pais['nome'], $regiao_vinho_c);
                        if($key==false && count($regiao_vinho_c) > 1) {
                            unset($regiao_vinho_c[$key]);
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho_c) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                            <div class="chip">' . $pais['nome'] . '</div></a>';
                        }
                        else{
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . $pais['nome'] . ',' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                            <div class="chip">' . $pais['nome'] . '</div></a>';
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Estilo do vinho</b>
                    </section>
                    <br>
                    <?php
                    foreach ($estilos as $estilo){
                        $estilo_vinho_c = $estilo_vinho;
                        $key = array_search($estilo['nome'], $estilo_vinho_c);
                        if($key==false && count($estilo_vinho_c) > 1) {
                            unset($estilo_vinho_c[$key]);
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho_c) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                                <div class="chip">' . $estilo['nome'] . '</div></a>';
                        }
                        else{
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . $estilo['nome'] . ',' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho) . '">
                                <div class="chip">' . $estilo['nome'] . '</div></a>';
                        }
                    }
                    ?>
                    <br>
                    <br>
                    <section>
                        <b>Harmonização com comidas</b>
                    </section>
                    <br>
                    <?php
                    foreach ($comidas as $comida){
                        $harmonizacao_vinho_c = $harmonizacao_vinho;
                        $key = array_search($comida['nome'], $harmonizacao_vinho_c);
                        if($key==false && count($harmonizacao_vinho_c) > 1) {
                            unset($harmonizacao_vinho_c[$key]);
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . implode(',', $harmonizacao_vinho_c) . '">
                                <div class="chip">' . $comida['nome'] . '</div></a>';
                        }
                        else{
                            echo '<a href="viewBuscarVinho.php?tipoVinho=' . implode(',', $tipo_vinho) . '&estrelas=' . $estrelas . '&menorPreco=' . $menorPreco . '&maiorPreco=' . $maiorPreco . '&regiaoVinho=' . implode(',', $regiao_vinho) . '&tipoUva=' . implode(',', $tipo_uva) . '&estiloVinho=' . implode(',', $estilo_vinho) . '&harmonizacao=' . $comida['nome'] . ',' . implode(',', $harmonizacao_vinho) . '">
                                <div class="chip">' . $comida['nome'] . '</div></a>';
                        }
                    }
                    ?>
                    <br>
                </div>
                <div class="col s8">
                    <section>
                        <h5>Resultados</h5>
                    </section>
                    <div class="divider"></div>
                    <br>
                    <?php

                    foreach ($vinhos as $vinho){ ?>
                    <div class="card horizontal small">
                        <div class="card-image">
                            <img class="responsive-img" src="../images/vinhos/<?= $vinho['ID_vinho']?>.jpg">
                        </div>
                        <div class="card-stacked">
                            <a href="viewVisualizarVinho.php?id=<?=$vinho['ID_vinho']?>"> <h4 class="header teal-text">&nbsp; <?= $vinho['nome']?></h4> </a>
                            <div class="card-content">
                                <p><i class="material-icons left yellow-text text-darken-2">star</i><?= $vinho['estrela']?></p>
                                <p><?= $vinho['nome_tipo']?></p>
                                <p><?= $vinho['nome_estilo']?></p>
                                <p><?= $vinho['nome_regiao']?></p>
                            </div>
                        </div>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>
    <form id="form-slider" method="get" action="viewBuscarVinho.php">
        <input hidden="hidden" id="menorPreco" name="menorPreco">
        <input hidden="hidden" id="maiorPreco" name="maiorPreco">
        <input hidden="hidden" id="tipoVinho" name="tipoVinho" value="<?= implode(',', $tipo_vinho);?>">
        <input hidden="hidden" id="estrelas" name="estrelas">
        <input hidden="hidden" id="regiaoVinho" name="regiaoVinho" value="<?= implode(',', $regiao_vinho);?>">
        <input hidden="hidden" id="estiloVinho" name="estiloVinho" value="<?= implode(',', $estilo_vinho);?>">
        <input hidden="hidden" id="tipoUva" name="tipoUva" value="<?= implode(',', $tipo_uva);?>">
        <input hidden="hidden" id="harmonizacao" name="harmonizacao" value="<?= implode(',', $harmonizacao_vinho);?>">
    </form>
</div>

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.js"></script>
<script src="../wnumb-1.1.0/wNumb.js"></script>
<script>
    var sliderPreco = document.getElementById('sliderPreco');

    noUiSlider.create(sliderPreco, {
        start: [300, 1000],
        connect: true,
        tooltips: [wNumb({ decimals: 0 }), wNumb({ decimals: 0 })],
        range: {
            'min': 0,
            'max': 1300
        }
    });

    var sliderAv = document.getElementById('sliderAvaliacao');

    noUiSlider.create(sliderAv, {
        start: [3],
        connect: [false, true],
        tooltips: [wNumb({ decimals: 1 })],
        range: {
            'min': 1,
            'max': 5
        }
    });

    sliderPreco.noUiSlider.on('update', function(){
        var valores = sliderPreco.noUiSlider.get();
        $("#menorPreco").val(valores[0]);
        $("#maiorPreco").val(valores[1]);
        $("#estrelas").val(sliderAv.noUiSlider.get());
    });

    sliderAv.noUiSlider.on('update', function(){
        var valores = sliderPreco.noUiSlider.get();
        $("#menorPreco").val(valores[0]);
        $("#maiorPreco").val(valores[1]);
        $("#estrelas").val(sliderAv.noUiSlider.get());
    });

    sliderPreco.noUiSlider.on('end', function(){
        $("#form-slider").submit();
    });

    sliderAv.noUiSlider.on('end', function(){
        $("#form-slider").submit();
    });


    function atualizaSliders() {
        sliderPreco.noUiSlider.set([<?= $menorPreco?>, <?= $maiorPreco?>]);
        sliderAv.noUiSlider.set(<?= $estrelas?>);
    }

    atualizaSliders();

</script>
</body>
</html>