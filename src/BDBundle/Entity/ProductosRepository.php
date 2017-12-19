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


class ProductosRepository extends \Doctrine\ORM\EntityRepository
{
    public function getProductosGama($vgama)
    {
        $em = $this->getEntityManager();
        if($vgama != 'all')
            $dql = $em->createQuery('SELECT p from BDBundle:Productos p where p.gama = :gama')->setParameter('gama', $vgama);
        else
            $dql = $em->createQuery('SELECT p from BDBundle:Productos p');

        return $dql;
    }

    public function getProducto($cod)
    {
        $em = $this->getEntityManager();
        $dql = $em->createQuery('SELECT p from BDBundle:Productos p where p.codigoproducto = :cod')->setParameter('cod', $cod);

        return $dql->getArrayResult()[0];
               //array("main" => $dql->getArrayResult()[0],
               //      "gama_nombre" => $em->createQuery('SELECT p.gama from BDBundle:Productos p where p.codigoproducto = :cod')->setParameter('cod', $cod)->getArrayResult()[0]);
    }

    public function getGamas()
    {
        $em = $this->getEntityManager();
        $dql = $em->createQuery('SELECT g from BDBundle:Gamasproductos g')->getArrayResult();
        return $dql;
    }
}