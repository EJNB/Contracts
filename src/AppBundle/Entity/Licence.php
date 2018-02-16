<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Licence
 *
 * @ORM\Table(name="licence")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LicenceRepository")
 */
class Licence
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="licence_number", type="integer")
     */
    private $licenceNumber;

    /**
     * Many Groups have Many Users.
     * @ORM\ManyToMany(targetEntity="TCP", mappedBy="licences")
     */
    private $tcps;
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->tcps = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set licenceNumber
     *
     * @param integer $licenceNumber
     *
     * @return Licence
     */
    public function setLicenceNumber($licenceNumber)
    {
        $this->licenceNumber = $licenceNumber;

        return $this;
    }

    /**
     * Get licenceNumber
     *
     * @return integer
     */
    public function getLicenceNumber()
    {
        return $this->licenceNumber;
    }

    /**
     * Add tcp
     *
     * @param \AppBundle\Entity\TCP $tcp
     *
     * @return Licence
     */
    public function addTcp(\AppBundle\Entity\TCP $tcp)
    {
        $this->tcps[] = $tcp;

        return $this;
    }

    /**
     * Remove tcp
     *
     * @param \AppBundle\Entity\TCP $tcp
     */
    public function removeTcp(\AppBundle\Entity\TCP $tcp)
    {
        $this->tcps->removeElement($tcp);
    }

    /**
     * Get tcps
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTcps()
    {
        return $this->tcps;
    }

    public function __toString()
    {
        return strval($this->getLicenceNumber());
    }
}
