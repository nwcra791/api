<?php

namespace AppBundle\Repository;

/**
 * TransToLangRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends \Doctrine\ORM\EntityRepository
{
    public function findAllSort($sort)
    {
        return $this->findBy(array(), array('id' => $sort));
    }
}
