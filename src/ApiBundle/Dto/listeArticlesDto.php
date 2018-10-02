<?php

namespace ApiBundle\Dto;

class listeArticlesDto {

    private $nbResults = 0;
    private $lists = [];

    function getNbResults() {
        return $this->nbResults;
    }

    function getLists() {
        return $this->lists;
    }

    function setNbResults($nbResults) {
        $this->nbResults = $nbResults;
    }

    function setLists(array $lists) {
        $this->lists = $lists;
    }

}
