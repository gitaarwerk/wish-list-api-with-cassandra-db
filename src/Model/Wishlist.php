<?php

namespace Wishlist\Model;

use Wishlist\Interfaces as Interfaces;
use Wishlist\Command as Command;


class Wishlist
    extends Model
{
    /** @var int  */
    private $identityRoleId;

    private $database;

    public function __construct($identityRoleId, $db)
    {
        $this->setIdentityRoleId($identityRoleId);
        $this->setDatabase($db);
    }

    /**
     * @return Command\RetrieveWishlist
     */
    public function getWishlistByIdentityRoleId()
    {
        $command = new Command\RetrieveWishlist($this->getDatabase(), $this->getIdentityRoleId());

        return $command;
    }

    public function insertWishlistItem($productId, $wishlist)
    {
        $command = new Command\InsertWishlistItem($this->getDatabase(), $this->getIdentityRoleId(), (int)$productId, (string)$wishlist);

        return $command;
    }

    public function deleteWishlistItem($productId, $wishlist)
    {
        $command = new Command\DeleteWishlistItem($this->getDatabase(), $this->getIdentityRoleId(), (int)$productId, (string)$wishlist);

        return $command;
    }

    /**
     * @return int
     */
    public function getIdentityRoleId()
    {
        return $this->identityRoleId;
    }

    /**
     * @param int $identityRoleId
     */
    private function setIdentityRoleId($identityRoleId)
    {
        $this->identityRoleId = (int)$identityRoleId;
    }

    /**
     * @return mixed
     */
    private function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param mixed $database
     */
    private function setDatabase($database)
    {
        $this->database = $database;
    }


}