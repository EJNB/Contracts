<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplement
 *
 * @ORM\Table(name="supplement")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplementRepository")
 */
class Supplement
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
     * @ORM\Column(name="id_supplement", type="string", length=20)
     */
    private $idSupplement;

    /**
     * @var int
     *
     * @ORM\Column(name="consecutive_number", type="integer")
     */
    private $consecutiveNumber;

    /**
     * @var string
     *
     * @ORM\Column(name="contractual_object", type="string", length=255)
     */
    private $contractualObject;

    /**
     * @var float
     *
     * @ORM\Column(name="cuc_value", type="float")
     */
    private $cucValue;

    /**
     * @var float
     *
     * @ORM\Column(name="cup_value", type="float")
     */
    private $cupValue;

    /**
     * Many Supplements have One Contract.
     * @ORM\ManyToOne(targetEntity="Contract", inversedBy="supplements")
     * @ORM\JoinColumn(name="contract_id", referencedColumnName="id")
     */
    private $contract;

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
     * Set consecutiveNumber
     *
     * @param integer $consecutiveNumber
     * @return Supplement
     */
    public function setConsecutiveNumber($consecutiveNumber)
    {
        $this->consecutiveNumber = $consecutiveNumber;

        return $this;
    }

    /**
     * Get consecutiveNumber
     *
     * @return integer 
     */
    public function getConsecutiveNumber()
    {
        return $this->consecutiveNumber;
    }

    /**
     * Set contractualObject
     *
     * @param string $contractualObject
     * @return Supplement
     */
    public function setContractualObject($contractualObject)
    {
        $this->contractualObject = $contractualObject;

        return $this;
    }

    /**
     * Get contractualObject
     *
     * @return string 
     */
    public function getContractualObject()
    {
        return $this->contractualObject;
    }

    /**
     * Set cucValue
     *
     * @param float $cucValue
     * @return Supplement
     */
    public function setCucValue($cucValue)
    {
        $this->cucValue = $cucValue;

        return $this;
    }

    /**
     * Get cucValue
     *
     * @return float 
     */
    public function getCucValue()
    {
        return $this->cucValue;
    }

    /**
     * Set cupValue
     *
     * @param string $cupValue
     * @return Supplement
     */
    public function setCupValue($cupValue)
    {
        $this->cupValue = $cupValue;

        return $this;
    }

    /**
     * Get cupValue
     *
     * @return string 
     */
    public function getCupValue()
    {
        return $this->cupValue;
    }

    /**
     * Set contract
     *
     * @param \AppBundle\Entity\Contract $contract
     * @return Supplement
     */
    public function setContract(\AppBundle\Entity\Contract $contract = null)
    {
        $this->contract = $contract;

        return $this;
    }

    /**
     * Get contract
     *
     * @return \AppBundle\Entity\Contract 
     */
    public function getContract()
    {
        return $this->contract;
    }

    /**
     * Set idSupplement
     *
     * @param string $idSupplement
     *
     * @return Supplement
     */
    public function setIdSupplement($idSupplement)
    {
        $this->idSupplement = $idSupplement;

        return $this;
    }

    /**
     * Get idSupplement
     *
     * @return string
     */
    public function getIdSupplement()
    {
        return $this->idSupplement;
    }
}
