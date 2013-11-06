<?php      
         class Connection {
            
            static public $banco = 'crud';
            static public $usuario = 'root';
            static public $senha = 'root';
            static public $hostname = 'localhost';
            
            static public function getBanco() {
                return self::$banco;
            }
            
            static public function getUsuario() {
                return self::$usuario;
            }
            
            static public function getSenha() {
                return self::$senha;
            }
            
            static public function getHostname() {
                return self::$hostname;
            }
 
        }