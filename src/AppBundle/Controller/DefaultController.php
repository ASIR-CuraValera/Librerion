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
        $ref->libros = $ref->getDoctrine()->getManager()->getRepository('BDBundle:Libros')->getLibrosCategoria('all');
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

    public function createAction(Request $request)
    {
        $this->Load($this, $request);

        $arr = array();
        $arr['message'] = 'You can access this only using Ajax!';

        //This is optional. Do not do this check if you want to call the same action using a regular request.
        if (!$request->isXmlHttpRequest())
            return new JsonResponse($arr, 400);

        $entity = new Libros();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        $arr['form'] = $this->render('AppBundle:Default:index.html.twig', array(
                                     'nuevo_libro_formulario' => $form->createView(),
                                     'libros' => $this->pagination,
                                     'categorias' => $this->categorias));

        if ($form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            $arr['message'] = "Success!";
            return new JsonResponse($arr, 200);
        }

        $arr['message'] = $this->getErrorMessagesFromUnbubblingForm($form);
        $arr['request'] = $request->get('data');
        return new JsonResponse($arr, 400);
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

    public function getErrorMessagesFromUnbubblingForm(\Symfony\Component\Form\FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $key => $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }

            $errors[$key] = $template;
        }
        if ($form->count()) {
            foreach ($form as $child) {
                if (!$child->isValid()) {
                    $errors[$child->getName()] = $this->getErrorMessagesFromUnbubblingForm($child);
                }
            }
        }
        return $errors;
    }

    public function getFlatErrorMessagesFromUnbubblingForm(\Symfony\Component\Form\FormInterface $form)
    {
        $errors = array();
        foreach ($form->getErrors() as $error) {
            $template = $error->getMessageTemplate();
            $parameters = $error->getMessageParameters();

            foreach ($parameters as $var => $value) {
                $template = str_replace($var, $value, $template);
            }

            $errors[] = $template;
        }
        if ($form->count()) {
            foreach ($form as $child) {
                if (!$child->isValid()) {
                    $errors = $this->getFlatErrorMessagesFromUnbubblingForm($child);
                }
            }
        }
        return $errors;
    }
}