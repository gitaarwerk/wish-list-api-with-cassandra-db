<?php

namespace Wishlist\Exceptions;

use Wishlist\Util as Util;
use Wishlist\Interfaces as Interfaces;

class MethodNotAllowed
    extends Exception
    implements Interfaces\Exception
{
    public function __construct($message)
    {
        parent::throwError(Util\Statuscode::METHOD_NOT_ALLOWED, $message);
    }
}