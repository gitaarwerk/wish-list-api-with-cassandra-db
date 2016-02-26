<?php

namespace Wishlist\Exceptions;

use Wishlist\Util as Util;
use Wishlist\Interfaces as Interfaces;

class NotFound
    extends Exception
    implements Interfaces\Exception
{
    public function __construct($message)
    {
        parent::throwError(Util\Statuscode::NOT_FOUND, $message);
    }
}