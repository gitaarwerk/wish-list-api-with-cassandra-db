<?php

namespace Wishlist\Util;

use Wishlist\Interfaces as Interfaces;

class ArrayToXML
    implements Interfaces\ArrayConverter
{

    public function convert($value)
    {
        $xml = new \SimpleXMLElement('<root/>');
        array_walk_recursive($value, array ($xml, 'addChild'));

        return  $xml->asXML();
    }
}