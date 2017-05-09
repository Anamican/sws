<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 09/05/17
 * Time: 6:59 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;


/**
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="portfolio")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\PortfolioRepository")
 */
class Portfolio
{

    /**
     * @Serializer\Expose()
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="portfolio")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Serializer\Expose()
     * @ORM\Column(type="string")
     */
    private $name;


    /**
     * @Serializer\Expose()
     * @ORM\Column(type="string")
     */
    private $currency_iso;

    /**
     * @Serializer\Expose()
     * @ORM\Column(type="boolean")
     */
    private $sharing;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCurrencyIso()
    {
        return $this->currency_iso;
    }

    /**
     * @return mixed
     */
    public function getSharing()
    {
        return $this->sharing;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $currency_iso
     */
    public function setCurrencyIso($currency_iso)
    {
        $this->currency_iso = $currency_iso;
    }

    /**
     * @param mixed $sharing
     */
    public function setSharing($sharing)
    {
        $this->sharing = $sharing;
    }




}