<?php

namespace ClientBundle\Form\Handler\Article;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("new.article.handler")
 */
class NewArticleHandler extends ArticleHandler {

    const ROUTE_REDIRECT_ON_SUCCESS_SUBBMIT = 'article_index';
    const ROUTE_RENDERING = 'article/new.html.twig';

    public function prepareForm($type, $request, $article, $options) {
        $form = $this->formFactory->create($type, $article, $options);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $request->getSession()->getFlashBag()->add("message", "L'article a été enregistré");
            return $this->responseFactory->getSuccessResponseFromArray([
                        'routeRedirectOnSuccessSubbmit' => self::ROUTE_REDIRECT_ON_SUCCESS_SUBBMIT,
                        'save' => true,
            ]);
        }
        return $this->responseFactory->getFailedSubmitOrGetRequestResponseFromArray([
                    'routeRendering' => self::ROUTE_RENDERING,
                    'form' => $form
        ]);
    }

}
