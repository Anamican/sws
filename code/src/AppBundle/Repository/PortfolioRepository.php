<?php
/**
 * Created by PhpStorm.
 * User: madhu
 * Date: 09/05/17
 * Time: 7:00 AM
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PortfolioRepository extends EntityRepository
{

    public function findByName($name)
    {
        return $this->findOneBy(array(
            'name' => $name
        ));
    }

    public function findByID($id)
    {
        return $this->findOneBy(array(
            'id' => $id
        ));
    }

    public function deletePortfolioByID($user, $id){

        $query = $this->createQueryBuilder('pf')
            ->andWhere('pf.user = :userObj ')
            ->setParameter('userObj', $user)
            ->andWhere('pf.id = :id')
            ->setParameter('id', $id)
            ->delete()
            ->getQuery();

        return $query->execute();

    }

}