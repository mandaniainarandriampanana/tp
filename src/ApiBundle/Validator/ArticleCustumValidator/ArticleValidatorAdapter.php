<?php

namespace ApiBundle\Validator\Article;

use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("article.validator")
 */
class ArticleValidatorAdapter {

    private $validator;
    private $custumValidator;
    private $errors;

    /**
     * @DI\InjectParams({
     *     "custumValidator" = @DI\Inject("article.custum.validator"),
     *     "validator" = @DI\Inject("base.validator"),
     * })
     */
    public function __construct($custumValidator, $validator) {
        $this->custumValidator = $custumValidator;
        $this->validator = $validator;
    }

    public function validate(\stdClass $article) {
        $this->validator->validate([
                ['value' => property_exists($article, 'title') ? $article->title : '', 'field' => 'title', 'constraints' => ['blank']],
                ['value' => property_exists($article, 'createdBy') ? $article->createdBy : '', 'field' => 'createdBy', 'constraints' => ['blank']],
                ['value' => property_exists($article, 'slug') ? $article->slug : '', 'field' => 'slug', 'constraints' => ['blank']]
        ]);
        $errorsConstraintsRequired = $this->validator->getErrors();
        //custum validator;
        $this->custumValidator->Validate($article);
        $errorsValidator = $this->custumValidator->getErrors();

        $this->errors = array_merge($errorsConstraintsRequired, $errorsValidator);
        return empty($this->errors);
    }

    public function getErrors() {
        return $this->errors;
    }

    public function setErrors($errors) {
        $this->errors = $errors;
    }

}
