<?php

namespace Luniar\Alma;

use Luniar\Alma\Contracts\Fragmentable;

class FragmentResolver
{
    public static function resolve($fragment)
    {
        if (is_string($fragment)) {
            $fragment = new $fragment;
        }

        if ($fragment instanceof Fragmentable) {
            return $fragment;
        }

        throw new InvalidArgumentException('Fragment type is not recognized.');
    }
}
