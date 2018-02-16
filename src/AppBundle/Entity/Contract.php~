<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Contract
 *
 * @ORM\Table(name="contract")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\ContractRepository")
 */
class Contract
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

//    /**
//     * @var int
//     *
//     * @ORM\Column(name="consecutive_number", type="integer", length=25)
//     */
//    private $consecutiveNumber;
    /**
     * @var int
     *
     * @ORM\Column(name="contract_number",type="string", length=25)
     */
    private $contractNumber;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="expiration_date", type="date")
     */
    private $expirationDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="start_date", type="date")
     */
    private $startDate;

    /**
     * @var string
     *
     * @ORM\Column(name="contractualObject", type="text")
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
     * @var float
     *
     * @ORM\Column(name="total_amount", type="float")
     */
    private $totalAmount;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;
//
//    /**
//     * @var float
//     *
//     * @ORM\Column(name="cuc_scope", type="float")
//     */
//    private $days;
//
//    /**
//     * @var float
//     *
//     * @ORM\Column(name="cup_scope", type="float")
//     */
//    private $cupScope;

    /**
     * @var integer
     *
     * @ORM\Column(name="agreement_no_uasi", type="integer")
     */
    private $agreementNoUASI;

    /**
     * @var integer
     *
     * @ORM\Column(name="agreement_no_cubanacan", type="integer", nullable=true)
     */
    private $agreementNoCUBANACAN;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     */
    private $agreementDateUASI;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $agreementDateCC;


    /**
     * cantidad de dias q le quedan al contrato
     * var integer
     * @ORM\Column(type="integer")
     */
    private $days;
//
//    /**
//     * @var string
//     *
//     * @ORM\Column(name="pdf_contract", type="string", nullable=true)
//     * @Assert\File(mimeTypes={ "application/pdf" })
//     */
//    private $pdfContract;

    /**
     * One Contract has Many Supplements.
     * @ORM\OneToMany(targetEntity="Supplement", mappedBy="contract")
     */
    private $supplements;

    /**
     * Many Contracts have One Supplier.
     * @ORM\ManyToOne(targetEntity="Supplier", inversedBy="contracts")
     * @ORM\JoinColumn(name="suplier_id", referencedColumnName="id")
     */
    private $suplier;

    /**
     * Many Contract have One User.
     * @ORM\ManyToOne(targetEntity="User", inversedBy="contracts")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * Many Contract have One User.
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Department", inversedBy="contracts")
     * @ORM\JoinColumn(name="department_id", referencedColumnName="id")
     */
    private $department;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->supplements = new \Doctrine\Common\Collections\ArrayCollection();
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
//
//    /**
//     * Set consecutiveNumber
//     *
//     * @param integer $consecutiveNumber
//     *
//     * @return Contract
//     */
//    public function setConsecutiveNumber($consecutiveNumber)
//    {
//        $this->consecutiveNumber = $consecutiveNumber;
//
//        return $this;
//    }

//    /**
//     * Get consecutiveNumber
//     *
//     * @return integer
//     */
//    public function getConsecutiveNumber()
//    {
//        return $this->consecutiveNumber;
//    }

    /**
     * Set contractNumber
     *
     * @param string $contractNumber
     *
     * @return Contract
     */
    public function setContractNumber($contractNumber)
    {
        $this->contractNumber = $contractNumber;

        return $this;
    }

    /**
     * Get contractNumber
     *
     * @return string
     */
    public function getContractNumber()
    {
        return $this->contractNumber;
    }

    /**
     * Set expirationDate
     *
     * @param \DateTime $expirationDate
     *
     * @return Contract
     */
    public function setExpirationDate($expirationDate)
    {
        $this->expirationDate = $expirationDate;

        return $this;
    }

    /**
     * Get expirationDate
     *
     * @return \DateTime
     */
    public function getExpirationDate()
    {
        return $this->expirationDate;
    }

    /**
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Contract
     */
    public function setStartDate($startDate)
    {
        $this->startDate = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->startDate;
    }

    /**
     * Set contractualObject
     *
     * @param string $contractualObject
     *
     * @return Contract
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
     *
     * @return Contract
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
     * @param float $cupValue
     *
     * @return Contract
     */
    public function setCupValue($cupValue)
    {
        $this->cupValue = $cupValue;

        return $this;
    }

    /**
     * Get cupValue
     *
     * @return float
     */
    public function getCupValue()
    {
        return $this->cupValue;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Contract
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }
//
//    /**
//     * Set cucScope
//     *
//     * @param float $cucScope
//     *
//     * @return Contract
//     */
//    public function setCucScope($cucScope)
//    {
//        $this->cucScope = $cucScope;
//
//        return $this;
//    }
//
//    /**
//     * Get cucScope
//     *
//     * @return float
//     */
//    public function getCucScope()
//    {
//        return $this->cucScope;
//    }
//
//    /**
//     * Set cupScope
//     *
//     * @param float $cupScope
//     *
//     * @return Contract
//     */
//    public function setCupScope($cupScope)
//    {
//        $this->cupScope = $cupScope;
//
//        return $this;
//    }
//
//    /**
//     * Get cupScope
//     *
//     * @return float
//     */
//    public function getCupScope()
//    {
//        return $this->cupScope;
//    }

    /**
     * Set agreementNoUASI
     *
     * @param integer $agreementNoUASI
     *
     * @return Contract
     */
    public function setAgreementNoUASI($agreementNoUASI)
    {
        $this->agreementNoUASI = $agreementNoUASI;

        return $this;
    }

    /**
     * Get agreementNoUASI
     *
     * @return integer
     */
    public function getAgreementNoUASI()
    {
        return $this->agreementNoUASI;
    }

    /**
     * Set agreementNoCUBANACAN
     *
     * @param integer $agreementNoCUBANACAN
     *
     * @return Contract
     */
    public function setAgreementNoCUBANACAN($agreementNoCUBANACAN)
    {
        $this->agreementNoCUBANACAN = $agreementNoCUBANACAN;

        return $this;
    }

    /**
     * Get agreementNoCUBANACAN
     *
     * @return integer
     */
    public function getAgreementNoCUBANACAN()
    {
        return $this->agreementNoCUBANACAN;
    }

