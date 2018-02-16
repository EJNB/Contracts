<?php
/**
 * Created by PhpStorm.
 * User111: javier
 * Date: 07/12/2017
 * Time: 7:35
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * TCP
 *
 * @ORM\Table(name="ee")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EERepository")
 */
class EE extends Supplier
{

    /**
     * @var integer
     *
     * @ORM\Column(name="reeup_code", type="string")
     */
    private $codReuup;

    /**
     * @var integer
     *
     * @ORM\Column(name="nit_code", type="integer")
     */
    private $codNit;

    /**
     * Set codReuup
     *
     * @param integer $codReuup
     *
     * @return EE
     */
    public function setCodReuup($codReuup)
    {
        $this->codReuup = $codReuup;

        return $this;
    }

    /**
     * Get codReuup
     *
     * @return integer
     */
    public function getCodReuup()
    {
        return $this->codReuup;
    }

    /**
     * Set codNit
     *
     * @param integer $codNit
     *
     * @return EE
     */
    public function setCodNit($codNit)
    {
        $this->codNit = $codNit;

        return $this;
    }

    /**
     * Get codNit
     *
     * @return integer
     */
    public function getCodNit()
    {
        return $this->codNit;
    }

    public function __toString()
    {
        return $this->getName();
    }
}
