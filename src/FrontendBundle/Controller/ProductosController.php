<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/12/2017
 * Time: 13:46
 */

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProductosController extends Controller
{
    public $gamas;
    public $productos;
    public $pagination;

    private function Load() {
        DefaultController::Load($this);
    }

    public function LoadListado($vgama, $request)
    {
        $this->Load();
        $this->productos = $this->getDoctrine()->getManager()->getRepository('BDBundle:Productos')->getProductosGama($vgama);

        if($request) {
            $paginator  = $this->get('knp_paginator');
            $this->pagination = $paginator->paginate(
                $this->productos, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );
        }
    }

    public function productosgamaAction(Request $request, $gama = 'all')
    {
        $this->LoadListado($gama, $request);

        setcookie('gama_nombre', $gama, time() + 3600 * 24, '/');

        return $this->render('FrontendBundle:Productos:productosgama.html.twig', array(
            'gamas' => $this->gamas,
            'gama' => $gama != 'all' ? $this->gamas[$this->array_search_inner($this->gamas, 'gama', $gama)] : 'all',
            'gama_nombre' => $gama,
            'pagination' => $this->pagination,
            'productos' => $this->productos->getArrayResult()
        ));
    }

    public function verAction($producto)
    {
        $this->Load();
        $prod = $this->getDoctrine()->getManager()->getRepository('BDBundle:Productos')->getProducto($producto);

        return $this->render('FrontendBundle:Productos:ver.html.twig', array(
            'gamas' => $this->gamas,
            'producto' => $prod,
            'gama_nombre' => !array_key_exists("gama_nombre", $_COOKIE) ? "Todas" : $_COOKIE["gama_nombre"]
        ));
    }

    private function array_search_inner ($array, $attr, $val, $strict = FALSE) {
        // Error is input array is not an array
        if (!is_array($array)) return FALSE;
        // Loop the array
        foreach ($array as $key => $inner) {
            // Error if inner item is not an array (you may want to remove this line)
            if (!is_array($inner)) return FALSE;
            // Skip entries where search key is not present
            if (!isset($inner[$attr])) continue;
            if ($strict) {
                // Strict typing
                if ($inner[$attr] === $val) return $key;
            } else {
                // Loose typing
                if ($inner[$attr] == $val) return $key;
            }
        }
        // We didn't find it
        return NULL;
    }


}