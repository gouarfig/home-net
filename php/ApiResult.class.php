<?php

class ApiResult {
    private $data = null;
    private $output = null;

    public function setData($data) {
        $this->data = $data;
    }

    private function prepareResult($success, $message) {
        $this->output = array(
            "success" => $success,
            "message" => $message,
            "data" => $this->data,
        );
    }

    public function success($message = "Success") {
        $this->prepareResult(true, $message);
    }

    public function error($errorMessage, $errorCode = 0) {
        $message = "";
        if ($errorCode > 0) $message .= "Error code #{$errorCode}: ";
        $message .= $errorMessage;
        $this->prepareResult(false, $message);
    }

    public function getJSON() {
        return json_encode($this->output);
    }

    public function sendJSON() {
        echo $this->getJSON();
    }
}