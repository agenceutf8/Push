<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 28/11/2016
 * Time: 21:48
 */

namespace Push\DAO;

use Doctrine\DBAL\Connection;
use Push\Domain\Beta;

class BetaDAO extends DAO
{
    /*
     * Database connection
     *
     * @var \Doctrine\DBAL\Connection
     */
    private $db;

    /**
     * Constructor
     *
     * @param \Doctrine\DBAL\Connection The database connection object
     */
    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

    /**
     * Return a list of all mails for beta-test, sorted by id
     *
     * @return array A list of all mails.
     */
    public function findAll(){
        $sql = "select * from p_beta order by beta_id";
        $result = $this->db->fetchAll($sql);

        //Convert query result to an array of domain objects
        $beta_mails = array();
        foreach ($result as $row){
            $mailId = $row['beta_id'];
            $beta_mails[$mailId] = $this->buildDomainObject($row);
        }
        return $beta_mails;
    }

    protected function buildDomainObject($row)
    {
        $beta = new Beta();
        $beta->setId($row['beta_id']);
        $beta->setMail($row['beta_mail']);
        return $beta;
    }
}