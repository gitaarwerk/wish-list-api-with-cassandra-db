<?php

namespace Wishlist\Controller;

use Wishlist\View as View;
use Wishlist\Model as Model;
use Wishlist\Util as Util;

abstract class Controller
{
    /** @var View $view */
    private $view;

    /** @var Model $model */
    private $model;

    /** @var string  */
    private $contentType;

    /**
     * @return View\View
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param View\View $view
     */
    public function setView(View\View $view)
    {
        $this->view = $view;
    }

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
    public function setModel(Model\Model $model)
    {
        $this->model = $model;
    }

    /**
     * @return string
     */
    public function getContentType()
    {
        return $this->contentType;
    }

    /**
     * @param string $contentType
     */
    private function setContentType($contentType)
    {
        $this->contentType = $contentType;
    }




}