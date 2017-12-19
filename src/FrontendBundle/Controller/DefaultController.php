<?php

namespace FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public $categorias;

    public static function Load($ref)
    {
        $ref->categorias = $ref->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getCategorias();
    }

    public function indexAction(Request $request)
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Default:index.html.twig', array(
            'categorias' => $this->categorias
        ));
    }

    public function conocenosAction()
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Default:conocenos.html.twig', array(
            'categorias' => $this->categorias
        ));
    }
    
   
}