//    /**
//     * Set pdfContract
//     *
//     * @param string $pdfContract
//     *
//     * @return Contract
//     */
//    public function setPdfContract($pdfContract)
//    {
//        $this->pdfContract = $pdfContract;
//
//        return $this;
//    }
//
//    /**
//     * Get pdfContract
//     *
//     * @return string
//     */
//    public function getPdfContract()
//    {
//        return $this->pdfContract;
//    }

    /**
     * Add supplement
     *
     * @param \AppBundle\Entity\Supplement $supplement
     *
     * @return Contract
     */
    public function addSupplement(\AppBundle\Entity\Supplement $supplement)
    {
        $this->supplements[] = $supplement;

        return $this;
    }

    /**
     * Remove supplement
     *
     * @param \AppBundle\Entity\Supplement $supplement
     */
    public function removeSupplement(\AppBundle\Entity\Supplement $supplement)
    {
        $this->supplements->removeElement($supplement);
    }

    /**
     * Get supplements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSupplements()
    {
        return $this->supplements;
    }

    /**
     * Set suplier
     *
     * @param \AppBundle\Entity\Supplier $suplier
     *
     * @return Contract
     */
    public function setSuplier(\AppBundle\Entity\Supplier $suplier = null)
    {
        $this->suplier = $suplier;

        return $this;
    }

    /**
     * Get suplier
     *
     * @return \AppBundle\Entity\Supplier
     */
    public function getSuplier()
    {
        return $this->suplier;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Contract
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    public function __toString()
    {
//        return $this->getcontractNumber();
        return $this->getContractualObject();
    }

    /**
     * Set totalAmount
     *
     * @param float $totalAmount
     *
     * @return Contract
     */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;

        return $this;
    }

    /**
     * Get totalAmount
     *
     * @return float
     */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

//    /**
//     * Set confirmed
//     *
//     * @param boolean $confirmed
//     *
//     * @return Contract
//     */
//    public function setConfirmed($confirmed)
//    {
//        $this->confirmed = $confirmed;
//
//        return $this;
//    }
//
//    /**
//     * Get confirmed
//     *
//     * @return boolean
//     */
//    public function getConfirmed()
//    {
//        return $this->confirmed;
//    }

    /**
     * Set agreementDateUASI
     *
     * @param \DateTime $agreementDateUASI
     *
     * @return Contract
     */
    public function setAgreementDateUASI($agreementDateUASI)
    {
        $this->agreementDateUASI = $agreementDateUASI;

        return $this;
    }

    /**
     * Get agreementDateUASI
     *
     * @return \DateTime
     */
    public function getAgreementDateUASI()
    {
        return $this->agreementDateUASI;
    }

    /**
     * Set agreementDateCC
     *
     * @param \DateTime $agreementDateCC
     *
     * @return Contract
     */
    public function setAgreementDateCC($agreementDateCC)
    {
        $this->agreementDateCC = $agreementDateCC;

        return $this;
    }

    /**
     * Get agreementDateCC
     *
     * @return \DateTime
     */
    public function getAgreementDateCC()
    {
        return $this->agreementDateCC;
    }

    /**
     * Set department
     *
     * @param \AppBundle\Entity\Department $department
     *
     * @return Contract
     */
    public function setDepartment(\AppBundle\Entity\Department $department = null)
    {
        $this->department = $department;

        return $this;
    }

    /**
     * Get department
     *
     * @return \AppBundle\Entity\Department
     */
    public function getDepartment()
    {
        return $this->department;
    }

    /**
     * Set days
     *
     * @param integer $days
     *
     * @return Contract
     */
    public function setDays($days)
    {
        $this->days = $days;

        return $this;
    }

    /**
     * Get days
     *
     * @return integer
     */
    public function getDays()
    {
        return $this->days;
    }
}
