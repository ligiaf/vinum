<?php
require_once '../vendor/autoload.php';
require_once('../controllers/controllerUsuario.php');
header('Content-type: text/html; charset=ISO-8859-1');

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['txtNome']) && $_POST['txtNome'] != '' &&
        isset($_POST['txtEmail']) && $_POST['txtEmail'] != '' &&
        isset($_POST['txtSenha']) && $_POST['txtSenha'] != '')
    {
       $ctrUsuario = new controllerUsuario();
       $res = $ctrUsuario->cadastraUsuario($_POST['txtNome'], $_POST['txtEmail'], $_POST['txtSenha']);
       if($res)
       {
           $_SESSION['nome'] = $_POST['txtNome'];
           $_SESSION['email'] = $_POST['txtEmail'];
           $res = $ctrUsuario->buscaUsuarioEmail($_POST['txtEmail']);
           $_SESSION['id'] = $res;
           header("Location:viewVisualizarUsuario.php?id=$res");
       }
       else
       {
           echo "<script language='JavaScript'>alert('Email já cadastrado!');</script>";
       }
    }

    if(isset($_POST['txtLoginEmail']) && $_POST['txtLoginEmail'] != '' &&
        isset($_POST['txtLoginSenha']) && $_POST['txtLoginSenha'] != '')
    {
        $ctrUsuario = new controllerUsuario();
        $usuario = $ctrUsuario->autenticaUsuario($_POST['txtLoginEmail'], $_POST['txtLoginSenha']);
        if($usuario)
        {
            $_SESSION['email'] = $_POST['txtLoginEmail'];
            $_SESSION['id'] = $usuario;
            $nome = $ctrUsuario->buscaUsuarioID($usuario);
            $_SESSION['nome'] = $nome['nome'];
            header("Location:viewVisualizarUsuario.php?id=$usuario");
        }
        else
        {
            echo "<script language='JavaScript'>alert('Dados incorretos!');</script>";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.css" />
</head>
<body>

<?php
if(isset($_SESSION['email']))
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

<div id="index-banner" class="parallax-container valign-wrapper">
    <div class="section no-pad-bot">
        <div class="container ">
            <br><br>
            <h1 class="header center white-text">Encontre vinhos</h1>
            <div class="row center">
                <h5 class="header col s12 light">Busque e compartilhe vinhos</h5>
            </div>
        </div>
    </div>
    <div class="parallax"><img src="../images/fundo.jpg" alt="Unsplashed background img 1"></div>
</div>

<div class="container">
    <div class="row">
        <div class="col s12">
            <div class="row">
                <div class="col s12 center">
                    <h3><i class="mdi-content-send brown-text"></i></h3>
                    <h4>Sobre</h4>
                    <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
                </div>
            </div>
            <form action="viewBuscarVinho.php" method="post" id="buscar" class="container col s12 valign-wrapper">
                <div class="input-field col s3">
                    <select name="selectTipoVinho">
                        <option value="" class="disabled">Selecionar</option>
                        <?php
                        $tipos = ORM::for_table('tipo_vinho')->find_many();
                        foreach ($tipos as $tipo){
                            echo '<option value="'.$tipo['nome'].'">'.$tipo['nome'].'</option>';
                        }
                        ?>
                    </select>
                    <label>Tipo do vinho </label>
                </div>
                <label>Preço</label>
                <div class="input-field col s4">
                    <div id="slider"></div>
                    <input type="hidden" name="menorPreco" id="menorPreco"/>
                    <input type="hidden" name="maiorPreco" id="maiorPreco"/>
                </div>
                <label>Nota</label>
                <div class="input-field col s3">
                    <div id="slider2"></div>
                    <input type="hidden" name="estrelas" id="estrelas"/>
                </div>
                <div class="col s2">
                    <a href="#" onclick="document.getElementById('buscar').submit();" id="btnBuscar" class="btn-large waves-effect waves-light teal darken-4">Buscar</a>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!--
<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="images/vinho3.jpg" alt="Unsplashed background img 2"></div>
</div>
-->
<!--
<div class="container">
  <div class="section">
    <div class="row">
      <div class="col s12 center">
        <h3><i class="mdi-content-send brown-text"></i></h3>
        <h4>Sobre</h4>
        <p class="left-align light">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam scelerisque id nunc nec volutpat. Etiam pellentesque tristique arcu, non consequat magna fermentum ac. Cras ut ultricies eros. Maecenas eros justo, ullamcorper a sapien id, viverra ultrices eros. Morbi sem neque, posuere et pretium eget, bibendum sollicitudin lacus. Aliquam eleifend sollicitudin diam, eu mattis nisl maximus sed. Nulla imperdiet semper molestie. Morbi massa odio, condimentum sed ipsum ac, gravida ultrices erat. Nullam eget dignissim mauris, non tristique erat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;</p>
      </div>
    </div>
  </div>
</div>

<div class="parallax-container valign-wrapper">
  <div class="section no-pad-bot">
    <div class="container">
      <div class="row center">
        <h5 class="header col s12 light"></h5>
      </div>
    </div>
  </div>
  <div class="parallax"><img src="images/fundo2.jpg" alt="Unsplashed background img 3"></div>
</div>
-->

<!--  Scripts-->
<script src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="../js/materialize.js"></script>
<script src="../js/init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/10.1.0/nouislider.min.js"></script>
<script src="../wnumb-1.1.0/wNumb.js"></script>
<script>
    var slider = document.getElementById('slider');

    noUiSlider.create(slider, {
        start: [300, 1000],
        connect: true,
        tooltips: [wNumb({ decimals: 0 }), wNumb({ decimals: 0 })],
        range: {
            'min': 0,
            'max': 1300
        }
    });

    var slider2 = document.getElementById('slider2');

    noUiSlider.create(slider2, {
        start: [3],
        connect: [false, true],
        tooltips: [wNumb({ decimals: 1 })],
        range: {
            'min': 1,
            'max': 5
        }
    });

    slider.noUiSlider.on('update', function() {
        var valores = slider.noUiSlider.get();
        $("#menorPreco").val(valores[0]);
        $("#maiorPreco").val(valores[1]);
    });

    slider2.noUiSlider.on('update', function() {
        $("#estrelas").val(slider2.noUiSlider.get());
    });

</script>
</body>
</html>
