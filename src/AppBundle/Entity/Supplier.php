<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Supplier
 *
 * @ORM\Table(name="supplier")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SupplierRepository")
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"ee" = "EE", "tcp" = "TCP", "cna" = "CNA"})
 */
abstract class Supplier
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    protected $name;

    /**
     * @var string
     *
     * @ORM\Column(name="address", type="string", length=255)
     */
    protected $address;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cucAccount;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $cupAccount;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    protected $usdAccount;

//    /**
//     * One Product has Many Features.
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Account", mappedBy="supplier", cascade={"persist"})
//     */
//    private $accounts;

    /**
     * @ORM\OneToMany(targetEntity="Email", mappedBy="supplier", cascade={"persist"})
     **/
    private $emails;

    /**
     * @ORM\OneToMany(targetEntity="Telephone", mappedBy="supplier", cascade={"persist"})
     **/
    private $phones;

    /**
     * One Supplier has Many Contracts.
     * @ORM\OneToMany(targetEntity="Contract", mappedBy="suplier")
     */
    private $contracts;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->emails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->phones = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Supplier
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Supplier
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set cucAccount
     *
     * @param string $cucAccount
     *
     * @return Supplier
     */
    public function setCucAccount($cucAccount)
    {
        $this->cucAccount = $cucAccount;

        return $this;
    }

    /**
     * Get cucAccount
     *
     * @return string
     */
    public function getCucAccount()
    {
        return $this->cucAccount;
    }

    /**
     * Set cupAccount
     *
     * @param string $cupAccount
     *
     * @return Supplier
     */
    public function setCupAccount($cupAccount)
    {
        $this->cupAccount = $cupAccount;

        return $this;
    }

    /**
     * Get cupAccount
     *
     * @return string
     */
    public function getCupAccount()
    {
        return $this->cupAccount;
    }

    /**
     * Set usdAccount
     *
     * @param string $usdAccount
     *
     * @return Supplier
     */
    public function setUsdAccount($usdAccount)
    {
        $this->usdAccount = $usdAccount;

        return $this;
    }

    /**
     * Get usdAccount
     *
     * @return string
     */
    public function getUsdAccount()
    {
        return $this->usdAccount;
    }

    /**
     * Add email
     *
     * @param \AppBundle\Entity\Email $email
     *
     * @return Supplier
     */
    public function addEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails[] = $email;

        return $this;
    }

    /**
     * Remove email
     *
     * @param \AppBundle\Entity\Email $email
     */
    public function removeEmail(\AppBundle\Entity\Email $email)
    {
        $this->emails->removeElement($email);
    }

    /**
     * Get emails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getEmails()
    {
        return $this->emails;
    }

    /**
     * Add phone
     *
     * @param \AppBundle\Entity\Telephone $phone
     *
     * @return Supplier
     */
    public function addPhone(\AppBundle\Entity\Telephone $phone)
    {
        $this->phones[] = $phone;

        return $this;
    }

    /**
     * Remove phone
     *
     * @param \AppBundle\Entity\Telephone $phone
     */
    public function removePhone(\AppBundle\Entity\Telephone $phone)
    {
        $this->phones->removeElement($phone);
    }

    /**
     * Get phones
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhones()
    {
        return $this->phones;
    }

    /**
     * Add contract
     *
     * @param \AppBundle\Entity\Contract $contract
     *
     * @return Supplier
     */
    public function addContract(\AppBundle\Entity\Contract $contract)
    {
        $this->contracts[] = $contract;

        return $this;
    }

    /**
     * Remove contract
     *
     * @param \AppBundle\Entity\Contract $contract
     */
    public function removeContract(\AppBundle\Entity\Contract $contract)
    {
        $this->contracts->removeElement($contract);
    }

    /**
     * Get contracts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContracts()
    {
        return $this->contracts;
    }
}
