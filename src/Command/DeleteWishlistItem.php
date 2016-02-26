<?php

namespace Wishlist\Command;

class DeleteWishlistItem
{
    private $database;

    private $identityRoleId;

    private $productId;

    private $wishlistName;

    public function __construct($database, $identityRoleId, $productId, $wishlistName)
    {
        $this->setDatabase($database);
        $this->setProductId($productId);
        $this->setIdentityRoleId($identityRoleId);
        $this->setWishlistName($wishlistName);

        return $this->execute($this->deleteWishlistItem());
    }

    private function deleteWishlistItem()
    {
        $qry =  " DELETE FROM wishlist WHERE identityroleid = " . $this->getIdentityRoleId() . " and productid = " . (int)$this->getProductId() . " and wishlist ='" . $this->getWishlistName() . "'";

        return $qry;
    }

    private function execute($query)
    {
        $result = $this->getDatabase()->query($query);
        return $result;
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

    /**
     * @return mixed
     */
    private function getIdentityRoleId()
    {
        return $this->identityRoleId;
    }

    /**
     * @param mixed $identityRoleId
     */
    private function setIdentityRoleId($identityRoleId)
    {
        $this->identityRoleId = $identityRoleId;
    }

    /**
     * @return int
     */
    private function getProductId()
    {
        return $this->productId;
    }

    /**
     * @param int $productId
     */
    private function setProductId($productId)
    {
        $this->productId = (int)$productId;
    }

    /**
     * @return string
     */
    private function getWishlistName()
    {
        return $this->wishlistName;
    }

    /**
     * @param string $value
     */
    private function setWishlistName($value)
    {
        $this->wishlistName = (string)$value;
    }


}