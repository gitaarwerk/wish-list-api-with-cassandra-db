<?php

namespace Wishlist\Controller;

use Wishlist\Interfaces as Interfaces;
use Wishlist\Util as Util;
use Wishlist\View as View;
use Wishlist\Model as Model;
use Wishlist\Exceptions as Exceptions;


class Wishlist
    extends Controller
    implements Interfaces\Methods, Interfaces\ControllerConstructor
{
    private $arguments;

    public function __construct($arguments)
    {
        $this->setArguments($arguments);

        $model = new Model\Wishlist($this->getArguments()["identityRoleId"], $this->getArguments()["db"]);
        $view = new View\Wishlist($model);

        $this->setModel($model);
        $this->setView($view);
    }

    public function get()
    {
        $this->getView()->showWishlistFromUser();
        $this->getView()->render();
    }

    public function post()
    {
        /** @var Model\Wishlist $model */

        $productId = $_POST["productId"];
        $wishlist = $_POST["wishlistName"];

        $queryResult = $this->getModel()->insertWishlistItem($productId, $wishlist);

        $this->getView()->showResult($queryResult);
        $this->getView()->render();
    }

    public function delete()
    {
        $productId = $this->getArguments()["productId"];
        $wishlist = $this->getArguments()["wishlistName"];

        $queryResult = $this->getModel()->deleteWishlistItem($productId, $wishlist);

        $this->getView()->showResult($queryResult);
        $this->getView()->render();
    }

    public function put()
    {
        new Exceptions\NotImplemented("Method not implemented");
    }

    public function update()
    {
         new Exceptions\NotImplemented("Method not implemented");
    }

    /**
     * @return array
     */
    public function getArguments()
    {
        return $this->arguments;
    }

    /**
     * @param array $value
     */
    public function setArguments($value)
    {
       $this->arguments = (array)$value;
    }


}