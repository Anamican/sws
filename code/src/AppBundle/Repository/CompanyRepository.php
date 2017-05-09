<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 04/05/17
 * Time: 2:46 PM
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class CompanyRepository extends EntityRepository
{

    public function findOneByUniqueSymbol($uniqueSymbol)
    {
        return $this->findOneBy(array(
            'unique_symbol' => $uniqueSymbol
        ));
    }

}