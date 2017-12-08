<?php

namespace Hero\SaasBundle\DBAL\Driver\PDOPgSql;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Driver\PDOPgSql\Driver as BaseDriver;

class Driver extends BaseDriver
{
    /**
     * @inheritdoc
     */
    public function connect(array $params, $username = null, $password = null, array $driverOptions = [])
    {
        $c = parent::connect($params, $username, $password, $driverOptions);

        $schema = $driverOptions['schema'] ?? null;
        if ($schema) {
            $c->exec("SET SCHEMA {$c->quote($schema)}");
        }

        return $c;
    }

    /**
     * @param Connection $conn
     *
     * @return string
     */
    public function getDatabase(Connection $conn): string
    {
        $params = $conn->getParams();

        return $params['dbname'];
    }
}