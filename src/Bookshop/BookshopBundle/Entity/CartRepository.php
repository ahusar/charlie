<?php

namespace Bookshop\BookshopBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CartRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CartRepository extends EntityRepository {

    public function getCart($userid) {
        $qb = $this->createQueryBuilder('c')
                ->select('c')
                ->where('c.userId = :userid and c.active = 1')
                ->setParameter('userid', $userid);

        return $qb->getQuery()
                        ->getResult();
    }

    public function updateCart($cartid) {
        $qb = $this->createQueryBuilder('c')
                ->update()->set('c.user_id', $userid)
                ->where('c.id= :cartid')
                ->setParameter('cartid', $cartid);

        $qb->getQuery()->execute();
    }

    public function getCartbyId($cartid) {
        $qb = $this->createQueryBuilder('c')
                ->select('c')
                ->where('c.id = :cartid')
                ->setParameter('cartid', $cartid);

        return $qb->getQuery()
                        ->getResult();
    }

}