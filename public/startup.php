<?php
require_once '../src/config.local.php';
require_once '../vendor/autoload.php';

if (DEVELOPMENT === true)
{
    ini_set('display_errors',1);
    ini_set('display_startup_errors',1);
    error_reporting(-1);
}

use Wishlist\Core as Core;
use Wishlist\Util as Util;

// Set initial set values from Request headers.
Core\RequestHeader::setFullUrl();
Core\RequestHeader::setUsedMethod();
Core\RequestHeader::setContentType();

// Determine some values and prepare the Response header.
$determineContentType = new Util\DetermineContentType();

Core\ResponseHeader::setContentType($determineContentType->getRequestedContentType());