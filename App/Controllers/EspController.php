<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class EspController extends Action 
{

    public function home() 
    {

        $this->render('home','layout3');
    }

}

?>