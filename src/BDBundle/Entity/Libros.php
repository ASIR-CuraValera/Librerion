<?php

namespace BDBundle\Entity;

/**
 * Libros
 */
class Libros
{
    /**
     * @var integer
     */
    private $libroId;

    /**
     * @var string
     */
    private $nombreLibro = '';

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var float
     */
    private $precio = '0';

    /**
     * @var integer
     */
    private $entrega = '0';

    /**
     * @var string
     */
    private $imagen = '';

    /**
     * @var \BDBundle\Entity\Categorias
     */
    private $categoriaid;

    /**
     * @var \BDBundle\Entity\Editores
     */
    private $editorid;


    /**
     * Get libroId
     *
     * @return integer
     */
    public function getLibroId()
    {
        return $this->libroId;
    }

    /**
     * Set nombreLibro
     *
     * @param string $nombreLibro
     *
     * @return Libros
     */
    public function setNombreLibro($nombreLibro)
    {
        $this->nombreLibro = $nombreLibro;

        return $this;
    }

    /**
     * Get nombreLibro
     *
     * @return string
     */
    public function getNombreLibro()
    {
        return $this->nombreLibro;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Libros
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
     * Set precio
     *
     * @param float $precio
     *
     * @return Libros
     */
    public function setPrecio($precio)
    {
        $this->precio = $precio;

        return $this;
    }

    /**
     * Get precio
     *
     * @return float
     */
    public function getPrecio()
    {
        return $this->precio;
    }

    /**
     * Set entrega
     *
     * @param integer $entrega
     *
     * @return Libros
     */
    public function setEntrega($entrega)
    {
        $this->entrega = $entrega;

        return $this;
    }

    /**
     * Get entrega
     *
     * @return integer
     */
    public function getEntrega()
    {
        return $this->entrega;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Libros
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

    /**
     * Set categoriaid
     *
     * @param \BDBundle\Entity\Categorias $categoriaid
     *
     * @return Libros
     */
    public function setCategoriaid(\BDBundle\Entity\Categorias $categoriaid = null)
    {
        $this->categoriaid = $categoriaid;

        return $this;
    }

    /**
     * Get categoriaid
     *
     * @return \BDBundle\Entity\Categorias
     */
    public function getCategoriaid()
    {
        return $this->categoriaid;
    }

    /**
     * Set editorid
     *
     * @param \BDBundle\Entity\Editores $editorid
     *
     * @return Libros
     */
    public function setEditorid(\BDBundle\Entity\Editores $editorid = null)
    {
        $this->editorid = $editorid;

        return $this;
    }

    /**
     * Get editorid
     *
     * @return \BDBundle\Entity\Editores
     */
    public function getEditorid()
    {
        return $this->editorid;
    }
}

