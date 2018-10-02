<?php

namespace ApiBundle\Controller;

use JMS\DiExtraBundle\Annotation as DI;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * Description of CommonController
 *
 * @author Arkeup
 */
class BaseController extends Controller {

    protected $serializer;
    protected $saThematique;

    public function __construct() {

        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    public function renderToJson($_aReturn) {
        $response = new Response();
        $response->setContent($this->serializer->serialize($_aReturn, 'json'));
        return $response;
    }

}
