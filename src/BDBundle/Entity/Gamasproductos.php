<?php

namespace BDBundle\Entity;

/**
 * Gamasproductos
 */
class Gamasproductos
{
    /**
     * @var string
     */
    private $gama;

    /**
     * @var string
     */
    private $descripciontexto;

    /**
     * @var string
     */
    private $descripcionhtml;

    /**
     * @var string
     */
    private $imagen;


    /**
     * Get gama
     *
     * @return string
     */
    public function getGama()
    {
        return $this->gama;
    }

    /**
     * Set descripciontexto
     *
     * @param string $descripciontexto
     *
     * @return Gamasproductos
     */
    public function setDescripciontexto($descripciontexto)
    {
        $this->descripciontexto = $descripciontexto;

        return $this;
    }

    /**
     * Get descripciontexto
     *
     * @return string
     */
    public function getDescripciontexto()
    {
        return $this->descripciontexto;
    }

    /**
     * Set descripcionhtml
     *
     * @param string $descripcionhtml
     *
     * @return Gamasproductos
     */
    public function setDescripcionhtml($descripcionhtml)
    {
        $this->descripcionhtml = $descripcionhtml;

        return $this;
    }

    /**
     * Get descripcionhtml
     *
     * @return string
     */
    public function getDescripcionhtml()
    {
        return $this->descripcionhtml;
    }

    /**
     * Set imagen
     *
     * @param string $imagen
     *
     * @return Gamasproductos
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
}

