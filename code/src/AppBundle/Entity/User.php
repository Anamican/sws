<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="user")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Serializer\Expose()
     */
    private $id;

    /**
     * @Serializer\Expose()
     * @ORM\Column(type="string")
     */
    private $name;

    /**
     * @ORM\Column(type="string", unique=true)
     * @Serializer\Expose()
     */
    private $email;


    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $given_name;


    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $family_name;

    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $picture;



    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $locale;

    /**
     * @ORM\Column(type="bigint")
     * @Serializer\Expose()
     */
    private $register_date;


    /**
     * @ORM\Column(type="string")
     * @Serializer\Expose()
     */
    private $country_iso;


    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Blacklist", mappedBy="user")
     */
    private $blackList;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Portfolio", mappedBy="user")
     */
    private $portfolio;

    /**
     * @return mixed
     */
    public function __construct()
    {
        $this->blackList = new ArrayCollection();
        $this->portfolio = new ArrayCollection();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGivenName()
    {
        return $this->given_name;
    }

    /**
     * @return mixed
     */
    public function getFamilyName()
    {
        return $this->family_name;
    }

    /**
     * @return mixed
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     * @return mixed
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return mixed
     */
    public function getRegisterDate()
    {
        return $this->register_date;
    }

    /**
     * @return mixed
     */
    public function getCountryIso()
    {
        return $this->country_iso;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @param mixed $given_name
     */
    public function setGivenName($given_name)
    {
        $this->given_name = $given_name;
    }

    /**
     * @param mixed $family_name
     */
    public function setFamilyName($family_name)
    {
        $this->family_name = $family_name;
    }

    /**
     * @param mixed $picture
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;
    }

    /**
     * @param mixed $locale
     */
    public function setLocale($locale)
    {
        $this->locale = $locale;
    }

    /**
     * @param mixed $country_iso
     */
    public function setCountryIso($country_iso)
    {
        $this->country_iso = $country_iso;
    }




}
