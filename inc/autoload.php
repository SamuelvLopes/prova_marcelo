<?php
    // codificação utf-8
    define("PASTA_DO_SISTEMA", dirname(dirname(__FILE__))); // retorna o diretório raiz da aplicação    
    function __autoload($strNomeClasse){
        $strStrDir = array(
            // básico (sempre deve existir)
            PASTA_DO_SISTEMA."/conexao/"
            , PASTA_DO_SISTEMA."/classes/modelo/"
            , PASTA_DO_SISTEMA."/classes/negocio/"
            , PASTA_DO_SISTEMA."/classes/repositorio/"
            
        );
        for($intI=0; $intI<count($strStrDir);$intI++){
            if(file_exists($strStrDir[$intI].$strNomeClasse.".php")){
                require_once $strStrDir[$intI].$strNomeClasse.".php";
            }
        }
    }    
?>