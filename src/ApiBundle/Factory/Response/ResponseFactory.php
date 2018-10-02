<?php

namespace ApiBundle\Factory;

use ApiBundle\Dto\Response\ErrorDto;
use ApiBundle\Dto\Response\SuccessDto;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("factory.response")
 */
class ResponseFactory {

    /**
     * @inheritDoc
     */
    public function getErrorResponse($type = 404, $error = "Not Found") {
        $errorDto = new ErrorDto($type, $error);
        return $errorDto->getResponse();
    }

    public function getSuccessResponse($results) {
        $successDto = new SuccessDto($results);
        return $successDto->getResponse();
    }

}
