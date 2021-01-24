<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PublicationController extends Controller{
    public function indexAction(Request $request){
        //echo "Accion index publications";
        //para no llamar a ninguna vista
        //die();
        return $this->render('AppBundle:Publication:home.html.twig');
    }
}
