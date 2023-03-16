<?php

namespace App\Controllers;

//os recursos do miniframework
use App\Models\Usuario;
use MF\Controller\Action;
use MF\Model\Container;

class AuthController extends Action 
{


    //A função autenticar ela além de verificar se o email e senha estão corretos no banco de dados ele tambem verifica se a conta 
    //é do tipo 1(moderador) ou do tipo 2 (especialista) e encaminha para a pagina correta
    public function autenticar()
    {
        $usuario = Container::getModel('Usuario');

        $usuario->__set('email', $_POST['email']);
        $usuario->__set('senha', md5($_POST['senha']));

        $autenticado = $usuario->autenticar();
        
        
        if($autenticado && $usuario->__get('tipo') == 1)
        {
            session_start();

            $_SESSION['tipo'] = 1;
            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');
            $_SESSION['email'] = $usuario->__get('email');

            header('Location: /adm/home');
        }else if($autenticado && $usuario->__get('tipo') == 2)
        {
            session_start();

            $_SESSION['tipo'] = 2;
            $_SESSION['id'] = $usuario->__get('id');
            $_SESSION['nome'] = $usuario->__get('nome');
            $_SESSION['email'] = $usuario->__get('email');

            header('Location: /esp/home');
        }else{
            
            header('Location: /?login=erro');
        }
        
    }

    public function sair()
    {
        session_start();
        session_destroy();

        header('Location: /');
    }

    public function trocar()
    {
        $usuario = Container::getModel('Usuario');

        $usuario->__set('id', $_SESSION['id']);
        $usuario->__set('senha', md5($_POST['senha']));
        //$usuario->verificarSenha($usuario('id'), $usuario('senha'));

        echo $usuario['id'];

    
    }
}

?>