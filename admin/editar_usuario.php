<?php
  session_start();

  function __autoload($classe) 
  {
    if (file_exists("../classes/{$classe}.class.php")) 
    {
      include_once "../classes/{$classe}.class.php"; 
    }
  }             

        /*
         * CLASSE DE REGISTROS E CONEXAO
         */
        $conecta = new Recordset();
        $conecta->connection();
        $paginacao = new Paginator();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="../../docs-assets/ico/favicon.png">

    <title>Admin</title>

    <!--Carregando o fonte awesome-->
    <link href="../bootstrap/font-awesome-4.0.3/css/font-awesome.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="../bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/style.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/sticky-footer-navbar.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

    <!-- Wrap all page content here -->
    <div id="wrap">

      <!-- Fixed navbar -->
      <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">CRUD</a>
          </div>
          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="index.php">Home</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Produtos <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="adicionar.php">Adicionar</a></li>
                  <li><a href="produtos.php">Listar</a></li>
                </ul>
              </li>               
            </ul>
            <ul class='nav navbar-nav navbar-right'> 
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-male"></i><?php echo ' '.$_SESSION['nome'].' '?></a>

              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    <div class="container" >
      <div class="tabela col-md-3">
        <h2>Editar usuário</h2>
	      <br>
<?php
 if(!empty($_POST))
 {
 // MONTANDO UM ARRAY PARA O INSERT
    $dados = array(     // gmdate()  RETORNA A HORA DO MERIDIANO GREENWICH
                        'nome'=>$_POST['nome'],
                        'usuario'=>md5($_POST['usuario']),
                        'senha'=>md5($_POST['senha'])
    );

    $string = "id = ".$_SESSION['id'];                                                                                                                                                                                                                                                                                           
    // CHAMAMOS A CLASE DE INSERCAO
    if($_POST['senha'] == $_POST['senha2'])
    {
      $conecta->alterar("autenticacao", $dados, $string);
      $msg = '<div class="alert alert-success"><span>Usuário alterado com sucesso!</span></div>';
    }
  }
    $paginacao->sql = "SELECT * from autenticacao WhERE id = '".$_SESSION['id']."'";
    $resultado = $conecta->connection()->query($paginacao->sql());
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
?>
	      <?php echo @$msg;?>
        <div class="class='col-xs-13 col-sm-3'">
        Modifique os campos desejados:<br><br>
        <form action='' method='post'>
          Nome:
	        <br><input name='nome' value="<?php echo $linha['nome'];?>" type='text' class='form-control' placeholder='Empresa' required autofocus>
          Usuário:
          <br><input name='usuario' type='text' class='form-control' required autofocus>
	        Senha:
          <br><input name='senha' type='password' class='form-control' required autofocus>
          Confirmação de senha:
          <br><input name='senha2' type='password' class='form-control' required autofocus>
          <br><br>  
          <button type='submit'class="btn btn-primary"><i class="icon-plus-sign icon-white"></i>Editar </button>
          <div class="btn-group">
            <a href="index.php" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Cancelar</a>
          </div>
        </form>
        <br>
      </div>
    </div>
  </div>
</div>
    <div id="footer">
      <div class="container" align='center'>
        <p class="text-muted credit">CRUD - Create, read, update and delete. Por <a href="#">Rafael Mascarenhas de Oliveira Souza</a> estagiário da Hiamina Tecnologia. 2013</p>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="../js/jquery.js"></script>

    <script src="../js/bootstrap-tooltip.js"></script>
    <script src="../bootstrap/js/bootstrap.min.js"></script>
    <script src="../js/custom.js"></script>
  </body>
</html>
