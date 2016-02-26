<?php

namespace Wishlist\Util;

use Wishlist\Interfaces as Interfaces;
use Wishlist\Core as Core;

class Render
{
    private $content;

    private $parsedOutput;

    public function __construct($content, $requestedContentType)
    {
        $this->setContent((array)$content);
        $arrayConverter = $this->contentTypeFactory($requestedContentType);
        $output = $this->parse($arrayConverter);

        $this->setParsedOutput($output);
    }

    /**
     * @param $requestedContentType
     * @return Interfaces\ArrayConverter
     */
    private function contentTypeFactory($requestedContentType)
    {
        $requestedContentType = strtolower((string)$requestedContentType);

        switch($requestedContentType)
        {
            case "json":
                return new ArrayToJSON();
                break;
            case "xml":
                 return new ArrayToXML();
                break;
            default:
                break;
        }
    }

    /**
     * @param Interfaces\ArrayConverter $arrayConverter
     * @return string
     */
    private function parse(Interfaces\ArrayConverter $arrayConverter)
    {
        return $arrayConverter->convert($this->getContent());
    }

    /**
     * @return string
     */
    public function getParsedOutput()
    {
        return $this->parsedOutput;
    }

    /**
     * @param string $content
     */
    private function setParsedOutput($content)
    {
        $this->parsedOutput = (string)$content;
    }

    /**
     * @return mixed
     */
    private function getContent()
    {
        return $this->content;
    }

    /**
     * @param mixed $content
     */
    private function setContent($content)
    {
        $this->content = $content;
    }


}