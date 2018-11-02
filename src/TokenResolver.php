<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Tokenable;

class TokenResolver
{
    public static function resolve($token)
    {
        if ($token instanceof Tokenable) {
            return $token;
        }

        if (is_string($token)) {
            return new $token;
        }

        throw new InvalidArgumentException('Token type is not recognized.');
    }
}
