<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 04/05/17
 * Time: 1:54 PM
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;



/**
 * Company
 *
 * @ORM\Table(name="company")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\CompanyRepository")
 *
 *
 */

class Company
{
    /**
     * @var integer
     *
     *
     * @ORM\Column(name="id",type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="slug", type="string")
     */
    private $slug;


    /**
     * @var integer
     *
     * @ORM\Column( type="integer", name="trading_item_id", length=20)
     */
    private $trading_item_id;


    /**
     * @var string
     *
     * @ORM\Column( type="string", name="unique_symbol", length=100)
     */
    private $unique_symbol;

    /**
     * @var string
     *
     * @ORM\Column(name="exchange_symbol", type="string", length=100)
     */
    private $exchange_symbol;


    /**
     * @var string
     *
     * @ORM\Column(name="ticker_symbol", type="string", length=100)
     */
    private $ticker_symbol;

    /**
     * @var primaryTicker
     *
     * @ORM\Column(name="primary_ticker", type="string", length=100)
     */
    private $primary_ticker;

    /**
     * @var integer
     *
     * @ORM\Column(name="last_updated")
     */
    private  $last_updated;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSlug()
    {
        return $this->slug;
    }

    /**
     * @return int
     */
    public function getTradingItemId()
    {
        return $this->trading_item_id;
    }

    /**
     * @return string
     */
    public function getUniqueSymbol()
    {
        return $this->unique_symbol;
    }

    /**
     * @return string
     */
    public function getExchangeSymbol()
    {
        return $this->exchange_symbol;
    }

    /**
     * @return string
     */
    public function getTickerSymbol()
    {
        return $this->ticker_symbol;
    }

    /**
     * @return primaryTicker
     */
    public function getPrimaryTicker()
    {
        return $this->primary_ticker;
    }

    /**
     * @return int
     */
    public function getLastUpdated()
    {
        return $this->last_updated;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param string $slug
     */
    public function setSlug($slug)
    {
        $this->slug = $slug;
    }

    /**
     * @param int $trading_item_id
     */
    public function setTradingItemId($trading_item_id)
    {
        $this->trading_item_id = $trading_item_id;
    }

    /**
     * @param string $unique_symbol
     */
    public function setUniqueSymbol($unique_symbol)
    {
        $this->unique_symbol = $unique_symbol;
    }

    /**
     * @param string $exchange_symbol
     */
    public function setExchangeSymbol($exchange_symbol)
    {
        $this->exchange_symbol = $exchange_symbol;
    }

    /**
     * @param string $ticker_symbol
     */
    public function setTickerSymbol($ticker_symbol)
    {
        $this->ticker_symbol = $ticker_symbol;
    }

    /**
     * @param primaryTicker $primary_ticker
     */
    public function setPrimaryTicker($primary_ticker)
    {
        $this->primary_ticker = $primary_ticker;
    }



}