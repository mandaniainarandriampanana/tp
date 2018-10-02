<?php

namespace ClientBundle\Dto;

/**
 * Description of ListsDto
 *
 * @author manda
 */
class ListsDto {

    private $id;
    private $title;
    private $leading;
    private $body;
    private $createdAt;
    private $slug;
    private $createdBy;

    function getId() {
        return $this->id;
    }

    function getTitle() {
        return $this->title;
    }

    function getLeading() {
        return $this->leading;
    }

    function getBody() {
        return $this->body;
    }

    function getCreatedAt() {
        return $this->createdAt;
    }

    function getSlug() {
        return $this->slug;
    }

    function getCreatedBy() {
        return $this->createdBy;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setTitle($title) {
        $this->title = $title;
    }

    function setLeading($leading) {
        $this->leading = $leading;
    }

    function setBody($body) {
        $this->body = $body;
    }

    function setCreatedAt($createdAt) {
        $this->createdAt = $createdAt;
    }

    function setSlug($slug) {
        $this->slug = $slug;
    }

    function setCreatedBy($createdBy) {
        $this->createdBy = $createdBy;
    }

}
