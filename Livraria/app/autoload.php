<?php
/*
    autoload - Responsável pelo carregamento automático das classes
*/
    // registra qualquer número de autoloaders, permitindo que classes e interfaces sejam automaticamente carregadas
    spl_autoload_register(function($classe){

        //lista de diretórios para buscar as classes
        $diretorios = [
            'Libraries',
            'Helpers'
        ];
        // percorre o diretório em busca das classes
        foreach($diretorios as $diretorio)
        {
            $arquivo = (__DIR__.DIRECTORY_SEPARATOR.$diretorio.DIRECTORY_SEPARATOR.$classe.'.php');
            if(file_exists($arquivo)) // verifica se o arquivo de classe existe
            {
                require_once $arquivo; // requere o arquivo de classe
            }
        }

    });