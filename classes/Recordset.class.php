<?php

class recordset{

                // DECLARA VARIAVEIS PUBLICAS
                private $banco;
                private $usuario;
                private $senha;
                private $hostname;
                private $db;

                public function connection(){
                    
                    if ($_SERVER['SERVER_NAME'] == 'localhost') {                         
                        require_once 'Connection.local.class.php';  
                    }else{
                        require_once 'Connection.global.class.php';  
                    }
                        
                    $this->banco = Connection::getBanco();
                    $this->usuario = Connection::getUsuario();
                    $this->senha = Connection::getSenha();
                    $this->hostname = Connection::getHostname();

                    // PATTERN SINGLETON
                    try {
                        if (!isset($this->db)) {                            
                            $this->db = new PDO(
                                                "mysql:host=$this->hostname;dbname=$this->banco;charset=utf8", 
                                                $this->usuario, 
                                                $this->senha, 
                                                array(
                                                  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                                                  PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8"
                                                )
                                              );
                            
                            
                        }     
                    } catch (PDOException $e) {
                        echo $e->getMessage();
                    }

                    return $this->db;

                }

                // FUNCAO DE RESGATE DE DADOS
                public function seleciona($sql){

                        $stmt = $this->db->prepare($sql);
                        $stmt->execute();
                        return $stmt;
                }

                // FUNCAO DE INSERCAO DE DADOS
                public function insertValuesBindParam ($tabela, $dados) {

                        // PEGAR CAMPOS DO ARRAY
                        $arrCampo = array_keys($dados);
                        // PEGAR VALORES DO ARRAY
                        $arrValores = array_values($dados);
                        // CONTAR OS CAMPOS DO ARRAY
                        $numCampo = count($arrCampo);
                        // CONTA OS VALORES DO ARRAY
                        $numValores = count($arrValores);
                        // VALIDACAO DOS CAMPOS
                        if($numCampo == $numValores){

                                // MONTANDO A QUERY SQL, PRIMEIRAMENTE OS CAMPOS DA TABELA
                                $sql = "INSERT INTO ".$tabela." (";
                                        foreach($arrCampo as $campo){
                                                $sql .= "$campo, ";
                                        }
                                $sql = substr_replace($sql, ")", -2, 1);

                                // MONTANDO AS REFERENCIAS PARA SEREM USADAS DO BINDPARAM
                                $sql .= "VALUES (";
                                foreach($arrCampo as $campo){
                                        $sql .= "?, ";
                                }

                                // RETIRANDO A ULTIMA VIRGULA E INSERINDO UM PARENTESE PARA SER FORMADO A QUERY CORRETAMENTE
                                $sql = substr_replace($sql, ")", -2, 1);                               
                                $stmt = $this->connection()->prepare($sql);                                
                                $stmt->execute($arrValores);

                                echo "Produto cadastrado com sucesso.";

                        } else {
                                echo "Erro ao checar os valores!";
                        }

                }
                            
                public function alterar($tabela, $dados, $string){
                        // PEGAR OS CAMPOS  DO ARRAY
                        $arrcampo = array_keys($dados);
                        // PEGAR OS VALORES DO ARRAY
                        $arrvalores = array_values($dados);
                        // CONTAR OS CAMPOS DO ARRAY
                        $numcampo = count($arrcampo);
                        // CONTA OS VALORES        DO ARRAY
                        $numvalores = count($arrvalores);
                        // CONSTRUCAO DA STRING
                        if($numcampo == $numvalores && $numvalores > 0){
                                $SQL = "UPDATE ".$tabela." SET ";
                                for($i = 0; $i < $numcampo; $i++){
                                         $SQL .= $arrcampo[$i]." = '".$arrvalores[$i]."',";
                                }
                                $SQL = substr_replace($SQL, " ", -1, 1);
                                $SQL .= " WHERE $string";
                        }else{
                                echo "Erro ao checar o banco de dados";        
                        }

                        $this->seleciona($SQL);
                }

                public function delete ($tabela, $string) {
                    $this->seleciona("DELETE FROM $tabela WHERE $string");
                }
        }