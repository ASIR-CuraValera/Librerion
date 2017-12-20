<?php
/**
 * Created by PhpStorm.
 * User: Álvaro
 * Date: 19/12/2017
 * Time: 12:44
 */

namespace AppBundle\Controller;

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
        $this->form = $this->createFormBuilder()
            ->add('nombreProducto', TextType::class)
            ->add('gamaProducto', ChoiceType::class, array(
                'choices' => array_fill(0, sizeof($this->categorias), ''),
                'choices_as_values' => true,
                'choice_label' => function ($allChoices, $currentChoiceKey) {
                    return $this->categorias[$currentChoiceKey]['nombreCategoria'];
                }))
            ->add('dimensionesProducto', TextType::class, array('attr' => array('value' => 'abc123')))
            ->add('proveedorProducto', TextType::class, array('attr' => array('value' => 'abc123')))
            ->add('descripcionProducto', TextType::class, array('attr' => array('value' => 'abc123')))
            ->add('cantidadProducto', IntegerType::class, array('attr' => array('value' => '0')))//, Type::getType('smallint'))
            ->add('precioVentaProducto', IntegerType::class, array('attr' => array('value' => '0')))//, DecimalType::class)
            ->add('precioProveedorProducto', IntegerType::class, array('attr' => array('value' => '0')))
            ->add('imagenProducto', TextType::class, array('attr' => array('value' => 'abc123')))
            ->add('enviar', SubmitType::class)
            ->getForm()->createView();

        return $this->render('AppBundle:Default:index.html.twig', array(
            'libros' => $this->pagination,
            'categorias' => $this->categorias,
            'nuevo_libro_formulario' => $this->form
        ));
    }
}