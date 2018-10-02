<?php

namespace ApiBundle\Validator\Article;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("article.custum.validator")
 */
class ArticleCustumValidator {

    private $errors = [];
    private $articleRepo;

    /**
     * @DI\InjectParams({
     *     "articleRepo" = @DI\Inject("service.repository.article"),
     * })
     */
    public function __construct($articleRepo) {
        $this->articleRepo = $articleRepo;
    }

    public function validate(\stdClass $article) {
        $slug = $this->getSlug($article);
        if (!$slug) {
            return;
        }
        if (!empty($this->articleRepo->findBySlug($slug))) {
            $this->addErrors("Slug already exist", "slug");
        }
    }

    public function getSlug($article) {
        if (property_exists($article, "slug")) {
            if ($article->slug !== '') {
                return $article->slug;
            }
        }
        return false;
    }

    public function addErrors($message, $field) {
        $error = [
            "message" => $message,
            "field" => $field
        ];
        $this->errors[] = $error;
    }

    function getErrors() {
        return $this->errors;
    }

    function setErrors($errors) {
        $this->errors = $errors;
    }

}
