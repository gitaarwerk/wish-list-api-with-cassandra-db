<?php

namespace Wishlist\Interfaces;

interface ControllerConstructor
{
    public function __construct($arguments);

    public function getArguments();

    public function setArguments($value);
}