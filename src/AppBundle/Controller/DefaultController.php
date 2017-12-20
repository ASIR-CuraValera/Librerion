<?php
/**
 * Created by PhpStorm.
 * User: Álvaro
 * Date: 19/12/2017
 * Time: 12:44
 */

namespace AppBundle\Controller;

use BDBundle\Form\LibrosType;
use DatabaseBundle\Entity\Gamasproducto;
use Doctrine\DBAL\Types\DecimalType;
use Doctrine\DBAL\Types\Type;
use DatabaseBundle\Entity\Producto;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use BDBundle\Entity\LibrosRepository;
use BDBundle\Entity\Libros;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\JsonResponse;

class DefaultController extends Controller
{
    public $categorias;
    public $editorales;

    public $libros;
    public $pagination;
    public $form;

    private function Load($ref, $request)
    {
        $ref->categorias = $ref->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getCategorias();
        $paginator  = $this->get('knp_paginator');
        $this->pagination = $paginator->paginate(
            $this->libros,
            $request->query->getInt('page', 1),
            12
        );
    }

    public function indexAction(Request $request)
    {
        $this->libros = $this->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getLibrosCategoria('all');
        $this->Load($this, $request);

        //Formulario
        $entity = new Libros();
        $this->form = $this->createCreateForm($entity);

        return $this->render('AppBundle:Default:index.html.twig', array(
            'libros' => $this->pagination,
            'categorias' => $this->categorias,
            'nuevo_libro_formulario' => $this->form->createView()
        ));
    }

    /**
     * Creates a new Demo entity.
     *
     * @Route("/", name="app_crearlibro")
     * @Method("POST")
     *
     */
    public function createAction(Request $request)
    {
        //echo "aaa";
        //die;

        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest()) {
            return new JsonResponse(array('message' => 'You can access this only using Ajax!'), 400);
        }

        $entity = new Libros();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return new JsonResponse(array('message' => 'Success!'), 200);
        }

        $response = new JsonResponse(
            array(
                'message' => 'Error',
                'form' => $this->render('AppBundle:Default:index.html.twig',
                    array(
                        'entity' => $entity,
                        'form' => $form->createView(),
                    ))), 400);

        return $response;
    }

    /**
     * Creates a form to create a Demo entity.
     *
     * @param Demo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Libros $entity)
    {
        $form = $this->createForm(LibrosType::class, $entity,
            array(
                'action' => $this->generateUrl('app_crearlibro'),
                'method' => 'POST',
            ));

        return $form;
    }
}