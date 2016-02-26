<?php

namespace Wishlist\Util;

use Wishlist\Util as Util;
use Wishlist\Core as Core;

class DetermineContentType
{
    private $requestedContentType;

    public function __construct()
    {
        $this->setDefaultContentType();
        $this->setRequestedContentTypeFromHeaders();
        $this->setRequestedContentTypeFromExtension();

        // Halt application when its not supported.
        $this->checkRequestedContentTypeSupport();
    }

    private function checkRequestedContentTypeSupport()
    {
        if (strpos(SUPPORTED_CONTENT_TYPES, $this->getRequestedContentType()) === -1)
        {
         //   $this->getApp()->halt("501", $this->getRequestedContentType() . " not supported.");
        }
    }

    private function setDefaultContentType()
    {
        $this->setRequestedContentType(strtolower(DEFAULT_CONTENT_TYPES));
    }

    private function setRequestedContentTypeFromExtension()
    {
        // Overrides content type when set by url extension.
        $requestedByExtension = $this->obtainRequestedContentTypeFromUrl();

        if (!empty($requestedByExtension))
        {
            $this->setRequestedContentType($requestedByExtension);
        }
    }

    private function setRequestedContentTypeFromHeaders()
    {
        $header = Core\RequestHeader::getContentType();
        $contentTypeByHeaders = Util\ContentType::getContentTypeByHeaderNotation($header);

       if (!empty($contentTypeByHeaders))
       {
            $this->setRequestedContentType($contentTypeByHeaders);
       }
    }

    private function obtainRequestedContentTypeFromUrl()
    {
        $path = Core\RequestHeader::getFullUrl();

        return pathinfo($path, PATHINFO_EXTENSION);
    }

    /**
     * @return mixed
     */
    public function getRequestedContentType()
    {
        return $this->requestedContentType;
    }

    /**
     * @param mixed $value
     */
    private function setRequestedContentType($value)
    {
        $this->requestedContentType = $value;
    }

}
