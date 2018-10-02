<?php

namespace ClientBundle\Form\Handler\Article;

use Symfony\Component\Form\FormFactoryInterface;
use ClientBundle\Objects\Article;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("article.handler")
 */
abstract class ArticleHandler implements ArticleHandlerStrategy {

    public $formFactory;
    public $responseFactory;

    /**
     * @DI\InjectParams({
     *     "responseFactory" = @DI\Inject("front.response.factory"),
     *     "formFactory" = @DI\Inject("form.factory")
     * })
     */
    public function __construct($formFactory, $responseFactory) {
        $this->formFactory = $formFactory;
        $this->responseFactory = $responseFactory;
    }

    /**
     * 
     */
    abstract public function prepareForm($type, $request, $article, $options);

    public function process($article = null) {
        if ($article == null) {
            $article = new Article();
        }
        return $article;
    }

}
