<?php

namespace ClientBundle\Manager;

use JMS\DiExtraBundle\Annotation as DI;
use Unirest\Request;
use Unirest\Request\Body;

/**
 * @DI\Service("front.manager.article")
 */
class ArticleManager {

    private $unirest;
    private $apiBaseUrl;
    private $frontArticleFactory;
    private $body;

    /**
     * @DI\InjectParams({
     *   "apiBaseUrl" = @DI\Inject("%api_base_url%"),
     *   "frontArticleFactory" = @DI\Inject("front.factory.article"),
     * })
     */
    public function __construct($apiBaseUrl, $frontArticleFactory) {
        $this->apiBaseUrl = $apiBaseUrl;
        $this->frontArticleFactory = $frontArticleFactory;
        $this->unirest = new Request();
        $this->body = new Body();
    }

    public function findAll() {
        $results = $this->unirest->get($this->apiBaseUrl . "/articles");
        $articles = $this->frontArticleFactory->getLists($results);
        return $articles;
    }

    public function findBySlug($request, $slug) {
        $results = $this->unirest->get($this->apiBaseUrl . "/articles/" . $slug);
        $result = $this->frontArticleFactory->getDetail($results);
        if ($result->status == 404) {
            $request->getSession()->getFlashBag()->add("message", "L'article n'a pas été trouvé");
            return false;
        }
        return $result->result;
    }

    public function delete($request, $slug) {
        $results = $this->unirest->delete($this->apiBaseUrl . "/articles/" . $slug);
        $status = $this->frontArticleFactory->getDeleteResponse($results);
        if ($status == 200) {
            $request->getSession()->getFlashBag()->add("message", "L'article a été supprimé");
            return;
        }
        $request->getSession()->getFlashBag()->add("message", "L'article n'a pas été trouvé");
    }

    public function newArticle($data) {
        $query = $this->frontArticleFactory->getQuery($data);
        $body = $this->body->json($query);
        $results = $this->unirest->post($this->apiBaseUrl . "/articles/", ['Accept' => 'application/json'], $body);
        return $results->body;
    }

}
