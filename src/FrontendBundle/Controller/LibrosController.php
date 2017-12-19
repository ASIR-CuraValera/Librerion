<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/12/2017
 * Time: 13:46
 */

namespace FrontendBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class LibrosController extends Controller
{
    public $categorias;
    public $libros;
    public $pagination;

    private function Load() {
        DefaultController::Load($this);
    }

    public function LoadListado($vcategoria, $request)
    {
        $this->Load();
        $this->libros = $this->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getLibrosCategoria($vcategoria);

        if($request) {
            $paginator  = $this->get('knp_paginator');
            $this->pagination = $paginator->paginate(
                $this->libros, /* query NOT result */
                $request->query->getInt('page', 1)/*page number*/,
                10/*limit per page*/
            );
        }
    }

    public function librosCategoriaAction(Request $request, $categoria = 'all')
    {
        $this->LoadListado($categoria, $request);

        setcookie('categoria_nombre', $categoria, time() + 3600 * 24, '/');

        return $this->render('FrontendBundle:Libros:libroscategoria.html.twig', array(
            'categorias' => $this->categorias,
            'categoria' => $categoria != 'all' ? $this->categorias[$this->array_search_inner($this->categorias, 'categoria', $categoria)] : 'all',
            'categoria_nombre' => $categoria,
            'pagination' => $this->pagination,
            'libros' => $this->libros->getArrayResult()
        ));
    }

    public function verAction($libro)
    {
        $this->Load();
        $prod = $this->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getLibro($libro);

        return $this->render('FrontendBundle:Libros:ver.html.twig', array(
            'categorias' => $this->categorias,
            'libro' => $prod,
            'categoria_nombre' => !array_key_exists("categoria_nombre", $_COOKIE) ? "Todas" : $_COOKIE["categoria_nombre"]
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