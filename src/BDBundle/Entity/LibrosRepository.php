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

        $dql = 'SELECT l.libroId,l.nombreLibro,l.descripcion,l.precio,l.stock,l.entrega,l.imagen,ed.nombreEditorial,cat.nombreCategoria 
                                 from BDBundle:Libros l join BDBundle:Editores ed WITH l.editorid = ed.editorid join BDBundle:Categorias cat WITH l.categoriaid = cat.categoriaid';

        if($vcategoria != 'all')
            $query = $em->createQuery($dql . ' where l.categoriaid = :categoria')->setParameter('categoria', $vcategoria);
        else
            $query = $em->createQuery($dql);

        return $query;
    }

    public function getLibro($cod)
    {
        $em = $this->getEntityManager();
        $dql = $em->createQuery('SELECT p from BDBundle:Libros p where p.libroId = :cod')->setParameter('cod', $cod);

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

    public static function array_search_inner ($array, $attr, $val, $strict = FALSE) {
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