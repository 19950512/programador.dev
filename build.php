<?php


$controladores = scandir(__DIR__.'/src/Controllers/');

// Vamos pegar o conteúdo de cada controlador e colocar em uma pasta docs/nome-do-controlador minificado

foreach($controladores as $key => $controlador){
    if($controlador === '.' || $controlador === '..' || $controlador === 'Errors' || $controlador === 'Middlewares'){
        unset($controladores[$key]);
        continue;
    }

    $controller = str_replace('_', '-', strtolower($controlador));

    if($controller == 'index'){
        $controller = '';
    }

    file_put_contents(__DIR__."/docs/".(empty($controller) ? 'home' : $controller).".html", file_get_contents('http://programador.local/'.$controller));
}
