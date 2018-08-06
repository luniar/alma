<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Token;

class TokenResolver
{
    public static function resolve($token)
    {
        if ($token instanceof Token) {
            return $token;
        }

        if (is_string($token)) {
            return new $token;
        }

        throw new IllegalArgumentException('Token type is not recognized.');
    }
}
