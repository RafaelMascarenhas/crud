<?php
        /*
         *  Sistema Munícipal de Planejamento, Orçamento e Gestão
         *  Copyright (C) 2011  Hiamina Tecnologia          
         *  www.hiamina.com.br              
         *  desenvolvimento@hiamina.com.br  
         * 
        */
        
        /*
         *  Arquivo original feito e disponibilizado por Gilberto Albino
         *  Modificado por Hiamina Tecnologia
         */
        
        class Paginator extends recordset {
            
            public $paginador = 'pag';        
            private $solicitador;
            public $sql;
            public $limite = 3;
            public $quantidade = 5;
            
            /*
             * CONSTRUTOR CARREGA A STRING USADA PARA COMO PAGINADOR
             */
            public function __construct() {
                $this->solicitador = @$_REQUEST["{$this->paginador}"];                
            }
            
            /*
             * RETORNA O NUMERO DE RESULTADOS ENCONTRADOS
             */
            public function resultado() {
                $this->resultado = $this->connection()->query(str_replace('*', 'COUNT(*)', $this->sql));
                $this->numeroResultados = $this->resultado->fetchColumn();
                return $this->numeroResultados;
            }
            
            /*
             * IMPRIME UM TEXTO AMIGAVEL MOSTRANDO O STATUS DAS PAGINAS EM RELACAO AO RESULTADO ATUAL
             */
            public function imprimeBarraResultados() {                
                if($this->resultado() > 0) {
                    echo '<p class="info_resultado_busca">';
                        echo 'Exibindo p&aacute;gina <b style="font-size:14px">' . $this->paginaAtual()  . '</b> de <b style="font-size:14px">' . $this->paginasTotais() . '</b> dispon&iacute;veis para <b style="font-size:14px">'.$this->resultado().'</b> resultados encontrados.';
                    echo '</p>';
                } else {
                        echo '  
                                      <div class="alert alert-error">
                                            <button type="button" class="close" data-dismiss=alert />x</button>
                                            Não foram encontrados resultados para sua busca.                                                                                                
                                      </div>
                              ';
                        
                }        
            }
        
            /*
             * CALCULA O NUMERO TOTAL DE PAGINAS
             */
            public function paginasTotais() {                
                $paginasTotais = ceil($this->resultado() / $this->limite);
                return $paginasTotais;
            }
        
            /*
             * PROCURA O NUMERO DA PAGINA ATUAL
             */
            public function paginaAtual() {
                if (isset($this->solicitador) && is_numeric($this->solicitador)) {                 
                        $this->paginaAtual = (int) $this->solicitador;
                } else {
                        $this->paginaAtual = 1;
                }

                if ($this->paginaAtual > $this->paginasTotais()) {
                        $this->paginaAtual = $this->paginasTotais();
                }

                if ($this->paginaAtual < 1) {
                        $this->paginaAtual = 1;
                }

                return $this->paginaAtual;
                
            }
        
            /*
             * CALCULA O OFFSET DA CONSULTA
             */
            private function offset() {
                $offset = ($this->paginaAtual() - 1) * $this->limite;        
                return $offset;
            }
            
            /*
             * RETORNA O SQL PARA TRABALHAR POSTERIORMENTE
             */
            public function sql() {
                $sql = $this->sql .  " LIMIT {$this->limite} OFFSET {$this->offset()} ";
                return $sql;
            }
            
            /*
             * IMPRIME A BARRA DE NAVEGACAO DA PAGINACAO USANDO BOOTSTRAP
             */
            public function imprimeBarraNavegacao() {
                if($this->resultado() > 0) {                
                        echo '<div class="pagination">';
                            echo '<ul>';
                        if ($this->paginaAtual() > 1) {
                                echo " <li><a href='?" . $this->paginador . "=1"  . $this->reconstruiQueryString($this->paginador) . "'>Primeiro</a></li> ";
                                $anterior = $this->paginaAtual() - 1;
                                echo " <li><a href='?" . $this->paginador . "=" . $anterior . $this->reconstruiQueryString($this->paginador) . "'>&laquo;</a></li> ";
                        }

                        for ($x = ($this->paginaAtual() - $this->quantidade); $x < (($this->paginaAtual() + $this->quantidade) + 1); $x++) {
                                if (($x > 0) && ($x <= $this->paginasTotais())) {
                                        if ($x == $this->paginaAtual()) {
                                                echo "<li class=\"active\"><a href=\"#\">$x</a></li>";
                                        } else {
                                                echo " <li><a href='?" . $this->paginador . "=" . $x . $this->reconstruiQueryString($this->paginador) . "'>$x</a></li> ";
                                        }
                                }
                        }
                        
                        if ($this->paginaAtual() != $this->paginasTotais()) {
                                $paginaProxima = $this->paginaAtual() + 1;
                                echo " <li><a href='?" . $this->paginador . "=" . $paginaProxima . $this->reconstruiQueryString($this->paginador) . "'>&raquo;</a></li> ";
                                echo " <li><a href='?" . $this->paginador . "=" . $this->paginasTotais() . $this->reconstruiQueryString($this->paginador) . "'>&Uacute;ltimo</a></li> ";
                        }
                            echo '</ul>';
                        echo '</div>';                        
                }        
            }
            
            /*
             * MONTA OS VALORES DA QUERY STRING NOVAMENTE
             */
            public function reconstruiQueryString($valoresQueryString) {
                if (!empty($_SERVER['QUERY_STRING'])) {
                        $partes = explode("&", $_SERVER['QUERY_STRING']);
                        $novasPartes = array();
                        foreach ($partes as $val) {
                                if (stristr($val, $valoresQueryString) == false)  {
                                        array_push($novasPartes, $val);
                                }
                        }
                        if (count($novasPartes) != 0) {
                                $queryString = "&".implode("&", $novasPartes);
                        } else {
                                return false;
                        }
                        return $queryString; // NOVA STRING CRIADA
                } else {
                        return false;
                }
            }
            
}