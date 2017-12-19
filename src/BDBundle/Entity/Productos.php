<?php

namespace BDBundle\Entity;

/**
 * Productos
 */
class Productos
{
    /**
     * @var string
     */
    private $codigoproducto;

    /**
     * @var string
     */
    private $nombre;

    /**
     * @var string
     */
    private $dimensiones;

    /**
     * @var string
     */
    private $proveedor;

    /**
     * @var string
     */
    private $descripcion;

    /**
     * @var integer
     */
    private $cantidadenstock;

    /**
     * @var string
     */
    private $precioventa;

    /**
     * @var string
     */
    private $precioproveedor;

    /**
     * @var string
     */
    private $imagen;

    /**
     * @var \BDBundle\Entity\Gamasproductos
     */
    private $gama;


    /**
     * Get codigoproducto
     *
     * @return string
     */
    public function getCodigoproducto()
    {
        return $this->codigoproducto;
    }

    /**
     * Set nombre
     *
     * @param string $nombre
     *
     * @return Productos
     */
    public function setNombre($nombre)
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * Get nombre
     *
     * @return string
     */
    public function getNombre()
    {
        return $this->nombre;
    }

    /**
     * Set dimensiones
     *
     * @param string $dimensiones
     *
     * @return Productos
     */
    public function setDimensiones($dimensiones)
    {
        $this->dimensiones = $dimensiones;

        return $this;
    }

    /**
     * Get dimensiones
     *
     * @return string
     */
    public function getDimensiones()
    {
        return $this->dimensiones;
    }

    /**
     * Set proveedor
     *
     * @param string $proveedor
     *
     * @return Productos
     */
    public function setProveedor($proveedor)
    {
        $this->proveedor = $proveedor;

        return $this;
    }

    /**
     * Get proveedor
     *
     * @return string
     */
    public function getProveedor()
    {
        return $this->proveedor;
    }

    /**
     * Set descripcion
     *
     * @param string $descripcion
     *
     * @return Productos
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
     * Set cantidadenstock
     *
     * @param integer $cantidadenstock
     *
     * @return Productos
     */
    public function setCantidadenstock($cantidadenstock)
    {
        $this->cantidadenstock = $cantidadenstock;

        return $this;
    }

    /**
     * Get cantidadenstock
     *
     * @return integer
     */
    public function getCantidadenstock()
    {
        return $this->cantidadenstock;
    }

    /**
     * Set precioventa
     *
     * @param string $precioventa
     *
     * @return Productos
     */
    public function setPrecioventa($precioventa)
    {
        $this->precioventa = $precioventa;

        return $this;
    }

    /**
     * Get precioventa
     *
     * @return string
     */
    public function getPrecioventa()
    {
        return $this->precioventa;
    }

    /**
     * Set precioproveedor
     *
     * @param string $precioproveedor
     *
     * @return Productos
     */
    public function setPrecioproveedor($precioproveedor)
    {
        $this->precioproveedor = $precioproveedor;

        return $this;
    }

    /**
     * Get precioproveedor
     *
     * @return string
     */
    public function getPrecioproveedor()
    {
        return $this->precioproveedor;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Productos
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
     * Set gama
     *
     * @param \BDBundle\Entity\Gamasproductos $gama
     *
     * @return Productos
     */
    public function setGama(\BDBundle\Entity\Gamasproductos $gama = null)
    {
        $this->gama = $gama;

        return $this;
    }

    /**
     * Get gama
     *
     * @return \BDBundle\Entity\Gamasproductos
     */
    public function getGama()
    {
        return $this->gama;
    }
}

