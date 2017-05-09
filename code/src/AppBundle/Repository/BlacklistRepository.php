<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 09/05/17
 * Time: 4:55 AM
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class BlacklistRepository extends EntityRepository
{
    /**
     * @param $symbolArray
     * @return mixed
     */
    public function getDetailsOfSymbols($symbol, $user)
    {
        $query = $this->createQueryBuilder('bl')
            ->innerJoin('bl.user', 'user')
            ->andWhere('bl.unique_symbol in (:symbols) ' )
            ->setParameter('symbols', $symbol)
            ->andWhere('bl.user = :userObj ')
            ->setParameter('userObj', $user)
            ->getQuery();

        return $query->execute();

    }

    /**
     * @param $user
     * @return mixed
     */
    public function purgeBlackList($user){

        $query = $this->createQueryBuilder('bl')
            ->andWhere('bl.user = :userObj ')
            ->setParameter('userObj', $user)
            ->delete()
            ->getQuery();

        return $query->execute();
    }


    public function findAllByUser($user){

        $query = $this->createQueryBuilder('bl')
            ->innerJoin('bl.user', 'user')
            ->andWhere('bl.user = :userObj ')
            ->setParameter('userObj', $user)
            ->getQuery();

        return $query->execute();
    }

}

