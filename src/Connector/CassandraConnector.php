<?php

namespace Wishlist\Connector;

use \evseevnn\Cassandra as Cassandra;

class CassandraConnector
{
    private $database;

    public function __construct()
    {
        $this->createDatabaseConnection();
    }

    private function createDatabaseConnection()
    {
        $nodes = [
            '127.0.0.1' => [
                'username' => 'cassandra',
                'password' => 'cassandra'
            ]
        ];

        // Connect to database.
        $database = new Cassandra\Database($nodes);
        $database->setKeyspace(DATABASE_NAME);
        $this->setDatabase($database);
    }

    public function connect()
    {
        $this->getDatabase()->connect();
    }

    /**
     * @return mixed
     */
    public function getDatabase()
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