<?php

namespace ApiBundle\Repository\AbstractRepository;

/**
 * Description of AbstractGenericRepository
 *
 * @author manda
 */
class AbstractGenericRepository extends \Doctrine\ORM\EntityRepository implements AbstractRepositoryInterface {

    /**
     * 
     * @param type $entity
     * @param type $persist
     * @param type $flush
     * @return type
     */
    public function save($entity, $persist = false, $flush = true) {
        if ($persist) {
            $this->_em->persist($entity);
        }
        if ($flush) {
            $this->_em->flush();
        }
        return $entity;
    }

    /**
     * 
     * @param type $entity
     */
    public function remove($entity) {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

}
