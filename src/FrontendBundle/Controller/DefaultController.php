<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public $gamas;

    public static function Load($ref)
    {
        $ref->gamas = $ref->getDoctrine()->getManager()->getRepository('BDBundle:Productos')->getGamas();
    }

    public function indexAction(Request $request)
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Default:index.html.twig', array(
            'gamas' => $this->gamas
        ));
    }

    public function conocenosAction()
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Default:conocenos.html.twig', array(
            'gamas' => $this->gamas
        ));
    }
    
   
}
