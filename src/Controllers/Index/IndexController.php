<?php

declare (strict_types = 1);

namespace App\Controllers\Index;

use App\Controllers\Middlewares\Controller;

class IndexController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {
        echo $this->render('Index.Index');
        exit;
    }
}

