<?php

namespace ClientBundle\Factory;

use ClientBundle\Dto\ListsDto;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("front.factory.article")
 */
class FrontArticleFactory {

    /**
     * 
     * @param  $results
     * @return array
     */
    public function getLists($results) {
        $body = $results->body;
        return $body->lists;
    }
    
    public function getDetail($results){
        $result = $results->body;
        return $result;
    }
    public function getDeleteResponse($results){
        $result = $results->body;
        return $result->status;
    }
    
    public function getQuery($article) {
        $query = [];
        $query['title'] = $article->getTitle();
        $query['leading'] = $article->getLeading();
        $query['body'] = $article->getBody();
        $query['slug'] = $article->getSlug();
        $query['createdBy'] = $article->getCreatedBy();
        return $query;
    }

}
