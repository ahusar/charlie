<?php

namespace Bookshop\BookshopBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * ProductRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProductRepository extends EntityRepository {

    public function getLast($nr) {
        $qb = $this->createQueryBuilder('l')
                ->select('l')->orderBy('l.id', 'desc')
                ->setMaxResults($nr);

        return $qb->getQuery()
                        ->getResult();
    }

    public function retrieveProduct($productid) {

        $qb = $this->createQueryBuilder('p')
                ->select('p')->where('p.id = :product_id')
                ->setParameter('product_id', $productid);

        return $qb->getQuery()
                        ->getSingleResult();
    }

    public function relatedProducts($categoryid) {

        $qb = $this->createQueryBuilder('r')
                ->select('r')->where('r.category = :categoryid and r.active = 1')
                ->setParameter('categoryid', $categoryid);

        return $qb->getQuery()
                        ->getResult();
    }

    public function isOnStock($id, $quantity) {
        $qb = $this->createQueryBuilder('s')
                ->select('s.stock')->where('s.id = :id AND s.active = 1')
                ->setParameter('id', $id);
        $result = $qb->getQuery()->getSingleResult();

        if ($result['stock'] >= $quantity)
            return true;
        else
            return false;
    }

    public function addStock($id, $quantity) {
        $qb = $this->createQueryBuilder('s')
                ->select('s.stock')->where('s.id = :id AND s.active = 1')
                ->setParameter('id', $id);
        $result = $qb->getQuery()->getSingleResult();
        $prevStock = $result['stock'];

        if ($prevStock + $quantity >= 0) {
            $qb = $this->createQueryBuilder('s')
                    ->update()->set('s.stock', $prevStock + $quantity)
                    ->where('s.id= :id')
                    ->setParameter('id', $id);
            $qb->getQuery()->execute();
        }
    }

    public function getNrAllProducts($filter) {
        $em = $this->getEntityManager();
        return $em->createQuery('SELECT COUNT(p) FROM BookshopBookshopBundle:Product p INNER JOIN BookshopBookshopBundle:Category c WITH c = p.category WHERE 1=1' . $filter)
                        ->getSingleScalarResult();
    }

    public function getAllProductsQuery($filter, $count) {
        $em = $this->getEntityManager();
        $dql = "SELECT p FROM BookshopBookshopBundle:Product p INNER JOIN BookshopBookshopBundle:Category c WITH c = p.category WHERE 1=1";
        $dql.=$filter;

        return $em->createQuery($dql)->setHint('knp_paginator.count', $count);
    }

    public function getProduse($categoryid, $request) {
        $filters = $this->createSqlFilter($request);
        $em = $this->getEntityManager();

        $qb = "SELECT a from BookshopBookshopBundle:Product a where a.category = " . $categoryid . " and a.active = 1 ";
        $qb .= $filters;

        return $em->createQuery($qb);
    }

    public function searchProduct($request) {
        $em = $this->getEntityManager();
        $filters = $this->createSqlFilter($request);

        $qb = " SELECT a from BookshopBookshopBundle:Product a where 1=1 ";
        $qb .= $filters;
        return $em->createQuery($qb);
    }

    private function createSqlFilter($request) {

        $filter = '';

        if (strlen($request->get('q')) > 0) {
            $filter .= "a.title like '%" . $request->get('q') . "%'";
        }

        if (strlen($request->get('stock')) > 0)
            switch ($request->get('stock')) {
                case '1':
                    $filter .= ' and a.stock>0';
                    break;
                case '0':
                    $filter .= ' and a.stock=0';
            }
        if (strlen($request->get('pricerange')) > 0) {
            switch ($request->get('pricerange')) {
                case '1':
                    $filter .= ' and a.price between 0 and 49.99';
                    break;
                case '2':
                    $filter .= ' and a.price between 50 and 99.99';
                    break;
                case '3':
                    $filter .= ' and a.price>100';
                    break;
            }
        }

        if (strlen($request->get('category')) > 0) {
            if (ctype_digit($request->get('category'))) {
                $filter .= ' and a.category = ' . $request->get('category');
            }
        }

        return $filter;
    }

}
