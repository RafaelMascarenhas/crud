<?php
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
              <li class="active"><a href="#">Home</a></li>
              <li><a href="#about">Sobre</a></li>
              <li><a href="#contact">Contato</a></li>
              <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Acão <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="adicionar.php">Adicionar</a></li>
                  <li><a href="editar.php">Editar</a></li>
                  <li><a href="#">Deletar</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Opções</li>
                  <li><a href="#">Outro link</a></li>
                  <li><a href="#">Outro link 2</a></li>
                </ul>
              </li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>

      <!-- Begin page content -->
        <div class="page-header">
          <h1 align="center" >Tabela de produtos</h1>
        </div>
        <p align='center' class="lead">Adicione, altere ou delete produtos:</p>
    </div>

    <div id="footer">
      <div class="container">
          <div class="container">
      <div class="row-fluid">
        <div class="span12">
            <div class="pull-right">
              <div class="btn-group">
                <a href="adicionar.php" class="btn btn-warning"><i class="icon-plus-sign icon-white"></i>Novo <span class="glyphicon glyphicon-plus"></span></a>
              </div>
            </div>
            <h3>Lista de produtos</h3>
          <div class="row-fluid">
            <div class="span9">
              <form>  
              <table class="table table-striped table-bordered ">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Empresa</th>
                    <th>Produto</th>
                    <th>Setor</th>
                    <th>Segmento</th>
                    <th>Marca</th>
                    <th>Descrição</th>
                    <th>Ação</th>
                    <th>
                    <input class="check_all" type="checkbox">
                    </th>
                  </tr>
                </thead>
                <tbody>
<?php
      $paginacao->sql = "SELECT * from produto";
      $paginacao->limite = 3;                                                                                
      $resultado = $conecta->connection()->query($paginacao->sql());
      while($linha = $resultado->fetch(PDO::FETCH_ASSOC)) {
?>
                  <tr>
                    <td><?php echo $linha['id'];?></td>
                    <td width="15%"><a data-original-title="Put Some Information Here" href="#" class="tooltip-right"><?php echo $linha['empresa'];?></a></td>
                    <td><i class="icon-file"></i><?php echo $linha['produto'];?></td>
                    <td><?php echo $linha['setor'];?></td>
                    <td><?php echo $linha['segmento'];?></td>
                    <td><?php echo $linha['marca'];?></td>
                    <td><?php echo $linha['descricao'];?></td>
                    <td width="15%">
                    <div class="btn-group">
                      <a data-original-title="Editar" href="editar.php?id=<?php echo $linha['id']; ?>" class="tooltip-top btn"><i class="icon-list-alt"><span class="glyphicon glyphicon-wrench"></span></i></a>
                    </div></td>
                    <td width="1%">
                    <input type="checkbox">
                    </td>
                  </tr>
<?php
      }
                  $paginacao->imprimeBarraResultados();
?>
                </tbody>
              </table>
<?php
              $paginacao->imprimeBarraNavegacao();
?>
              <div class="pull-right">
                <button type="button" class="delete btn btn-warning">
                  <i class="icon-white icon-trash"></i> Delete Checked Box
                </button>
              </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <hr>
      <footer>
        <br><br><br><br><br><br><br>
      </footer>
    </div>
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