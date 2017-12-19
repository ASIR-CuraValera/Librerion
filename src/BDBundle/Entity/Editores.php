<?php

namespace BDBundle\Entity;

/**
 * Editores
 */
class Editores
{
    /**
     * @var integer
     */
    private $editorid;

    /**
     * @var string
     */
    private $nombreEditorial = '';


    /**
     * Get editorid
     *
     * @return integer
     */
    public function getEditorid()
    {
        return $this->editorid;
    }

    /**
     * Set nombreEditorial
     *
     * @param string $nombreEditorial
     *
     * @return Editores
     */
    public function setNombreEditorial($nombreEditorial)
    {
        $this->nombreEditorial = $nombreEditorial;

        return $this;
    }

    /**
     * Get nombreEditorial
     *
     * @return string
     */
    public function getNombreEditorial()
    {
        return $this->nombreEditorial;
    }
}

