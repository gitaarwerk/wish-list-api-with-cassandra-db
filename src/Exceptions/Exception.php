<?php

namespace Wishlist\Exceptions;

use Wishlist\Core as Core;

abstract class Exception
{
    final public function throwError($statusCode, $message)
    {
        Core\ResponseHeader::setStatus($statusCode);
        Core\ResponseHeader::setOutput($message);
    }
}