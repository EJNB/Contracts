<?php

namespace AppBundle\Repository;

/**
 * EERepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class EERepository extends \Doctrine\ORM\EntityRepository
{
    public function getAllEE($filter){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb->select('e')
            ->from('AppBundle:EE','e')
        ;
        if($filter!=""){
            $qb
                ->where($qb->expr()->like('e.codReuup','?1'))
                ->orWhere($qb->expr()->like('e.codNit','?1'))
                ->orWhere($qb->expr()->like('e.address', '?1'))
                ->orWhere($qb->expr()->like('e.name', '?1'))
                ->setParameter(1, '%' . $filter . '%')
            ;
        }

        $result = $qb->getQuery();
        return $result;
    }

    public function getSuppliersEE(){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('s')
            ->from('AppBundle:Supplier','s')
            ->where('s instance of AppBundle:EE')
        ;

        $result = $qb->getQuery()->getResult();
        return $result;
    }

    public function checkSupplierName($supplierName){
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $qb
            ->select('s')
            ->from('AppBundle:Supplier','s')
            ->where('s instance of AppBundle:EE')
            ->andWhere($qb->expr()->like('s.name', '?1'))
            ->setParameter(1, $supplierName)
        ;

        $result = $qb->getQuery()->getResult();
        return $result;
    }
}
