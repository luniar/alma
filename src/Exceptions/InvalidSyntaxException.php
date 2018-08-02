<?php

namespace Luniar\Alma\Exceptions;

use Exception;

class InvalidSyntaxException extends Exception
{
    public function __construct()
    {
        parent::__construct('Syntax error: the given contents do not match with the context specifications.');
    }
}
