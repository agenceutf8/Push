<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 26/11/2016
 * Time: 17:46
 */

namespace Push\DAO;

use Doctrine\DBAL\Connection;

abstract class DAO
{
    /*
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    public function getDb()
    {
        return $this->db;
    }

    protected abstract function buildDomainObject($row);

}