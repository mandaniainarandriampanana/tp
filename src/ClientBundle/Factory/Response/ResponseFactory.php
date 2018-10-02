<?php

namespace ClientBundle\Factory\Response;
use ClientBundle\Objects\Response;
use JMS\DiExtraBundle\Annotation as DI;

/**
 * @DI\Service("front.response.factory")
 */
class ResponseFactory {
    public function getSuccessResponseFromArray($array)
    {
        $response = new Response();
        $response->setSuccess(true);
        if (array_key_exists('routeRedirectOnSuccessSubbmit', $array)) {
            $response->setRouteRedirectOnSuccessSubbmit($array['routeRedirectOnSuccessSubbmit']);
        }
        if (array_key_exists('save', $array)) {
            $response->setSave($array['save']);
        }
        return $response;
    }

    /**
     * 
     * @param type $array
     * @return Response
     */
    public function getFailedSubmitOrGetRequestResponseFromArray($array)
    {
        $response = new Response();
        if (array_key_exists('routeRendering', $array)) {
            $response->setRouteRendering($array['routeRendering']);
        }
        if (array_key_exists('form', $array)) {
            $response->setForm($array['form']);
        }
        return $response;
    }
}
