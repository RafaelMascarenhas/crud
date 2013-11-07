<?php
        /*
         *  Sistema Municipal de Planejamento, Orcamento e Gestao | Copyright (C) 2012
         *  Copyright (C) 2011  Hiamina Tecnologia          
         *  www.hiamina.com.br              
        */
        
        /**
         * Login - CLASSE QUE PROVE OS METODOS DE AUTENTICACAO DE USUARIO
         * @author Hiamina Tecnologia
         * @copyright 2013 - Hiamina Tecnologia
        */
        class Login extends Recordset {
            
            
            ////////////////////////////////////////////////
            //
            //  ATRIBUTOS
            //
            ////////////////////////////////////////////////
            /**
            *   ATRIBUTO USADO PARA GUARDAR NOME DE USUARIO PARA AUTENTICACAO
            *   @var string
            */
            private $usuario;

            /**
            *   ATRIBUTO USADO PARA GUARDAR SENHA PARA AUTENTICACAO
            *   @var string
            */
            private $senha;

            public $msgalert;

                       
            /**
             *  METODO CONSTRUTOR PASSANDO OS VALORES DE USUARIO E SENHA PARA OS ATRIBUTOS  
             *  FAZENDO UMA VALIDACAO, DEPOIS CRIPTOGRAFA OS DADOS E CHAMA O METODO autenticar()
             *   @param string $password
             *   @param string $usuario
             */
            public function __construct ($password, $usuario) {
                

                // VALIDANDO DADOS VAZIOS, SETANDO O TIPO DE ALERTA E PASSANDO PARA O METODO getMsgAlert()
                if ( empty( $password ) || empty ( $usuario ) ) {

                    // TIPO DE ALERTA PARA USUARIO E SENHA VAZIOS
                    $this->typeAlert (8);

                } else {

                    // CRIPTOGRAFANDO OS DADOS
                    $this->usuario = md5($usuario);
                    $this->senha = md5($password);

                    // METODO AUTENTICAR, RESPONSAVEL POR VALIDAR OS DADOS VINDOS DO POST E VERIFICAR A AUTENTICIDADE
                    $this->autenticar();
                }
                    
            }


            
            /**
             *  RESPONSAVEL POR VALIDAR OS DADOS VINDOS DO POST E VERIFICAR A AUTENTICIDADE
             *  @access private
             */
            private function autenticar ( ) {
                    // FAZENDO CONSULTA NO BANCO PARA VER A AUTENTICIDADE DOS DADOS RECEBIDOS
                    $stmt = $this->connection()->prepare("SELECT * FROM autenticacao WHERE usuario=:usuario AND senha=:senha");
                    $stmt->bindParam(":usuario", $this->usuario);
                    $stmt->bindParam(":senha", $this->senha);
                    $stmt->execute();
                    $total = $stmt->rowCount();
                    $row = $stmt->fetch(PDO::FETCH_OBJ);
                    // ESCOPO PARA DADOS INTEGROS
                    if ($total > 0) {
                        // INICIA SESSAO
                        session_start();
                        // GRAVA OS DADOS DO USUARIO AUTENTICADO NA SESSAO
                        $_SESSION['id'] = $row->id;
                        $_SESSION['nome'] = $row->nome;
                        header("Location: administrador/andamentos/relacao_processos.php?processo=1&pag=1");
                    } else {
                        // TIPO DE ALERTA PARA DADOS INCORRETOS
                        $this->typeAlert (9);
                    }
            }

            public function getMsgAlert () {
                return $this->msgalert;
            }

            /**
             *  METODO RESPONSAVEL EM GERAR OS ALERTAS DE ERRO OU SUCESSO
             *  @access public
             *  @param int $error
             */
            public function typeAlert ( $error ) {

                switch ( $error ) {
                    case 8:
                        // MSG PARA USUARIO E SENHA VAZIOS
                        $this->msgalert =  '<div id="msgerro">
                                                <div class="englobamsgcad2">
                                                        <span>Nome de usu&aacute;rio e senha s&atilde;o obrigat&oacute;rios</span>
                                                </div> <!-- FIM DE ENGLOBAMSGCAD2 -->
                                            </div> <!-- FIM DE MSGERRO -->';
                       // $this->setMsgType (8);                  
                        break;

                    case 9:
                        // MSG PARA USUARIO E SENHA VAZIOS
                        $this->msgalert =  '<div id="msgerro">
                                                <div class="englobamsgcad2">
                                                        <span>Dados incorretos!</span>
                                                </div> <!-- FIM DE ENGLOBAMSGCAD2 -->
                                            </div> <!-- FIM DE MSGERRO -->';
                       // $this->setMsgType (9);              
                        break;
                    default:
                        # code...
                        break;
                }

            }
            
        }