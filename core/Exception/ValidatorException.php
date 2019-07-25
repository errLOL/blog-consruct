<?php

namespace core\Exception;

class ValidatorException extends \Exception
{
    public function __construct ($message = 'Service Temporarily Unavailable', $code = 503) {
        parent::__construct($message, $code);
    }
}
