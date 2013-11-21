<?php
  $id = $_GET['id'];
  $string = "id = ".$id;
  
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
                                                                                                                                                                                                                                                                                        
  // CHAMAMOS A CLASE DE INSERCAO
  $conecta->delete("produto", $string);


   header('Location: index.php?deletar=sim');
