<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 08/05/17
 * Time: 9:12 AM
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;

/**
 * @Serializer\ExclusionPolicy("all")
 * @ORM\Table(name="blacklist")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\BlacklistRepository")
 */
class Blacklist
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="blackList")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @Serializer\Expose()
     * @ORM\Column(type="string")
     */
    private $unique_symbol;


    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @param mixed $unique_symbol
     */
    public function setUniqueSymbol($unique_symbol)
    {
        $this->unique_symbol = $unique_symbol;
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
    public function getUniqueSymbol()
    {
        return $this->unique_symbol;
    }


}