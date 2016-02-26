<?php

namespace Wishlist\Command;

use Wishlist\Interfaces as Interfaces;

class RetrieveWishlist
    implements Interfaces\RetrieveCommand
{
    private $database;

    private $identityRoleId;

    private $result;


    public function __construct($database, $identityRoleId)
    {
        $this->setDatabase($database);
        $this->setIdentityRoleId($identityRoleId);
        $this->execute();
    }

    private function query()
    {
        return 'SELECT * FROM "wishlist" WHERE identityroleid = ' . $this->getIdentityRoleId();
    }


    public function getLength()
    {
        return count($this->getResult());
    }

    /**
     * @return array
     */
    private function execute()
    {
        $query = $this->query();
        $results = $this->getDatabase()->query($query);
        $resultsHal = array();

        foreach ($results as $result)
        {
            $resultsHal["_links"][] =
                array("cb:product" =>
                    array(
                        "href" => "/products/" . $result["productid"]),
                        "profile" => "https://schemas.coolblue.io/products/",
                        "title" => "Product"
                );
        }

        $this->setResult($resultsHal);
    }

    /**
     * @return object
     */
    private function getDatabase()
    {
        return $this->database;
    }

    /**
     * @param object $database
     */
    private function setDatabase($database)
    {
        $this->database = $database;
    }

    /**
     * @return int
     */
    private function getIdentityRoleId()
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
     * @return array
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param array $result
     */
    private function setResult($result)
    {
        $this->result = $result;
    }


}