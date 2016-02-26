<?php

namespace Wishlist\Util;

abstract class ContentType
{
    const json = "application/json";

    const json_hal = "application/hal+json";

    const xml = "application/xml";

    const jsonShort = "json";

    const jsonHalShort = "json_hal";

    const xmlShort = "xml";

    static function getContentTypeByShortNotation($value)
    {
        if ($value === "json")
        {
            return self::json;
        }

        if ($value === "json_hal")
        {
            return self::jsonHal;
        }

        if ($value === "xml")
        {
            return self::xml;
        }
    }

    static function getContentTypeByHeaderNotation($value)
    {
        if ($value === self::json)
        {
            return self::jsonShort;
        }

        if ($value === self::json_hal)
        {
            return self::jsonHalShort;
        }

        if ($value === self::xml)
        {
            return self::xmlShort;
        }
    }

}