<?php
namespace ClientBundle\Form\Handler\Article;

interface ArticleHandlerStrategy
{

    public function prepareForm($type, $request, $article,$options);
}
