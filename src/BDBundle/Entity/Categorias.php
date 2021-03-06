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
    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var string
     */
    private $imagen;


    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Categorias
     */
    public function setDescripcion($descripcion)
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    /**
     * Get descripcion
     *
     * @return string
     */
    public function getDescripcion()
    {
        return $this->descripcion;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Categorias
     */
    public function setImagen($imagen)
    {
        $this->imagen = $imagen;

        return $this;
    }

    /**
     * Get imagen
     *
     * @return string
     */
    public function getImagen()
    {
        return $this->imagen;
    }

    public function __toString() {
        return $this->nombreCategoria;
    }
}
