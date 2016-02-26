<?php

namespace Wishlist\Util;

use Wishlist\Interfaces as Interfaces;

class ArrayToJSON
    implements Interfaces\ArrayConverter
{
    public function convert($value)
    {
        return json_encode((array) $value);
    }
}