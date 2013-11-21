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
            <a class="navbar-brand" href="#">Produtos</a>
          </div>

          <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="#">Home</a></li>
            </ul>
            <ul class='nav navbar-nav navbar-right'> 
              <li>
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-male"></i><?php echo ' '.$_SESSION['nome'].' '?><b class="caret"></b></a>
                <ul class="dropdown-menu">
                <li><a href="adicionar.php">Editar perfil</a></li>
                <li class="divider"></li>
                <li><a href="logout.php">Sair</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    <div class="container" >
      <div class="tabela col-md-3">
        <h2>Adicionar produto</h2>
	      <br><br><br>
<?php
 if(!empty($_POST))
 {
 // MONTANDO UM ARRAY PARA O INSERT
    $dados = array(     // gmdate()  RETORNA A HORA DO MERIDIANO GREENWICH
                        'empresa'=>$_POST['empresa'],
                        'produto'=>$_POST['produto'],
                        'setor'=>$_POST['setor'],
                        'segmento'=>$_POST['segmento'],
                        'marca'=>$_POST['marca'],
                        'descricao'=>$_POST['descricao']
    );
                                                                                                                                                                                                                                                                                                
    // CHAMAMOS A CLASE DE INSERCAO
    $conecta->insertValuesBindParam("produto", $dados);
  }
?>        
	      <?php echo @$msg;?>
	      <br>
        <div class="input-group ">
        Insira as informações necessárias:<br>
        <form action='' method='post'>
	        <br><input name='empresa' type='text' class='form-control' placeholder='Empresa'  autofocus><br>
	        <br><input name='produto' type='text' class='form-control' placeholder='Produto'  autofocus><br>
	        <br><input name='setor' type='text' class='form-control' placeholder='Setor'  autofocus><br>
	        <br><input name='segmento' type='text' class='form-control' placeholder='Segmento'  autofocus><br>
	        <br><input name='marca' type='text' class='form-control' placeholder='Marca'  autofocus><br>
	        <br><input name='descricao' type='text' class='form-control' placeholder='Descrição'  autofocus><br>
          <br>  
          <button type='submit'class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Gravar </button>
          <div class="btn-group">
            <a href="index.php" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Cancelar</a>
          </div>
        </form>
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
