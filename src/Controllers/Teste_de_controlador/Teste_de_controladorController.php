<?php

declare (strict_types = 1);

namespace App\Controllers\Teste_De_Controlador;

use App\Controllers\Middlewares\Controller;

class Teste_De_ControladorController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        echo $this->render('Teste_de_controlador.Index');
        exit;
    }
}

