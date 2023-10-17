<?php

declare (strict_types = 1);

namespace App\Controllers\Jiu_Jitsu;

use App\Controllers\Middlewares\Controller;

class Jiu_jitsuController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index(): void
    {


        $pathImagensJiuJitsu = __DIR__.'/../../Public/jiujitsu';

        if(is_dir($pathImagensJiuJitsu)){

            $imagensTemp = scandir($pathImagensJiuJitsu);

            $imagens = [];
            foreach($imagensTemp as $image){
                if($image !== '.' && $image !== '..'){
                    $imagens[] = $image;
                }
            }
        }


        echo $this->render('Jiujitsu.Index', [
            'teste' => 'kkkkkkk',
            'imagens' => json_encode($imagens ?? [])
        ]);
        exit;
    }
}

