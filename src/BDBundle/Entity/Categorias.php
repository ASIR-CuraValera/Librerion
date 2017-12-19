<?php

namespace BDBundle\Entity;

/**
 * Categorias
 */
class Categorias
{
    /**
     * @var integer
     */
    private $categoriaid;

    /**
     * @var string
     */
    private $nombreCategoria = '';


    /**
     * Get categoriaid
     *
     * @return integer
     */
    public function getCategoriaid()
    {
        return $this->categoriaid;
    }

    /**
     * Set nombreCategoria
     *
     * @param string $nombreCategoria
     *
     * @return Categorias
     */
    public function setNombreCategoria($nombreCategoria)
    {
        $this->nombreCategoria = $nombreCategoria;

        return $this;
    }

    /**
     * Get nombreCategoria
     *
     * @return string
     */
    public function getNombreCategoria()
    {
        return $this->nombreCategoria;
    }
}

