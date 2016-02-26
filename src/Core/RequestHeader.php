<?php

namespace Wishlist\Core;

abstract class RequestHeader
{
    private static $fullUrl;

    private static $contentType;

    private static $usedMethod;

    public static function setFullUrl()
    {
        self::$fullUrl = filter_var("//$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]", FILTER_SANITIZE_URL);
    }

    public static function setUsedMethod()
    {
        self::$usedMethod = strtolower($_SERVER["REQUEST_METHOD"]);
    }

    public static function getUsedMethod()
    {
        return self::$usedMethod;
    }

    /**
     * @return string
     */
    public static function getFullUrl()
    {
        return self::$fullUrl;
    }

    public static function setContentType()
    {
        self::$contentType = $_SERVER["HTTP_ACCEPT"];
    }


    public static function getContentType()
    {
        return self::$contentType;
    }
}