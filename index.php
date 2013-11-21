<?php
  function __autoload($classe) 
  {
    if (file_exists("classes/{$classe}.class.php")) 
    {
      include_once "classes/{$classe}.class.php"; 
    }
  }             

        /*
         * CLASSE DE REGISTROS E CONEXAO
         */

        if(!empty($_POST)){
          $login = new Login($_POST['pass'], $_POST['user']);
        }
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

        <title> Login </title>

        <!-- Bootstrap core CSS -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet">

        <!-- Custom styles for this template -->
        <link href="css/style.css" rel="stylesheet">

        <!-- Just for debugging purposes. Don't actually copy this line! -->
        <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
          <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
          <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
        <![endif]-->
      </head>

      <body>

        <div class="container">

          <?php
            if(!empty($_POST)){
              echo $login->getMsgAlert();
            }

        ?> 


          <form action="#" method="post" class="form-signin">
            <h2 class="form-signin-heading">Faça o login aqui:</h2>
            <input name="user" type="text" class="form-control" placeholder="Email"  autofocus>
            <input name="pass" type="password" class="form-control" placeholder="Senha" >
            <label class="checkbox">
              <input type="checkbox" value="remember-me"> Lembrar senha
            </label>
            <button class="btn btn-lg btn-primary btn-block" type="submit">Entrar</button>
          </form>

        </div> <!-- /container -->


        <!-- Bootstrap core JavaScript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
      </body>
    </html>
