<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\User;
use AppBundle\Form\RegisterType;
use AppBundle\Form\UserType;
use Symfony\Component\HttpFoundation\Session\Session;

class UserController extends Controller {

    private $session;

    //Este es el primer metodo que se lanza al instanciar un objeto
    public function __construct() {
        $this->session = new Session();
    }

    public function loginAction(Request $request) {
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }
        //De las configuraciones hechas en el security.yml podemos llamar a este nuevo recurso
        //que nos devuelve una instancia de  la clase AuthenticationUtils y a su vez nos provee
        //algnasa funciones para obtencion de errores o de ultimos usuarios en sesion
        $authenticationUtils = $this->get('security.authentication_utils');
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        //echo "Accion login";
        //para no llamar a ninguna vista
        //die();
        return $this->render('AppBundle:User:login.html.twig', array(
                    "last_username" => $lastUsername,
                    "error" => $error
        ));
    }

    public function registerAction(Request $request) {
        if (is_object($this->getUser())) {
            return $this->redirect('home');
        }

        #nueva instancia de usuario en la cual guardaremos los datos del form
        $user = new User();
        #formulario crado a partir de  la clase RegisterType e introducido en la vista
        $form = $this->createForm(RegisterType::class, $user);

        //enlazar el request mediante el metodo post con el formulario y posteriormente con la
        //instancia de usuario
        $form->handleRequest($request);

        //Si el fomulario es enviado
        if ($form->isSubmitted()) {

            //Formulario valido y listo para el envio
            if ($form->isValid()) {

                //em = entity manager para gestionar los datos en la DB
                $em = $this->getDoctrine()->getManager();
                //caragar una entidad(User) a la cual se puede realizar los diferentes tipos
                //de acciones
                //$usr_repo = $em ->getRepository("BackendBundle:User");
                //crear una query usando la entity manager para buscar si ya existe un usuario
                // con ese email y nick
                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                        ->setParameter('email', $form->get("email")->getData())
                        ->setParameter('nick', $form->get("nick")->getData());
                //con la función getResult() obtenemos el resultado de un query
                $user_isset = $query->getResult();

                if (count($user_isset) == 0) {
                    //creamos el usuario
                    //primero codificamos la contraseña usando el servicio security
                    //encoder_Factory es un servicio que provee symfony
                    $factory = $this->get("security.encoder_factory");

                    //obtenemos el encoder que tiene la clase factory
                    $encoder = $factory->getEncoder($user);

                    //obtenemos el metodo encodePassword del encoder,
                    //**notar que se introduce como parametro la data del formulario y
                    //y el metodo getsalt() de la clase src/BackendBundle/Entity/user
                    //si no estan los metodos antes mencionados en user agregarlos 
                    $password = $encoder->encodePassword($form->get("password")->getData(), $user->getSalt());

                    $user->setPassword($password);
                    $user->setRole("ROLE_USER");
                    $user->setImage(null);

                    //persiste el objeto user en la entity manager
                    $em->persist($user);
                    //guardamos todos los datos persistidosv  en la entity manager en la DB
                    $flush = $em->flush();
                    if ($flush == null) {
                        $status = "Te has registrado correctamente";
                        $this->session->getFlashBag()->add("status", $status);
                        return $this->redirect("login");
                    } else {
                        $status = "Hubo un error al crear el usuario, por favor, intentalo más tarde.";
                    }
                } else {
                    // ya existe el usuario
                    $status = "El usuario ya existe !!";
                }
            } else {
                $status = "Envio de formulario fallido, por favor, intentelo más tarde.";
            }
            $this->session->getFlashBag()->add("status", $status);
        }
        return $this->render('AppBundle:User:register.html.twig', array(
                    "form" => $form->createView()
        ));
    }

    public function nickTestAction(Request $request) {
        $nick = $request->get('nick');

        $em = $this->getDoctrine()->getManager();
        //del entity manager buscamos cargamos los daos de la entidad User en DB 
        //y la colocamos como user_repo
        $user_repo = $em->getRepository("BackendBundle:User");
        //buscamos un usuaro que tenga el nick igual al pasado en la variable $nick
        $user_isset = $user_repo->findBy(array("nick" => $nick));
        $result = "used";
        //echo("Hola-------------------------------------------------->");
        //echo($user_isset);
        if (count($user_isset) >= 1) {//&& is_object($user_isset)
            $result = "used";
        } else {
            $result = "unused";
        }
        //retornamos un response para poder manipular una solicitud por url y post
        return new Response($result);
    }

    public function editUserAction(Request $request) {
        #nueva instancia de usuario en la cual guardaremos los datos del form
        $user = $this->getUser();
        $user_image = $user->getImage();
        #formulario crado a partir de  la clase RegisterType e introducido en la vista
        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        //Si el fomulario es enviado
        if ($form->isSubmitted()) {

            //Formulario valido y listo para el envio
            if ($form->isValid()) {

                //em = entity manager para gestionar los datos en la DB
                $em = $this->getDoctrine()->getManager();
                
                $query = $em->createQuery('SELECT u FROM BackendBundle:User u WHERE u.email = :email OR u.nick = :nick')
                        ->setParameter('email', $form->get("email")->getData())
                        ->setParameter('nick', $form->get("nick")->getData());
                
                $user_isset = $query->getResult();

                if (count($user_isset) == 0 || ($user->getEmail()== $user_isset[0]->getEmail() && $user->getNick()== $user_isset[0]->getNick())) {
                    //upload file
                    $file = $form['image']->getData();
                    if (!empty($file) && $file!=null){
                        $ext = $file->guessExtension();
                        if($ext=='jpg' || $ext=='jpeg' || $ext=='png' || $ext=='gif'){
                            $file_name = $user->getId().time().'.'.$ext;
                            $file->move("uploads/users",$file_name);
                            $user->setImage($file_name);
                        }
                    }else{
                        $user->setImage($user_image);
                    }
                    

                    //persiste el objeto user en la entity manager
                    $em->persist($user);
                    //guardamos todos los datos persistidosv  en la entity manager en la DB
                    $flush = $em->flush();
                    if ($flush == null) {
                        $status = "Datos modificados correctamente";
                    } else {
                        $status = "Hubo un error al modificar el usuario, por favor, intentalo más tarde.";
                    }
                } else {
                    // ya existe el usuario
                    $status = "El usuario ya existe !!";
                }
            } else {
                $status = "Envio de formulario fallido, por favor, intentelo más tarde.";
            }
            $this->session->getFlashBag()->add("status", $status);
            return $this->redirect('my-data');
        }

        return $this->render('AppBundle:User:edit_user.html.twig', array(
                    //createView() nos genera el html del formulario
                    "form" => $form->createView()
        ));
    }
    public function usersAction(Request $request){
        //obtenemos una instancia de la entity manager
        $em = $this->getDoctrine()->getManager();
        //Query en lenguaje sql
        $dql = "SELECT u FROM BackendBundle:User u ORDER BY u.id ASC";
        //hacemos la consulta y la guardamos en $query
        $query = $em->createQuery($dql);
        
        //obtenemos una instancia de paginator d knpPaginator
        $paginator =  $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                                            $query,
                                            $request->query->getInt('page',1),
                                            5);
        return $this->render('AppBundle:User:users.html.twig',array(
                'pagination'=> $pagination
            )
        );
        //var_dump("Esta es la lista de gente que tienes como contacto");
        //die();
    }
    public function searchAction(Request $request){
        //obtenemos una instancia de la entity manager
        $em = $this->getDoctrine()->getManager();
        //Query en lenguaje sql
        
        $search = $request->query->get("search",null);
        if($search == null){
            return $this->redirect($this->generateUrl("home_publication"));
        }
        //notese el parametro search como es introducido en el query,
        //ojo con los espacios en los queries searchORDER BY (MAL), search ORDER BY (BIEN).
        $dql = "SELECT u FROM BackendBundle:User u "
                . "WHERE u.name LIKE :search OR u.surname LIKE :search OR u.nick LIKE :search"
                . " ORDER BY u.id ASC";
        //hacemos la consulta y la guardamos en $query
        $query = $em->createQuery($dql)->setParameter("search","%$search%");
        
        //obtenemos una instancia de paginator d knpPaginator
        $paginator =  $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                                            $query,
                                            $request->query->getInt('page',1),
                                            5);
        return $this->render('AppBundle:User:users.html.twig',array(
                'pagination'=> $pagination
            )
        );
        //var_dump("Esta es la lista de gente que tienes como contacto");
        //die();
    }

}
