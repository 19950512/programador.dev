<?php

declare (strict_types = 1);

namespace App\Controllers\Errors;

use App\Controllers\Middlewares\Controller;

class Erro404Controller extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }


    public function index(): void
    {
        header("HTTP/1.0 404 Not Found");
    }
}

