<?php

namespace BackendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        //Cargamos la entity manager
        //Con esta linea cargamos el gestor de entidades en nuestro bundle 
        $em = $this->getDoctrine()->getManager();
        
        //cargamos la entidad especifica que queremos usar del bundle especifico
        $user_repo = $em->getRepository("BackendBundle:User");
        //llamamos a la primera instancia de la entidad User
        $user = $user_repo->find(1);
        echo "Bienvenido ".$user->getName()." ".$user->getSurname()."\n"; 
        var_dump($user);
        die();
        return $this->render('BackendBundle:Default:index.html.twig');
    }
}
