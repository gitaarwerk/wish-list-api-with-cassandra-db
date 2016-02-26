<?php

namespace Wishlist\View;

use Wishlist\Interfaces as Interfaces;
use Wishlist\Util as Util;
use Wishlist\Core as Core;
use Wishlist\Model as Model;

abstract class View
    implements Interfaces\Render
{

    /** @var Model\Model */
    private $model;

    private $contentType;

    public function __construct(Model\Model $model)
    {
        $this->setModel($model);
    }

    /**
     * @return string
     */
    abstract function getOutput();

    /**
     * @param string $output
     */
    abstract function setOutput($value);

    /**
     * @return Model\Model
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Model\Model $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }

    /**
     * @return mixed
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param mixed $contentType
     */
    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }


    public function render()
    {
         Core\ResponseHeader::setOutput($this->getOutput());
    }
}