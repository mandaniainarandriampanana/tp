<?php

namespace ApiBundle\Repository\AbstractRepository;

/**
 * Description of GenericRepositoryInterface
 *
 * @author manda
 */
interface AbstractRepositoryInterface {

    public function save($entity, $persist = false, $flush = true);

    public function remove($entity);
}
