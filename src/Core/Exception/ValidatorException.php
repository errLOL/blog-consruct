<?php

namespace Phpblog\Core\Exception;

class ValidatorException extends \Exception
{
    public function __construct ($message = 'Service Temporarily Unavailable', $code = 500) {
        parent::__construct($message, $code);
    }
}
