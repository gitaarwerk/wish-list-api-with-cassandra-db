<?php

namespace Wishlist\View;

use Wishlist\Interfaces as Interfaces;
use Wishlist\Model as Model;
use Wishlist\Exceptions as Exceptions;

class Wishlist
    extends View
{
    /** @var array */
    private $output;

    public function __construct( Model\Wishlist $model)
    {
        parent::__construct($model);
    }

    public function showWishlistFromUser()
    {
        /** @var $model Model\Wishlist */
        $model = $this->getModel();

        $results = $model->getWishlistByIdentityRoleId();

        if ($results->getLength() > 0)
        {
            $this->setOutput($results->getResult());
        }
        else
        {
            new Exceptions\NotFound("There are no wish list available for this user.");
        }

    }

    public function showResult($queryResult)
    {
       if ($queryResult === true)
       {
           $this->setOutput($queryResult);
       }
    }

    /** @return array */
    public function getOutput()
    {
        return $this->output;
    }

    public function setOutput($value)
    {
        $this->output = (array)$value;
    }


}