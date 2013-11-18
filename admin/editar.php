<?php
  $id = $_GET['id'];
  $string = "id = ".$id;
  if($_POST)
  {
    $msg = '<div class="alert alert-success"><span>Produto alterado com sucesso!</span></div>';
  }
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
              <li class="active"><a href="index.php">Home</a></li>
          </div><!--/.nav-collapse -->
        </div>
      </div>

    <div class="container" >
      <div class="tabela">
        <h2>Editar produto</h2>
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
    $conecta->alterar("produto", $dados, $string);
  }
    $paginacao->sql = "SELECT * from produto WhERE id = '".$id."'";
    $resultado = $conecta->connection()->query($paginacao->sql());
    $linha = $resultado->fetch(PDO::FETCH_ASSOC);
?>
	      <?php echo @$msg;?>
	      <br>
        <form action='' method='post'>
          Empresa:
	        <br><input name='empresa' value="<?php echo $linha['empresa'];?>" type='text' class='form-control' placeholder='Empresa'  autofocus>
	        Produto:
          <br><input name='produto' value="<?php echo $linha['produto'];?>" type='text' class='form-control' placeholder='Produto'  autofocus>
	        Setor:
          <br><input name='setor' value="<?php echo $linha['setor'];?>" type='text' class='form-control' placeholder='Setor'  autofocus>
	        Segmento:
          <br><input name='segmento' value="<?php echo $linha['segmento'];?>" type='text' class='form-control' placeholder='Segmento'  autofocus>
	        Marca:
          <br><input name='marca' value="<?php echo $linha['marca'];?>" type='text' class='form-control' placeholder='Marca'  autofocus>
	        Descrição:
          <br><input name='descricao' value="<?php echo $linha['descricao'];?>" type='text' class='form-control' placeholder='Descrição'  autofocus>
          <br>  
          <button type='submit'class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Editar </button>
          <div class="btn-group">
            <a href="index.php" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Cancelar</a>
          </div>
        </form>
    </div>
  </body>
</html>
