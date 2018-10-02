<?php

namespace ApiBundle\Controller;

use ApiBundle\Controller\BaseController;
use ApiBundle\Entity\Article;
use JMS\DiExtraBundle\Annotation as DI;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Article controller.
 *
 * @Route("articles")
 */
class ArticleController extends BaseController {

    /**
     * @DI\Inject("service.repository.article") 
     */
    private $articleRepository;

    /**
     * @DI\Inject("factory.article") 
     */
    private $articlesFactory;

    /**
     * @DI\Inject("manager.article") 
     */
    private $articleManager;

    /**
     * @DI\Inject("article.validator") 
     */
    private $articleValidator;

    /**
     * Lists all article entities.
     *
     * @Route("/", name="articles_index")
     * @Method("GET")
     */
    public function indexAction() {
        $articles = $this->articleRepository->findAll();
        $results = $this->articlesFactory->getDtoLists($articles);
        return $this->renderToJson($results);
    }

    /**
     * Creates a new article entity.
     *
     * @Route("/", name="articles_new")
     * @Method("POST")
     */
    public function newAction(Request $request) {
        $data = json_decode($request->getContent());
        if ($this->articleValidator->validate($data)) {
            $res = $this->articleManager->newArticle($data);
            return $this->renderToJson($res);
        }
        $error = $this->articleValidator->getErrors();
        $errorResponse = $this->articleManager->getErrorsOnNewArticle($error);
        return $this->renderToJson($errorResponse);
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("/{slug}", name="articles_show")
     * @Method("GET")
     */
    public function showAction(Article $article = null) {
        $result = $this->articleManager->getShowResponse($article);
        return $this->renderToJson($result);
    }

    /**
     * Deletes a article entity.
     *
     * @Route("/{slug}", name="articles_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Article $article = null) {
        $result = $this->articleManager->getDeleteResponse($article);
        return $this->renderToJson($result);
    }

}
