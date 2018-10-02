<?php

namespace ClientBundle\Objects;

/**
 * Description of Response
 *
 * @author manda
 */
class Response {

    private $routeRedirectOnSuccessSubbmit;
    private $routeRendering;
    private $form;
    private $success;
    private $save;

    public function getRouteRedirectOnSuccessSubbmit() {
        return $this->routeRedirectOnSuccessSubbmit;
    }

    public function getRouteRendering() {
        return $this->routeRendering;
    }

    public function getForm() {
        return $this->form;
    }

    public function setRouteRedirectOnSuccessSubbmit($routeRedirectOnSuccessSubbmit) {
        $this->routeRedirectOnSuccessSubbmit = $routeRedirectOnSuccessSubbmit;
    }

    public function setRouteRendering($routeRendering) {
        $this->routeRendering = $routeRendering;
    }

    public function setForm($form) {
        $this->form = $form;
    }

    public function setSuccess($success) {
        $this->success = $success;
    }

    public function getSuccess() {
        return $this->success;
    }

    public function getSave() {
        return $this->save;
    }

    public function setSave($save) {
        $this->save = $save;
    }

}
