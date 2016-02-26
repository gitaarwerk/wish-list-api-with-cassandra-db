<?php

namespace Wishlist\Core;

use Wishlist\Util as Util;

abstract class ResponseHeader
{
    private static $status;

    /** @var string  */
    private static $contentType;

    /** @var  string */
    private static $simpleContentType;

    /** @var string */
    private static $output;

    /**
     * @param string $contentType
     */
    public static function setContentType($contentType)
    {
        self::$simpleContentType = (string)$contentType;

        $contentType = Util\ContentType::getContentTypeByShortNotation($contentType);

        self::$contentType = (string)$contentType;
    }

    private static function constructResponseHeaders()
    {
        header("Content-Type: " . self::getContentType() . "; charset=" . strtolower(CHARACTER_ENCODING));
        http_response_code(self::getStatus());
    }

    /**
     * @return string
     */
    public static function getContentType()
    {
        return self::$contentType;
    }

    /**
     * @param string $statusCode
     */
    public static function setStatus($statusCode)
    {
        self::$status = $statusCode;
    }

    /**
     * @return string
     */
    public static function getStatus()
    {
        return self::$status;
    }

    public static function setOutput($value)
    {
        $renderer = new Util\Render($value, self::$simpleContentType);
        self::$output = $renderer->getParsedOutput();
    }

    public static function getOutput()
    {
        self::constructResponseHeaders();

        return self::$output;
    }
}