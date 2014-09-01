<?php namespace Lavacharts\Exceptions;

class InvalidLavaObject extends \Exception
{
    public function __construct($badLavaObject, $code = 0)
    {
        $message = "'$badLavaObject' is not a valid object Lavachart object.";

        parent::__construct($message, $code);
    }
}
