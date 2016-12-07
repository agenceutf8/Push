<?php
/**
 * Created by PhpStorm.
 * User: POL
 * Date: 28/11/2016
 * Time: 21:48
 */

namespace Push\DAO;

use Push\Domain\Beta;

class BetaDAO extends DAO
{
    /**
     * Saves a beta into the database.
     *
     * @param \Push\Domain\Beta $user The user to save
     */
    public function save(Beta $beta) {
        $betaData = array(
            'beta_mail' => $beta->getMail()
        );

        if ($beta->getId()) {
            
        } else {
            // The user has never been saved : insert it
            $this->getDb()->insert('p_beta', $betaData);
            // Get the id of the newly created user and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $beta->setId($id);
        }
    }

    /**
     * Return a list of all mails for beta-test, sorted by id
     *
     * @return array A list of all mails.
     */
    public function findAll(){
        $sql = "select * from p_beta order by beta_id";
        $result = $this->getDb()->fetchAll($sql);

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