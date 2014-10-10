<?php

namespace Contact\Bundle\ContactBundle\Repository;

use Doctrine\ORM\EntityRepository;

class Contact extends EntityRepository
{
    public function findAllOrderByFavourite()
    {
        return $this->getContactQueryBuilder()
            ->orderBy('c.favourite', 'DESC')
            ->addOrderBy('c.surname', 'ASC')
            ->getQuery()
            ->getResult();

    }

    public function getContactQueryBuilder()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()
            ->select('c')
            ->from('ContactContactBundle:Contact', 'c');
    }
}
