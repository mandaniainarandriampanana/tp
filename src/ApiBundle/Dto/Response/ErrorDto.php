<?php

namespace ApiBundle\Dto\Response;

class ErrorDto {

    private $errors = [];
    private $type;

    public function __construct($type, $errors) {
        $this->errors = $errors;
        $this->type = $type;
    }

    /**
     * @inheritDoc
     */
    public function getResponse() {
        return [
            'status' => $this->getType(),
            'error' => $this->getErrors(),
            'result' => false
        ];
    }

    /**
     * @inheritDoc
     */
    public function setErrors(array $errors) {
        $this->errors = $errors;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getErrors() {
        return $this->errors;
    }

    /**
     * @inheritDoc
     */
    public function setType($type = 404) {
        $this->type = $type;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getType() {
        return $this->type;
    }

}
