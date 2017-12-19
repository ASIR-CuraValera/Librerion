<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/12/2017
 * Time: 13:41
 */

namespace FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class AyudaController extends Controller
{
    public $categorias;

    public function formaspagoAction()
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Ayuda:formaspago.html.twig',array(
            'categorias' => $this->categorias
        ));
    }

    public function instalacionesAction()
    {
        DefaultController::Load($this);

        return $this->render('FrontendBundle:Ayuda:instalaciones.html.twig', array(
            'categorias' => $this->categorias
        ));
    }


}
