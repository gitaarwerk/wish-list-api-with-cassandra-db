<?php

namespace Wishlist\Core;

use Wishlist\Controller as Controller;

class ControllerExecutioner
{
    public function __construct(Controller\Controller $controller)
    {
        switch(RequestHeader::getUsedMethod())
        {
            case "get":
                $controller->get();
                break;
            case "post":
                $controller->post();
                break;
            case "delete":
                $controller->delete();
                break;
            case "put":
                $controller->put();
                break;
            case "update":
                $controller->update();
                break;
        }
    }
}