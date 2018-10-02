<?php

namespace ApiBundle\Dto\Response;

/**
 * Description of SuccessDto
 *
 * @author manda
 */
class SuccessDto {

    private $result = [];

    public function __construct($result) {
        $this->result = $result;
    }

    public function setResult($result) {
        $this->result = $result;
        return $this;
    }

    public function setData($result) {
        $this->data = $result;
        return $this;
    }

    /**
     * @inheritDoc
     */
    public function getResponse() {
        return [
            'status' => 200,
            'error' => false,
            'result' => $this->result
        ];
    }

}
