<?php

namespace ApiBundle\Factory;

use ApiBundle\Dto\listeArticlesDto;
use ApiBundle\Dto\DtoDetail;
use ApiBundle\Entity\Article;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("factory.article")
 */
class ArticlesFactory {

    public function getDtoLists($articles) {
        $results = new listeArticlesDto();
        $lists = [];
        foreach ($articles as $article) {
            $value = [];
            $value['id'] = $article->getId();
            $value['title'] = $article->getTitle();
            $value['leading'] = $article->getLeading();
            $value['body'] = $article->getBody();
            $value['createdAt'] = $article->getCreatedAt()->format('Y-m-d H:i:s');
            $value['slug'] = $article->getSlug();
            $value['createdBy'] = $article->getCreatedBy();
            $lists[] = $value;
        }
        $results->setNbResults(count($articles));
        $results->setLists($lists);
        return $results;
    }

    public function getDtoDetail(Article $article) {
        $dtoDetail = new DtoDetail();
        $dtoDetail->setId($article->getId());
        $dtoDetail->setLeading($article->getLeading());
        $dtoDetail->setCreatedBy($article->getCreatedBy());
        $dtoDetail->setBody($article->getBody());
        $dtoDetail->setCreatedAt($article->getCreatedAt()->format('Y-m-d H:i:s'));
        $dtoDetail->setSlug($article->getSlug());
        $dtoDetail->setTitle($article->getTitle());
        return $dtoDetail;
    }

    public function getDoFromObject(\stdClass $article) {
        $articleDo = new Article();
        $now = new \DateTime("now");
        $articleDo->setSlug($article->slug);
        $articleDo->setCreatedBy($article->createdBy);
        $articleDo->setTitle($article->title);
        $articleDo->setCreatedAt($now);
        $articleDo->setBody(property_exists($article, "body") ? $article->body : null);
        $articleDo->setLeading(property_exists($article, "leading") ? $article->leading : null);
        return $articleDo;
    }

}
