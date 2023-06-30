<?php

declare (strict_types = 1);

namespace App\Controllers\Middlewares;

use eftec\bladeone\BladeOne;

abstract class Controller
{

    // GET - POST - PUT - DELETE - PATCH
    public $method;
    
    public BladeOne $blade;
    public array $bladeVariables = [];

    public function __construct()
    {
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';

        $this->blade = new BladeOne(
            templatePath: __DIR__."/../../Templates",
            compiledPath:  __DIR__."/../../Templates/Compiled",
        );

        $this->blade->setMode(BladeOne::MODE_AUTO);
        
        $this->bladeVariables = [];
    }

    public function render(string $bladeTemplate, array $variableCustom = []): string
    {
        return $this->blade->run($bladeTemplate, [...$variableCustom,...$this->bladeVariables]);
    }
}
