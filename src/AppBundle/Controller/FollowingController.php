<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\User;
use BackendBundle\Entity\Following;
use Symfony\Component\HttpFoundation\Session\Session;

class FollowingController extends Controller {

    private $session;

    //Este es el primer metodo que se lanza al instanciar un objeto
    public function __construct() {
        $this->session = new Session();
    }
    
    public function followAction(Request $request){
        //$this->getUser() recogemos informacion del usuario que esta logeado actualmente
        $user = $this->getUser();
        //recogemos un valor del request con el nombre followed que contiene el id del usuario
        //que queremos seguir
        $followed_id = $request->get("followed");
        
        //cargamos l entity Manager
        $em = $this->getDoctrine()->getManager();
        
        //cargamos el repositorio de user
        $user_repo = $em->getRepository("BackendBundle:User");
        
        //encontramos al usuario que queremos seguir mediante el request
        $followed = $user_repo->find($followed_id);
        
        //creamos una instancia de la entidad Following a la cual vamos a guardar en DB
        $following = new Following();
        
        //configurmos los valores que tendra nuestra nueva instancia y se subira a la DB
        $following->setUser($user);
        $following->setFollowed($followed);
        
        //persistimos el objeto following en el doctrine
        $em->persist($following);
        
        // guardamos el objeto en la DB
        $flush = $em->flush();
        
        //si flush no devuelve nada es que se realizo la operacion correctamente
        if($flush == null){
            $status = "Ahora estás siguiente a este usuario !! ";
        }else{
            $status = "No se ha podido seguir a este usuario !!";
        }
        //se retorna response para evitar redirecciones a otro sitio, sino mas bien un solo mensaje
        //en la misma vista
        return new Response($status);
        //echo "Aqui esta follow";
        //die();
    }
    public function unfollowAction(Request $request){
        //$this->getUser() recogemos informacion del usuario que esta logeado actualmente
        $user = $this->getUser();
        //recogemos un valor del request con el nombre followed que contiene el id del usuario
        //que queremos seguir
        $followed_id = $request->get("followed");
        
        //cargamos l entity Manager
        $em = $this->getDoctrine()->getManager();
        
        //cargamos el repositorio de following
        $followed_repo = $em->getRepository("BackendBundle:Following");
        
        //Obtenemos una instncia de following como followed
        $followed = $followed_repo->findOneBy(array(
                            "user"=>$user,
                            "followed"=>$followed_id));
        //borramos al objeto followed en el doctrine
        $em->remove($followed);
        
        // borramos el objeto en la DB
        $flush = $em->flush();
        
        //si flush no devuelve nada es que se realizo la operacion correctamente
        if($flush == null){
            $status = "Haz dejado de seguir a este usuario !!";
        }else{
            $status = "No se ha podido dejar de seguir a este usuario !!";
        }
        //se retorna response para evitar redirecciones a otro sitio, sino mas bien un solo mensaje
        //en la misma vista
        return new Response($status);
        //echo "Aqui esta follow";
        //die();
    }
}
