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
use BDBundle\Entity\LibrosRepository;

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

        if($request)
        {
            $paginator  = $this->get('knp_paginator');
            $this->pagination = $paginator->paginate(
                $this->libros,
                $request->query->getInt('page', 1),
                12
            );
        }
    }

    public function librosCategoriaAction(Request $request, $categoria = 'all')
    {
        $this->LoadListado($categoria, $request);

        $cat = $categoria != 'all' ? $this->categorias[LibrosRepository::array_search_inner($this->categorias, 'categoriaid', $categoria)] : array("nombreCategoria" => 'Todas');
        $catnom = $cat["nombreCategoria"];

        setcookie('categoria_nombre', $catnom, time() + 3600 * 24, '/');

        return $this->render('FrontendBundle:Libros:libroscategoria.html.twig', array(
            'categorias' => $this->categorias,
            'categoria' => $categoria != 'all' ? $cat : array("categoriaid" => 'all', "nombreCategoria" => 'Todas'),
            'categoria_nombre' => $catnom,
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

}