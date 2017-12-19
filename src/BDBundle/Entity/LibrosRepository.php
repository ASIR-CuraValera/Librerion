<?php
/**
 * Created by PhpStorm.
 * User: Usuario
 * Date: 18/12/2017
 * Time: 12:50
 */

namespace BDBundle\Entity;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Pagination\Paginator;


class LibrosRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLibrosCategoria($vcategoria)
    {
        $em = $this->getEntityManager();
        if($vcategoria != 'all')
            $dql = $em->createQuery('SELECT p from BDBundle:Libros p where p.nombreCategoria = :categoria')->setParameter('categoria', $vcategoria);
        else
            $dql = $em->createQuery('SELECT p from BDBundle:Libros p');

        return $dql;
    }

    public function getLibro($cod)
    {
        $em = $this->getEntityManager();
        $dql = $em->createQuery('SELECT p from BDBundle:Libros p where p.codigolibro = :cod')->setParameter('cod', $cod);

        return $dql->getArrayResult()[0];
               //array("main" => $dql->getArrayResult()[0],
               //      "categoria_nombre" => $em->createQuery('SELECT p.nombreCategoria from BDBundle:Libros p where p.codigolibro = :cod')->setParameter('cod', $cod)->getArrayResult()[0]);
    }

    public function getCategorias()
    {
        $em = $this->getEntityManager();
        $dql = $em->createQuery('SELECT g from BDBundle:Categorias g')->getArrayResult();
        return $dql;
    }
}