<?php

namespace ApiBundle\Manager;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("manager.article")
 */
class ArticleManager {

    private $responseFactory;
    private $articleFactory;
    private $articleRepository;

    /**
     * @DI\InjectParams({
     *     "responseFactory" = @DI\Inject("factory.response"),
     *     "articleFactory" = @DI\Inject("factory.article"),
     *     "articleRepository" = @DI\Inject("service.repository.article"),
     * })
     */
    public function __construct($responseFactory, $articleFactory, $articleRepository) {
        $this->responseFactory = $responseFactory;
        $this->articleFactory = $articleFactory;
        $this->articleRepository = $articleRepository;
    }

    public function getShowResponse($article) {
        if ($article === null) {
            return $this->responseFactory->getErrorResponse();
        }
        $detail = $this->articleFactory->getDtoDetail($article);
        return $this->responseFactory->getSuccessResponse($detail);
    }

    public function getDeleteResponse($article) {
        if ($article === null) {
            return $this->responseFactory->getErrorResponse();
        }
        $res = $this->articleRepository->remove($article);
        return $this->responseFactory->getSuccessResponse($res);
    }

    public function newArticle(\stdClass $article) {
        $articleDo = $this->articleFactory->getDoFromObject($article);
        $this->articleRepository->save($articleDo, true);
        return $this->responseFactory->getSuccessResponse(false);
    }

    public function getErrorsOnNewArticle($error) {
        return $this->responseFactory->getErrorResponse(503, $error);
    }

}
