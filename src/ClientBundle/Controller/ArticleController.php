<?php

namespace ClientBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use ClientBundle\Form\ArticleType;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * Article controller.
 *
 */
class ArticleController extends Controller {

    /**
     * @DI\Inject("front.manager.article") 
     */
    private $articleManager;

    /**
     * @DI\Inject("new.article.handler") 
     */
    private $articleHandler;

    /**
     * Lists all article entities.
     *
     * @Route("/", name="article_index")
     * @Method("GET")
     */
    public function indexAction() {

        $articles = $this->articleManager->findAll();

        return $this->render('article/index.html.twig', array(
                    'articles' => $articles,
        ));
    }

    /**
     * Creates a new article entity.
     *
     * @Route("/article", name="article_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request) {
        $article = $this->articleHandler->process();
        $response = $this->articleHandler->prepareForm(
                ArticleType::class, $request, $article, ['front.manager.article' => $this->articleManager]
        );
        if ($response->getSuccess() == true) {
            return $this->redirectToRoute($response->getRouteRedirectOnSuccessSubbmit());
        }

        return $this->render($response->getRouteRendering(), [
                    'topic' => $article,
                    'form' => $response->getForm()->createView(),
        ]);
    }

    /**
     * Finds and displays a article entity.
     *
     * @Route("article/{slug}", name="article_show")
     * @Method("GET")
     */
    public function showAction(Request $request, $slug = null) {
        $article = $this->articleManager->findBySlug($request, $slug);
        if (!$article) {
            return $this->redirectToRoute('article_index');
        }
        return $this->render('article/show.html.twig', array(
                    'article' => $article
        ));
    }

    /**
     * Deletes a article entity.
     *
     * @Route("delete/article/{slug}", name="article_delete")
     * @Method("GET|DELETE")
     */
    public function deleteAction(Request $request, $slug) {
        $this->articleManager->delete($request, $slug);
        return $this->redirectToRoute('article_index');
    }

}
