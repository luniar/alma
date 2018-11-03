<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Tokenable;

class TokenResolver
{
    public static function resolve($token)
    {
        if (is_string($token)) {
            $token = new $token;
        }

        if ($token instanceof Tokenable) {
            return $token;
        }

        throw new InvalidArgumentException('Token type is not recognized.');
    }
}
